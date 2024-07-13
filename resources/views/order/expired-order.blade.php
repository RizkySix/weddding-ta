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

                                <form action="/admin/order/expired" method="GET">
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
                                        <th>Order ID</th>
                                        <th>Nama Product</th>
                                        <th>Status</th>
                                        <th>Pemesan</th>
                                        <th>Nomor Pemesan</th>
                                        <th >Email Pemesan</th>
                                        <th>Aksi</th>
                                       
                                    </tr>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td class="p-0 text-center">
                                           {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $order->order_id }}</td>
                                        <td>{{ $order->product_name }}</td>
                                        <td>Batal/Expired</td>
                                        <td>{{ $order->buyer_name }}</td>
                                        <td>{{ $order->buyer_phone }}</td>
                                        <td>{{ $order->buyer_email }}</td>
                                       
                                        <td class="">
                                            <button type="button"
                                            onclick="orderDetail({{ $order }})"
                                            data-bs-toggle="modal" data-bs-target="#detailOrder"
                                            class="btn btn-secondary mr-2">Detail</button>
        
                                            </td>

                                            
                                       
                                    </tr>

                                    

                                    
                                    @endforeach
                                </table>

                                <div class="p-4">
                                    {{ $orders->links() }}
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
    
    <script>
        const orderDetail = (order) => {
            console.log(order)
            let total = parseInt(order.total).toLocaleString('id-ID', { style: 'decimal', minimumFractionDigits: 2 })
          
            let statusText = '';
             if (!order.reference || order.reference.status == 'pending') {
                    statusText = 'Menunggu pembayaran';
                } else if (order.reference.status == 'berhasil') {
                    statusText = 'Terbayar';
                } else {
                    statusText = 'Expired';
                }

                let expiredText = '';
                if (order.reference || order.reference.status == 'expired') {
                    expiredText = `<li class="list-group-item d-flex align-items-center gap-2">
                                        <span class="material-icons mr-2 fw-bold">Expired pada: </span>
                                        ${order.expired_at}
                                    </li>`;
                }

                let item = `
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail order ${order.product_name}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex align-items-center gap-2">
                                <span class="material-icons mr-2 fw-bold">Order ID: </span> ${order.order_id}
                            </li>
                            <li class="list-group-item d-flex align-items-center gap-2">
                                <span class="material-icons mr-2 fw-bold">Total: </span> Rp.${total}
                            </li>
                            <li class="list-group-item d-flex align-items-center gap-2">
                                <span class="material-icons mr-2 fw-bold">Penyewa: </span> ${order.buyer_name}
                            </li>
                            <li class="list-group-item d-flex align-items-center gap-2">
                                <span class="material-icons mr-2 fw-bold">Email: </span> ${order.buyer_email}
                            </li>
                            <li class="list-group-item d-flex align-items-center gap-2">
                                <span class="material-icons mr-2 fw-bold">Handphone: </span> ${order.buyer_phone}
                            </li>
                            <li class="list-group-item d-flex align-items-center gap-2">
                                <span class="material-icons mr-2 fw-bold">Lokasi sewa: </span> ${order.buyer_address}
                            </li>
                            <li class="list-group-item d-flex align-items-center gap-2">
                                <span class="material-icons mr-2 fw-bold">Tanggal sewa: </span> ${order.booking.start_date} sampai ${order.booking.end_date}
                            </li>
                            <li class="list-group-item d-flex align-items-center gap-2">
                                <span class="material-icons mr-2 fw-bold">Status pesanan: </span> ${statusText}
                            </li>
                            ${expiredText}
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>`;


            document.querySelector("#modalContent").innerHTML = item
        }
    </script>
    @endpush
@endsection
