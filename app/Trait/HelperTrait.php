<?php

namespace App\Trait;

use App\Models\Order;
use App\Models\Package;
use App\Models\PackageBooking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Facades\Invoice;

trait HelperTrait
{
    protected $iddleDay = 5;

    public function setUuid()
    {
        return Str::random() . now()->timestamp;
    }

    public function setCleanPrice(string $price)
    {
        return str_replace('.' , '' , $price);
    }

    public function checkDateInterval(Carbon $startDate ,  Carbon $endDate ,string $packageUuid)
    {

        $getPackage = Package::select('id' , 'stock')->where('uuid' , $packageUuid)->first();

        $stock = $getPackage->stock;
        
        $duplicate = [];

        $firstStep = PackageBooking::where('package_id' , $getPackage->id)->where(function($query) use($startDate , $endDate) {
            $query->whereBetween('start_date' , [$startDate->copy() , $endDate->copy()]);
        })->get();
      
        foreach($firstStep as $data){
            if(!isset($duplicate[$data->id])){
               $duplicate[$data->id] = $data->uuid;
            }
        }
        if(count($duplicate) >= $stock){
            return 0;
        }

        $secondStep = PackageBooking::where('package_id' , $getPackage->id)->where(function($query) use($startDate, $endDate) {
            $query->whereBetween('start_date' , [$endDate->copy()->addDay(1) , $endDate->copy()->addDays($this->iddleDay + 1)]);
        })->get();
      
        foreach($secondStep as $data){
            if(!isset($duplicate[$data->id])){
               $duplicate[$data->id] = $data->uuid;
            }
        }
        if(count($duplicate) >= $stock){
            return 0;
        }

        $thirdStep = PackageBooking::where('package_id' , $getPackage->id)->where(function($query) use ($startDate , $endDate) {
            $query->whereBetween('end_date' , [$startDate->copy()->subDays($this->iddleDay + 1) , $startDate->copy()->subDay(1)]);
        })->get();
      
        foreach($thirdStep as $data){
            if(!isset($duplicate[$data->id])){
               $duplicate[$data->id] = $data->uuid;
            }
        }
        if(count($duplicate) >= $stock){
            return 0;
        }
        
        $fourStep = PackageBooking::where('package_id' , $getPackage->id)->where(function($query) use($startDate , $endDate) {
            $query->whereBetween('start_date' , [$startDate->copy()->subDays($this->iddleDay + 1) , $startDate->copy()->subDay(1)]);
        })->get();

        foreach($fourStep as $data){
            if(!isset($duplicate[$data->id])){
               $duplicate[$data->id] = $data->uuid;
            }
        }
        if(count($duplicate) >= $stock){
            return 0;
        }

        $stock -= count($duplicate);

        return $stock > 0 ? $stock : 0;
    }


    public function generateInvoice($payload , $order)
    {
        $customer = new Buyer($payload);
        
        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);
        
        $invoice = Invoice::make()
            ->name('Lekad Siduri Weeding Invoice')
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item)
            ->setCustomData($order->order_id)
            ->dateFormat(now()->format('Y-m-d'))
            ->template('order');
        
            $invoiceFileName = 'invoices/INV-' . $order->order_id;
            
            // Simpan invoice dengan menggunakan metode save() dengan menyertakan path lengkap
            $invoice->filename($invoiceFileName)->save('public');

            $order->reference()->update([
                'invoice' => $invoiceFileName
            ]);
    }


    public function getActiveBooking($search = null)
    {

        $bookings = Order::with(['reference' , 'booking'])->whereHas('reference' ,  function($reference) {
            $reference->where('status' , 'berhasil');
        })->whereHas('booking', function($booking) {
            $booking ->where('start_date', '>=' , now())
            ->orWhere('end_date' , '>' , now());
        })->get();

        if($search){
            $bookings = Order::with(['reference' , 'booking'])->whereHas('reference' ,  function($reference) {
                $reference->where('status' , 'berhasil');
            })->whereHas('booking', function($booking) {
                $booking ->where('start_date', '>=' , now())
                ->orWhere('end_date' , '>' , now());
            })
            ->where('order_id' , $search)
            ->get();
        }

        return $bookings;
    }

    public function getUnActiveBooking($search = null)
    {

        $bookings = Order::with(['reference' , 'booking'])->whereHas('reference' ,  function($reference) {
            $reference->where('status' , 'berhasil');
        })->whereHas('booking', function($booking) {
            $booking->where('end_date', '<' , now())
            ->where('ended_confirm_at' , null);
        })->get();

        if($search){
            $bookings = Order::with(['reference' , 'booking'])->whereHas('reference' ,  function($reference) {
                $reference->where('status' , 'berhasil');
            })->whereHas('booking', function($booking) {
                $booking ->where('start_date', '>=' , now())
                ->orWhere('end_date' , '>' , now());
            })
            ->where('order_id' , $search)
            ->get();
        }
        
        return $bookings;
    }

    public function totalPackage()
    {
        return Package::all()->count();
    }

    public function totalCustomer()
    {
        return User::where('role' , 'customer')->count();
    }

    public function chartData()
    {
        $orders = Order::with(['reference'])
        ->whereHas('reference', function ($reference) {
            $reference->where('status', 'berhasil')
                ->whereMonth('updated_at', now()->format('m'));
        })
        ->get();

        return $orders;
    }


    public function lastMonthOrder()
    {
        $orders = Order::with(['reference'])
        ->whereHas('reference', function ($reference) {
            $reference->where('status', 'berhasil')
                ->whereMonth('updated_at', now()->subMonths(1)->format('m'));
        })
        ->get();

      
        $amount = 0;
        foreach($orders as $order){
            $amount += $order->total;
        }

        return $amount;
    }
}