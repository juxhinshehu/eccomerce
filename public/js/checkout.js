var stripe = Stripe(window.stripe_publishable);
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
var style = {
    base: {
        fontSize: '16px',
        color: '#32325d',
    },
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Create a token or display an error when the form is submitted.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            // Inform the customer that there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
        } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
        }
    });
});

function stripeTokenHandler(token) {
    document.getElementById("submit").disabled = true;
    
    var request = {stripeToken: token.id,
                    name: document.getElementById("name").value,
                    address: document.getElementById("address").value,
                    product_id: getProductId(),
                    shipping: document.getElementById('shipping').value};

    axios.post('/charge', request)
        .then(function (response) {
        document.getElementById("success-msg").style.visibility = "";
        document.getElementById('errors').style.visibility = "hidden";
    })
    .catch(function (error) {
        console.log(error.response.data);
        document.getElementById("success-msg").style.visibility = "hidden";
        document.getElementById("errors").style.visibility = "";
        
        var errorMsgs = "";
        errorMsgs += error.response.data.message + "<br>";
        
        if (error.response.data.errors) {
            for (var key in error.response.data.errors) {
                errorMsgs += error.response.data.errors[key] + "<br>";
            }
        }
        
        document.getElementById('errors').innerHTML = errorMsgs;

  })
  .then(function () {
      document.getElementById("submit").disabled = false;
  }); 

}

function getProductId() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    return urlParams.get('product_id')
}
