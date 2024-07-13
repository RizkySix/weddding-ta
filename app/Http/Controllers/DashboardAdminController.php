<?php

namespace App\Http\Controllers;

use App\Models\PackageBooking;
use App\Models\User;
use App\Trait\HelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    use HelperTrait;
    public function dashboard()
    {
        $activePackages = $this->getActiveBooking();
        $unActivePackages = $this->getUnActiveBooking();

        $chartData = $this->chartData();

    
        $amount = 0;
        $charts = [];
        foreach($chartData as $data){
            $dateFormat = Carbon::parse($data->reference->updated_at)->format('Y-m-d');

            if(isset($charts[$dateFormat])){
                $charts[$dateFormat] += 1;
            }else{
                $charts[$dateFormat] = 1;
            }

            $amount += $data->total;
        }

        $lastMonthAmount = $this->lastMonthOrder();
        $difference = $amount - $lastMonthAmount;
        $percentageDifference = 0;

        if ($lastMonthAmount != 0) {
            $percentageDifference = ($difference / $lastMonthAmount) * 100;
        }

    
        $dateChart = array_keys($charts);
       
        return view('admin.dashboard', [
            'activeBooking' => $activePackages->count(),
            'unActiveBooking' => $unActivePackages->count(),
            'totalPackage' => $this->totalPackage(),
            'totalCustomer' => $this->totalCustomer(),
            'dateChart' => $dateChart,
            'chartData' => $charts,
            'amount' => $amount,
            'percentage' => round($percentageDifference)
        ]);
    }


    public function allCustomer(Request $request)
    {
        $customers = User::with(['order.reference'])->where('role' , 'customer')->paginate(10)->withQueryString();

        if($request->search){

            $customers = User::with(['order.reference'])->where('role' , 'customer')  ->where('name', 'like', '%' . $request->search . '%')->paginate(10)->withQueryString();

        }

        foreach($customers as &$customer){
            $customer['paid'] = 0;
               
            foreach($customer->order as $order){
                if($order->reference && $order->reference->status  == 'berhasil'){
                    $customer['paid'] += 1;
                }
            }
        }

       
        return view('admin.customer', [
            'customers' => $customers
        ]);
    }

}
