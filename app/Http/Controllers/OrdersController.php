<?php

namespace App\Http\Controllers;
use App\Product;
use App\Order;
use \Stripe\Stripe;
use Illuminate\Http\Request;
use Mail;


class OrdersController extends Controller
{
    public function charge(Request $request) {
    	$request->validate([
	        'name' => 'required|max:255',
	        'address' => 'required',
	        'shipping' => 'required',
	        'product_id' => 'exists:products,id'
	    ]);

        $requestData = $request->all();
        $product = Product::find($requestData['product_id']);
        $shippingCost = $this->getShippingCost($requestData['shipping']);
        $totalPrice = $product->price + $shippingCost; 
        
        Stripe::setApiKey(\Config::get('app_vars.stripe_secret'));
        $token = $requestData['stripeToken'];
        $charge = \Stripe\Charge::create([
			'amount' => $totalPrice * 100,
			'currency' => 'usd',
			'description' => 'Example charge',
			'source' => $token,
        ]);

        if (isset($charge['status']) && $charge['status'] == 'succeeded') {
            $order = new Order;
            $order->client_name = $requestData['name'];
            $order->client_address = $requestData['address'];
            $order->total_product_value = $totalPrice;
            $order->total_shipping_value = $shippingCost;

            $order->save();
            $this->notifyAdmin($order);
        }
        
        
        return $charge;
    }

    private function getShippingCost($shippingValue) {
        if ($shippingValue == 'Express 10 EUR')
            return 10;
        return 0;
    }

    private function notifyAdmin($request) {
        $data = array('name'=>"Juxhin Shehu");
   
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('juxhinshehu@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
            $message->from('juxhinshehu@gmail.com','Juxhin Shehu');
        });
    }

    public function testmail() {
        $data = array('name'=>"Juxhin Shehu");
   
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('juxhinshehu@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
            $message->from('juxhin@onlinenow.eu','Juxhin Shehu');
        });
    }
   
}
