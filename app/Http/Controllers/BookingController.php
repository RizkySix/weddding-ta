<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageBookingRequest;
use App\Ipaymu\IpaymuSignature;
use App\Models\Order;
use App\Models\Package;
use App\Models\PackageBooking;
use App\Trait\HelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

class BookingController extends Controller
{
    use HelperTrait;

    public function index(Package $package)
    {
        return view('customer.booking' , [
            'package' => $package
        ]);
    }

    public function checkDate(Request $request)
    {
       
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $response = $this->checkDateInterval($startDate , $endDate , $request->package);

        return $response;
    }

    public function store(PackageBookingRequest $request)
    {
        $validatedData = $request->validated();

        $response = $this->checkDateInterval(Carbon::parse($validatedData['start_date']) , Carbon::parse($validatedData['end_date']), $validatedData['package']);
       
        if($response > 0){
                
            $validatedData['uuid'] = $this->setUuid();

            $booking = PackageBooking::create($validatedData);

            $amount = $validatedData['amount'];
            $discountPercentage = $validatedData['discount'];
            $discountDecimal = $discountPercentage / 100;
            $discountAmount = $amount * $discountDecimal;
            $total = $amount - $discountAmount;

            
            $description = 'Pemesanan paket (' . $validatedData['package_name'] . ') mulai ' . $validatedData['start_date'] . ' sampai ' . $validatedData['end_date'];
            $orderId = strtoupper(Str::random(10) . '-LKSD');

            //hit ipaymu
            $options = [
                'product' => [$validatedData['package_name']],
                'qty' => ['1'],
                'price' => [$total],
                'description' => [$description],
                'returnUrl' => 'https://3f70-103-190-47-18.ngrok-free.app/',
                'notifyUrl' => env('IPAYMU_HOOK'),
                'cancelUrl' => 'https://ipaymu.com/cancel',
                'expired' => 24,
                'referenceId' => $orderId,
                'buyerName' => auth()->user()->name,
                'buyerEmail' => auth()->user()->email,
                'buyerPhone' => $validatedData['phone'],
                'pickupAddress' => 'Tabanan Bali',
                'paymentMethod' => 'va'
              ];

              $timestamp    = now()->format('YmdHis');
              $signature = IpaymuSignature::signature($options);

              $headers = [
                'Content-Type' => 'application/json',
                'signature' => $signature,
                'va' => env('IPAYMU_VA'),
                'timestamp' => $timestamp
              ];

              $url = 'https://sandbox.ipaymu.com/api/v2/payment';

              $response = Http::withHeaders($headers)->post($url, $options);

              $json = $response->json();
           
              //buat order
                $booking->order()->create([
                    'order_id' => $orderId,
                    'product_name' => $validatedData['package_name'],
                    'user_id' => auth()->user()->id,
                    'buyer_name' => auth()->user()->name,
                    'buyer_email' => auth()->user()->email,
                    'buyer_phone' => $validatedData['phone'],
                    'discount' => $validatedData['discount'],
                    'amount' => $validatedData['amount'],
                    'total' => $total,
                    'buyer_address' => $validatedData['address'],
                    'payment_url' => $json['Data']['Url'],
                    'expired_at' => now()->addHours(24)
                ]);

            Log::debug($response->json());

            return Redirect::away($json['Data']['Url']);
        }



        return back();
    }



    public function updateStartConfirm(PackageBooking $booking)
    {
        $booking->started_confirm_at = now();
        $booking->save();

        return back();
    }


    public function updateEndConfirm(PackageBooking $booking)
    {
        $booking->ended_confirm_at = now();
        $booking->save();

        return back();
    }

        

    public function test()
    {
        $customer = new Buyer([
            'name'          => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
                'package' => 'Paket A',
                'start_date' => now()->addDay(1)->format('Y-m-d'),
                'end_date' => now()->addDays(3)->format('Y-m-d'),
                'total_day' => 3,
                'address' => "Jawa",
                'price' => money(500000 , "IDR"),
                'total' => money(500000 , "IDR"),
            ],
        ]);
        
        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);
        
        $invoice = Invoice::make()
            ->name('Lekad Siduri Weeding Invoice')
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item)
            ->setCustomData('004124')
            ->dateFormat(now()->format('Y-m-d'))
            ->template('order');
        
            $invoiceFileName = 'invoices/INV-' . rand(10, 120) . '.pdf';
            
            // Simpan invoice dengan menggunakan metode save() dengan menyertakan path lengkap
            $invoice->filename($invoiceFileName)->save('public');

            return true;
    }
}
