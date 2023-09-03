<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class ThankYouController extends Controller
{
    public function index()
    {
        // You can retrieve order details to display on the "Thank You" page
        // For example, you can fetch the most recent order for the currently authenticated user
        $order = Order::where('user_id', auth()->user()->id)->latest()->first();

        return view('thankyou', compact('order'));
    }
}
