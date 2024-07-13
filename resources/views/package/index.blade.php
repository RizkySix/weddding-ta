@extends('layouts.main')

@section('content')

    <div class="main-content">
       <section class="section">
        <div class="section-header" style="display: flex; flex-direction: column">
            <h3>Data Paket</h3>
            <span class="blue-text">Lengkapi form-form dibawah dengan benar dan detail, form dengan tanda * merupakan form yang wajib. Jika belum ada decoration yang dipilih paket tidak akan ditampilkan pada halaman Customer.</span>
        </div>
     
        <div class="section-body">
               
               
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Berikut Data Paket......</h4>
                            <div class="card-header-form d-flex">
                                <a class="btn btn-primary" href="/package/create">Buat paket</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Diskon</th>
                                        <th style="width: 30%;" >Dekorasi Paket</th>
                                        <th>Aksi</th>
                                       
                                    </tr>
                                    @foreach ($packages as $package)
                                    <tr>
                                        <td class="p-0 text-center">
                                           {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $package->name }}</td>
                                        <td class="align-middle">
                                            @if ($package->price)
                                            @money($package->price->price , 'IDR')
                                            @else
                                            <span class="text-danger">DATA KOSONG</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($package->price)
                                            {{ $package->price->discount ?? 0 }}%
                                            @else
                                            <span class="text-danger">DATA KOSONG</span>
                                            @endif
                                        </td>
                                        <td>
                                           @if ($package->decoration->count())
                                                @foreach ($package->decoration as $decoration)
                                                    <span class="mr-1">{{ $decoration->name }},</span> 
                                                @endforeach
                                           @else
                                           <span class="text-danger">DATA KOSONG</span>
                                           @endif
                                        
                                        </td>
                                        <td class="">
                                               <form action="/package/{{ $package->uuid }}/destroy" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a 
                                                href="/package/{{ $package->uuid }}/edit"
                                                class="btn btn-secondary mr-2">Perbarui</a>
                                                <button type="submit"
                                                class="btn btn-secondary mr-2">Hapus</button>
                                               </form>
        
                                            </td>

                                            
                                       
                                    </tr>
                                    @endforeach
                                </table>

                                <div class="p-4">
                                    {{ $packages->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>
        
       </section>
    </div>
    @push('scripts')
         <!-- JS Libraies -->
    <script src="{{ asset('dist/library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('dist/js/page/components-table.js') }}"></script>
    @endpush
@endsection
