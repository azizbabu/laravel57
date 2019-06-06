<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ChargeController extends Controller
{
    public function index()
    {
    	$user = User::find(1);
    	// stripe id already exists in user table
    	// $charge = $user->charge(9000);
    	// dd($charge);
    	return view('stripe');
    }

    public function store(Request $request)
    {
    	$stripeToken = $request->stripeToken;

    	$user = User::find(1);
    	
    	$plan = env('STRIPE_SUBSCRIPTION_PLAN');

		$user->newSubscription('main', $plan)->create($stripeToken);

		dd($user);
    }
}
