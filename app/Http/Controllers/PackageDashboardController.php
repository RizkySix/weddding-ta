<?php

namespace App\Http\Controllers;

use App\Trait\HelperTrait;
use Illuminate\Http\Request;

class PackageDashboardController extends Controller
{
    use HelperTrait;
    public function activeOrder(Request $request)
    {
         return view('order.active-booking', [
            'orders' => $request->search ? $this->getActiveBooking($request->search) : $this->getActiveBooking()
        ]);
    }


    public function unActiveOrder(Request $request)
    {
         return view('order.unactive-booking', [
            'orders' => $request->search ? $this->getUnActiveBooking($request->search) : $this->getUnActiveBooking()
        ]);
    }
}
