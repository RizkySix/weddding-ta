<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ItemOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['booking.package.catalog' => function($catalog) {
            $catalog->orderBy('order' , 'ASC')->get();
        }, 'reference'])->where('user_id' , auth()->user()->id)->latest()->get();

        
        return view('customer.order-item', [
            'orders' => $orders
        ]);
    }


}
