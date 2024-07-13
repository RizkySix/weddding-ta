@extends('customer.partial.main')

@push('style')
<style>
    @media (max-width: 991.98px) {
    .order-item {
      flex-direction: column; /* Mengatur tata letak menjadi kolom */
    }

    .image-hero {
        width: 300px
    }
  }
</style>
@endpush

@section('content')


    <div class="main-content">
      <section class="section">
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-lg-10">
                    <div class="p-2">
                        <h4>Orderan Booking Kamu</h4>
                       
                    </div>
                    <div class="orders">
                        @foreach ($orders as $order)
                        <div class="order-item d-flex justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded">
                            <div class="mr-1"><img class="image-hero rounded object-fit-cover" src="{{ $order->booking->package->catalog[0]->path }}" width="100"></div>
                            <div class="d-flex flex-column align-items-center product-details"><span class="font-weight-bold">{{ $order->product_name }}</span>
                                <div class="d-flex flex-row product-desc">
                                    <div class="size mr-1"><span class="text-grey">Dari:</span><span class="font-weight-bold"> {{ \Carbon\Carbon::parse($order->booking->start_date)->format(' d M Y') }}</span></div>
                                    ➡️
                                    <div class="color"><span class="text-grey">Sampai:</span><span class="font-weight-bold">{{ \Carbon\Carbon::parse($order->booking->end_date)->format(' d M Y') }}</span></div>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center qty">
                               @if (!$order->reference || $order->reference->status == 'pending')
                               <h6 class="text-grey mt-1 mr-1 ml-1">Menunggu pembayaran</h6>
                               @elseif($order->reference->status == 'berhasil')
                               <h6 class="text-grey mt-1 mr-1 ml-1">Terbayar</h6>
                               @else
                               <h6 class="text-grey mt-1 mr-1 ml-1">Expired</h6>
                               @endif
                            </div>
                            <div>
                                <h5 class="text-grey">@money($order->total , 'IDR')</h5>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a target="__blank" href="{{ $order->payment_url }}">
                                    <i class="fa-brands fa-cc-amazon-pay" style="font-size: 21px;"></i>
                                </a>
    
                                <a type="button" data-bs-toggle="modal" data-bs-target="#detailOrder{{ $order->id }}">
                                    <i class="fa-solid fa-eye" style="font-size: 21px;"></i>
                                </a>
                            </div>
                        </div>
                     
    
                        {{-- Modal detail --}}
                        <div class="modal fade" id="detailOrder{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Detail order {{ $order->product_name }}</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex align-items-center gap-2">
                                            <span class="material-icons mr-2 fw-bold">Order ID: </span> {{ $order->order_id }}
                                        </li>
                                        <li class="list-group-item d-flex align-items-center gap-2">
                                            <span class="material-icons mr-2 fw-bold">Penyewa: </span> {{ $order->buyer_name }}
                                        </li>
                                        <li class="list-group-item d-flex align-items-center gap-2">
                                            <span class="material-icons mr-2 fw-bold">Email: </span> {{ $order->buyer_email }}
                                        </li>
                                        <li class="list-group-item d-flex align-items-center gap-2">
                                            <span class="material-icons mr-2 fw-bold">Handphone: </span> {{ $order->buyer_phone }}
                                        </li>
                                        <li class="list-group-item d-flex align-items-center gap-2">
                                            <span class="material-icons mr-2 fw-bold">Lokasi sewa: </span> {{ $order->buyer_address }}
                                        </li>
                                        <li class="list-group-item d-flex align-items-center gap-2">
                                            <span class="material-icons mr-2 fw-bold">Status pesanan: </span>
                                            @if (!$order->reference || $order->reference->status == 'pending')
                                           Menunggu pembayaran
                                            @elseif($order->reference->status == 'berhasil')
                                           Terbayar
                                            @else
                                           Expired
                                            @endif
                                        </li>

                                        @if (!$order->reference || $order->reference->status == 'pending')
                                        <li class="list-group-item d-flex align-items-center gap-2">
                                            <span class="material-icons mr-2 fw-bold">Expired pada: </span>
                                             {{ \Carbon\Carbon::parse($order->expired_at)->format('d M Y') }}
                                           
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                    </div>
                   
                </div>
            </div>
        </div>
      </section>
    </div>

@endsection
