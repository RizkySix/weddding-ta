<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function homepage()
    {
        $packages = Package::with(['catalog' , 'decoration' , 'rating', 'price'])->latest()->get();

        $data = [];
    
        foreach($packages as $key => $package){
            $discountPrice = null;
           
            if($package->price->discount > 0){
                $discountPrice = $package->price->price * ($package->price->discount / 100);
                $discountPrice = $package->price->price - $discountPrice;
                $discountPrice = number_format($discountPrice , '2' , '.' ,'.');
            }
            $data[$key] = [
                'id' => $package->id,
                'uuid' => $package->uuid,
                'package_name' => $package->name,
                'package_uuid' => $package->uuid,
                'good' => $package->rating->good,
                'normal' => $package->rating->normal,
                'bad' => $package->rating->bad,
                'normal_price' => number_format($package->price->price , '2' , '.' ,'.'),
                'discount_price' => $discountPrice
            ];
    
            foreach($package->decoration as $decoration){
                $data[$key]['decorations'][] = [
                    'decoration_name' => $decoration->name,
                    'decoration_detail' => $decoration->detail,
                ]; 
            }
    
            foreach($package->catalog as $catalog){
                $data[$key]['catalogs'][$catalog->order] = [
                    'path' => $catalog->path,
                ]; 
            }
    
            ksort($data[$key]['catalogs']);
    
            if($key % 2 === 0){
                $data[$key]['class_1'] = 'col-lg-6 order-lg-2 text-white showcase-img';
                $data[$key]['class_2'] = 'col-lg-6 order-lg-1 my-auto showcase-text';
            }else{
                $data[$key]['class_1'] = 'col-lg-6 text-white showcase-img';
                $data[$key]['class_2'] = 'col-lg-6 my-auto showcase-text';
            }
        }
    
       
        return view('welcome' , [
            'packages' => $data
        ]);
    }
}
