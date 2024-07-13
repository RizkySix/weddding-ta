<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageStoreRequest;
use App\Http\Requests\PackageUpdateRequest;
use App\Models\Decoration;
use App\Models\Order;
use App\Models\Package;
use App\Models\PackageBooking;
use App\Models\Price;
use App\Trait\HelperTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    use HelperTrait;

    public function index()
    {
        $packages = Package::with(['decoration' , 'price'])->orderBy('created_at' , 'DESC')->paginate(5)->withQueryString();
        
        return view('package.index' , [
            'packages' => $packages
        ]);
    }

    public function create()
    {
        $decorations = Decoration::select('id' , 'name')->latest()->get();
        
        return view('package.create' , [
            'decorations' => $decorations,
            'catalogMetaData' => now()->timestamp
        ]);
    }

    public function store(PackageStoreRequest $request)
    {
        try {

            $validatedData = $request->validated();

            $validatedData['uuid'] = $this->setUuid();
            $validatedData['created_by'] = auth()->user()->name;
           
            $package = Package::create($validatedData);
            
            $validatedData['uuid'] = $this->setUuid();
            $package->price()->create($validatedData);

            //catalog store
            $getCatalogCache = Cache::get($validatedData['catalog_meta_data']);
            $catalog = [];

            foreach($getCatalogCache as $key => $value){
                $catalog[] = [
                    'package_id' => $package->id,
                    'uuid' => $this->setUuid(),
                    'path' => $key,
                    'order' => $value['order']
                ];
            }

            $package->catalog()->insert($catalog);

            Cache::forget($validatedData['catalog_meta_data']);

            if(isset($validatedData['decoration'])){
                $package->decoration()->attach($validatedData['decoration'] , ['added_at' => now()]);
            }

            return back()->with('status' , [
                'status' => 'alert-success',
                'message' => 'Paket berhasil ditambahkan!'
            ]);

        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return back()->with('status' , [
                'status' => 'alert-danger',
                'message' => 'Gagal terdapat kesalahan!'
            ]);
        }
    }


    public function edit(Package $package)
    {
        $decorations = Decoration::select('id' , 'name')->latest()->get();
        return view('package.edit' , [
            'package' => $package->load(['decoration' , 'price', 'catalog']),
            'decorations' => $decorations,
            'catalogMetaData' => now()->timestamp,
        ]);
    }


    public function update(PackageUpdateRequest $request, Package $package)
    {
      try {
        $validatedData = $request->validated();

        $package->update($validatedData);
        $package->price()->update([
            'price' => $validatedData['price'],
            'discount' => $validatedData['discount'],
        ]);

        if(isset($validatedData['decoration'])){
            $package->decoration()->syncWithPivotValues($validatedData['decoration'] , ['added_at' => now()]);
        }

        return back()->with('status' , [
            'status' => 'alert-success',
            'message' => 'Paket berhasil diperbarui!'
        ]);

      } catch (Exception $e) {
            Log::debug($e->getMessage());
            return back()->with('status' , [
                'status' => 'alert-danger',
                'message' => 'Gagal terdapat kesalahan!'
            ]);
      }
    }

    public function destroy(Package $package)
    {
        $package->destroy($package->id);

        return back()->with('status' , [
            'status' => 'alert-success',
            'message' => 'Paket berhasil dihapus!'
        ]);

    }

}
