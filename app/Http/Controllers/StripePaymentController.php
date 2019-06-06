<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class StripePaymentController extends Controller
{
    /**
     * Return success response
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
    	return view('stripe_main');
    }

    /**
     * Process stripe payment
     *
     * @param \Illuminate\Http\Request $request.
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
    	Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    	Stripe\Charge::create([
    		'amount'	=> 	100 * 100,
    		'currency'	=> 	'usd',
    		'source'	=>	$request->stripeToken,
    		'description'	=> 'Test description from Aziz World'
    	]);

    	session()->flash('success', 'Payment Successful');

    	return back();
    }
}
