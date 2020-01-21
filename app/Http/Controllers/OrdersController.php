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

    // dispatch a job that sends mail to the admin
    private function notifyAdmin($order) {
        $mailData = ['user_name' => $order->client_name, 
                    'product_price' => $order->total_product_value ];
        $adminEmail = \Config::get('app_vars.admin_email');

        dispatch(new \App\Jobs\SendEmailJob($mailData, $adminEmail));
    }

    private function getShippingCost($shippingValue) {
        if ($shippingValue == 'Express 10 EUR')
            return 10;
        return 0;
    }

}
