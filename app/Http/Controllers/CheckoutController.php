<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Donut;
use App\Models\Order;
use App\Models\OrderItems;
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
        $validated = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'street_address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'zip_code' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'items' => ['required', 'min:1']
        ]);

        $customer = Customer::create(
            [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'street_address' => $validated['street_address'],
                'city' => $validated['city'],
                'zip_code' => $validated['zip_code'],
                'state' => $validated['state'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
            ]
        );
        $order = Order::create(
            [
                'customer_id' => $customer->id,
            ]
        );

        foreach ($validated['items'] as $item) {
            OrderItems::create(
                [
                    'order_id' => $order->id,
                    'donut_id' => $item['id']
                ]
            );
        }
        return redirect('/confirm');
    }
}

