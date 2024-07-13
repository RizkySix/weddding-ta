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
                            <h4>Berikut Data Order......</h4>
                            <div class="card-header-form d-flex">

                                <form action="/admin/customer" method="GET">
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control"
                                            name="search"
                                            placeholder="Cari berdasarkan nama...">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Tanggal Bergabung</th>
                
                                        <th>Order Dibuat</th>
                                        <th>Order Closing</th>
                                       
                                    </tr>
                                    @foreach ($customers as $customer)
                                    <tr>
                                        <td class="p-0 text-center">
                                           {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                     
                                        <td>{{ \Carbon\Carbon::parse($customer->created_at)->format('D d M Y') }}</td>
                                        <td>{{ $customer->order()->count() }}</td>
                                        <td>{{ $customer->paid }}</td>
                                

                                            
                                       
                                    </tr>

                                    

                                    
                                    @endforeach
                                </table>

                                <div class="p-4">
                                    {{ $customers->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>
        

        @push('modal')
        <div class="modal fade" id="detailOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" id="modalContent">
              
              </div>
            </div>
          </div>
        @endpush

       </section>
    </div>
    @push('scripts')
         <!-- JS Libraies -->
    <script src="{{ asset('dist/library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('dist/js/page/components-table.js') }}"></script>
    
  
    @endpush
@endsection
