<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index()
    {
        return inertia('Cart', []);
    }

    public function store(Request $request)
    {
        Cart::create($request->validate([
            'id' => ['required', 'number'],
            'name' => ['required', 'string'],
            'quantity' => ['required', 'number'],
            'price' => ['required', 'number']
        ]));

        return to_route('completed');
    }
}
