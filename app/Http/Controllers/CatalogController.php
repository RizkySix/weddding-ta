<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    public function process(Request $request)
    {
        if ($request->file('image')) {
    
            $path = $request->file('image')->store('tmp', 'public');
            $cache = json_decode($request->input('image') , true)['catalogCache'];
    
            Cache::remember($cache , 60*60*60, function() {
                return [];
            });
    
           $getCache = Cache::get($cache);
           $getCache[$path] = [
                'order' => 0,
           ];
    
           Cache::put($cache, $getCache);
        }
        return $path;
    }

    public function revert(Request $request, $metadata)
    {
        $imageName = $request->getContent();
        Storage::disk('public')->delete($imageName);
        $getCache = Cache::get($metadata);

        unset($getCache[$imageName]);
        Cache::put($metadata, $getCache);
    }

    public function reorder(Request $request, $metadata)
    {
        $getCache = Cache::get($metadata);
   
        $newOrder = json_decode($request->order, true);
       
        foreach($newOrder as $order){
            foreach($getCache as $key => &$cache){
                if($key == $order['serverId']){
                    $cache['order'] = $order['order'];
    
                    break;
                }
            }
        }
    
        Cache::put($metadata , $getCache);
    
        return true;
    }
}
