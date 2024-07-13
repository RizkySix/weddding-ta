<?php

namespace App\Http\Controllers;

use App\Mail\PaidBookingMail;
use App\Models\Order;
use App\Models\OrderReference;
use App\Trait\HelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WebhookController extends Controller
{
    use HelperTrait;
    public function webhook(Request $request)
    {
    
        Log::debug($request);

        if(isset($request['status'])){
            $getOrder = Order::with(['booking.package'])->where('order_id' , $request['reference_id'])->first();
            $getReference = OrderReference::where('order_id' , $getOrder->id)->first();

            if($request['status'] == 'pending' && !$getReference){
                $getOrder->trx_id = $request['trx_id'];
                $getOrder->save();

                $getOrder->reference()->create([
                    'uuid' => $this->setUuid(),
                    'via' => $request['via'],
                    'status' => $request['status'],
                    'channel' => $request['channel'],
                    'va' => $request['va'],
                ]);
            }else{
              
                if(!$getReference){
                        $getOrder->reference()->create([
                            'uuid' => $this->setUuid(),
                            'via' => $request['via'],
                            'status' => $request['status'],
                            'channel' => $request['channel'],
                            'va' => $request['va'],
                        ]);
                }else{
                        $getReference->update([
                            'status' => $request['status'],
                        ]);
                }
            }


            if($request['status'] == 'berhasil'){
              
                $start_date = Carbon::parse($getOrder->booking->start_date);
                $end_date = Carbon::parse($getOrder->booking->end_date);
              

                // Menghitung selisih hari
                $total_day = $start_date->diffInDays($end_date) + 1;

                $payload = [
                     'name' => $getOrder->buyer_name,
                    'custom_fields' => [
                        'email' => $getOrder->buyer_email,
                        'phone' => $getOrder->buyer_phone,
                        'package' => $getOrder->booking->package->name,
                        'start_date' => Carbon::parse($getOrder->booking->start_date)->format('Y-m-d'),
                        'end_date' => Carbon::parse($getOrder->booking->end_date)->format('Y-m-d'),
                        'total_day' => $total_day,
                        'address' =>  $getOrder->buyer_address,
                        'discount' =>  $getOrder->discount,
                        'price' => money($getOrder->amount , "IDR"),
                        'total' => money($getOrder->total , "IDR"),
                    ],
                ];


                $this->generateInvoice($payload , $getOrder);

                $pdfPath = '/invoices/INV-' . $getOrder->order_id . '.pdf';
                
                Mail::to($getOrder->buyer_email)->send(new PaidBookingMail($pdfPath , $getOrder));
            }

            return response('OK' , 200);
        }
    }
}
