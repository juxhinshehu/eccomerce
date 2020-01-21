<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<script src="https://js.stripe.com/v3/"></script>
<script src="/js/app.js"></script>
</head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<body>

    <div class="container">
        <br><br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success" id="success-msg" style="visibility: hidden;">
                    Order Succesfully made! Get back to <a href="/">list</a>.
                </div>

                <form  class="form-horizontal"action="/charge" method="get" id="payment-form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name" placeholder="Enter your full name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="address">Address:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="address" placeholder="Enter your address">
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-sm-2" for="shipping">Shipping:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="shipping">
                                <option>Free standard</option>
                                <option>Express 10 USD</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Credit or debit card:</label>
                        <div class="col-sm-6">
                            <div id="card-element">
                              <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display Element errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <div id="errors" style="color: red"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button id="submit" type="submit" class="btn btn-default">Submit Payment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/js/checkout.js"></script>

</body>
</html>