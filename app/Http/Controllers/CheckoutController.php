<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Donut;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return inertia(
            'Checkout', []
        );
    }

    public function store(Request $request)
    {
        $customer = Customer::create(
            [
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'street_address' => $request['street_address'],
                'city' => $request['city'],
                'zip_code' => $request['zip_code'],
                'state' => $request['state'],
                'phone' => $request['phone'],
                'email' => $request['email'],
            ]
        );
        Order::create(
            [
                'customer_id' => $customer->id,
            ]
        );
        return redirect('/confirm');
    }
}

