<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function waitingOrder(Request $request)
    {

        $orders = Order::with(['booking.package.catalog' => function($catalog) {
            $catalog->orderBy('order' , 'ASC')->get();
        }, 'reference'])
        ->whereDoesntHave('reference' , function($reference) {
           $reference->whereIn('status' , ['berhasil', 'expired']);
        })
        ->latest()
        ->paginate(5)->withQueryString();

        if($request->search){
            $orders = Order::with(['booking.package.catalog' => function($catalog) {
                $catalog->orderBy('order' , 'ASC')->get();
            }, 'reference'])
            ->whereDoesntHave('reference' , function($reference) {
               $reference->whereIn('status' , ['berhasil', 'expired']);
            })
            ->where('order_id' , $request->search)
            ->latest()
            ->paginate(5)->withQueryString();
        }

        return view('order.waiting-order', [
            'orders' => $orders
        ]);
    
    }

    public function paidOrder(Request $request)
    {
        $orders = Order::with(['booking.package.catalog' => function($catalog) {
            $catalog->orderBy('order' , 'ASC')->get();
        }, 'reference'])
        ->whereHas('reference' , function($reference) {
           $reference->where('status' , 'berhasil');
        })
        ->latest()
        ->paginate(5)->withQueryString();

        if($request->search){
            $orders = Order::with(['booking.package.catalog' => function($catalog) {
                $catalog->orderBy('order' , 'ASC')->get();
            }, 'reference'])
            ->whereHas('reference' , function($reference) {
               $reference->where('status' , 'berhasil');
            })
            ->where('order_id' , $request->search)
            ->latest()
            ->paginate(5)->withQueryString();
        }

        return view('order.paid-order', [
            'orders' => $orders
        ]);
    }

    public function expiredOrder(Request $request)
    {
        $orders = Order::with(['booking.package.catalog' => function($catalog) {
            $catalog->orderBy('order' , 'ASC')->get();
        }, 'reference'])
        ->whereHas('reference' , function($reference) {
           $reference->where('status' , 'expired');
        })
        ->latest()
        ->paginate(5)->withQueryString();

        if($request->search){
            $orders = Order::with(['booking.package.catalog' => function($catalog) {
                $catalog->orderBy('order' , 'ASC')->get();
            }, 'reference'])
            ->whereHas('reference' , function($reference) {
               $reference->where('status' , 'expired');
            })
            ->where('order_id' , $request->search)
            ->latest()
            ->paginate(5)->withQueryString();
        }

        return view('order.expired-order', [
            'orders' => $orders
        ]);
    }
}
