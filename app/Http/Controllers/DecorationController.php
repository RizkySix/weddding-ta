<?php

namespace App\Http\Controllers;

use App\Http\Requests\DecorationStoreRequest;
use App\Http\Requests\DecorationUpdateRequest;
use App\Models\Decoration;
use App\Trait\HelperTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DecorationController extends Controller
{
    use HelperTrait;

    public function index()
    {
        $decorations = Decoration::with(['package'])->orderBy('created_at' , 'DESC')->paginate(5)->withQueryString();
        
        return view('decoration.index' , [
            'decorations' => $decorations
        ]);
    }

    public function create()
    {
        return view('decoration.create');
    }

    public function store(DecorationStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $validatedData['uuid'] = $this->setUuid();
            $validatedData['created_by'] = auth()->user()->name;
            Decoration::create($validatedData);

            return back()->with('status' , [
                'status' => 'alert-success',
                'message' => 'Dekorasi berhasil ditambahkan!'
            ]);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return back()->with('status' , [
                'status' => 'alert-danger',
                'message' => 'Gagal terdapat kesalahan!'
            ]);
        }
    }


    public function edit(Decoration $decoration)
    {
        return view('decoration.edit' , [
            'decoration' => $decoration
        ]);
    }

    public function update(DecorationUpdateRequest $request, Decoration $decoration)
    {
        try {
            $validatedData = $request->validated();

            $decoration->update($validatedData);

            return back()->with('status' , [
                'status' => 'alert-success',
                'message' => 'Dekorasi berhasil diperbarui!'
            ]);
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return back()->with('status' , [
                'status' => 'alert-danger',
                'message' => 'Gagal terdapat kesalahan!'
            ]);
        }
    }
}
