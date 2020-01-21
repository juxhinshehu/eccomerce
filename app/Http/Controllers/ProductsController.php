<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('products', ['products' => $products]);
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function testStripe() {
        \Stripe\Stripe::setApiKey('sk_test_AGyWp1jokLUzmo9x846HZpp4003bMajNaA');

        $charge = \Stripe\Charge::create([
          'amount' => 1000,
          'currency' => 'usd',
          'source' => 'tok_visa',
          'receipt_email' => 'jenny.rosen@example.com',
        ]);

        echo "<pre>";
        var_dump($charge);
    }

}
