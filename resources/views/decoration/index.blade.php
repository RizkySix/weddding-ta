@extends('layouts.main')

@section('content')

    <div class="main-content">
       <section class="section">
        <div class="section-header" style="display: flex; flex-direction: column">
            <h3>Data Dekorasi</h3>
            <span class="blue-text">Lengkapi form-form dibawah dengan benar dan detail, form dengan tanda * merupakan form yang wajib. Jika belum ada decoration yang dipilih paket tidak akan ditampilkan pada halaman Customer.</span>
        </div>
     
        <div class="section-body">
               
               
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Berikut Data Dekorasi......</h4>
                            <div class="card-header-form d-flex">

                                <div class="card-header-form d-flex">
                                    <a class="btn btn-primary" href="/decoration/create">Buat dekorasi</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>Nama Dekorasi</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 30%;" >Paket Digunakan</th>
                                        <th>Aksi</th>
                                       
                                    </tr>
                                    @foreach ($decorations as $decoration)
                                    <tr>
                                        <td class="p-0 text-center">
                                           {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $decoration->name }}</td>
                                        <td>
                                            @if ($decoration->detail)
                                            {!! $decoration->detail !!}
                                            @else
                                            <span class="text-danger">DATA KOSONG</span>
                                            @endif
                                        </td>
                                        <td>
                                           @if ($decoration->package->count())
                                                @foreach ($decoration->package as $package)
                                                    <span class="mr-1">{{ $package->name }},</span> 
                                                @endforeach
                                           @else
                                           <span class="text-danger">DATA KOSONG</span>
                                           @endif
                                        
                                        </td>
                                        <td class="">
                                               <form action="/decoration/{{ $decoration->uuid }}/destroy" method="POST" class="d-flex gap-2">
                                                @csrf
                                                @method('delete')
                                                <a 
                                                href="/decoration/{{ $decoration->uuid }}/edit"
                                                class="btn btn-secondary mr-2">Perbarui</a>
                                                <button type="submit"
                                                class="btn btn-secondary mr-2">Hapus</button>
                                               </form>
        
                                            </td>

                                            
                                       
                                    </tr>
                                    @endforeach
                                </table>

                                <div class="p-4">
                                    {{ $decorations->links() }}
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
