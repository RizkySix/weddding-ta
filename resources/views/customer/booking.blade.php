@extends('customer.partial.main')

@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        /* Menyesuaikan ukuran teks pada layar kecil */
        @media (max-width: 576px) {
            .fc {
                /* Selector umum untuk elemen FullCalendar */
                font-size: 12px;
                /* Atur ukuran teks sesuai kebutuhan */
            }
        }

        /* Untuk layar PC atau laptop */
        @media (min-width: 992px) {
            #calendar {
                height: 600px;
                /* Atur tinggi kalender untuk PC atau laptop */
            }
        }

        /* Untuk tablet atau layar dengan lebar di antara 768px dan 991px */
        @media (min-width: 768px) and (max-width: 991px) {
            #calendar {
                height: 500px;
                /* Atur tinggi kalender untuk tablet */
            }
        }

        /* Untuk layar kecil atau layar dengan lebar di bawah 768px */
        @media (max-width: 767px) {
            #calendar {
                height: 400px;
                /* Atur tinggi kalender untuk layar kecil */
            }
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">

        <div class="row px-1">
            <div class="mx-auto text-decoration-none col-lg-10">

                <div id='calendar' class="mx-auto"></div>

                <div class="detail mt-4 mb-4">
                  <div class="text-center mb-4" style="font-style:italic">
                    <span class="fw-bold">
                      Silahkan pilih tanggal booking (seret tanggal untuk booking sekaligus*)
                    </span>
                  </div>
                    <div class="card" style="background-color:antiquewhite">
                        <div class="card-body text-center">
                            <h5 class="card-title">Info ketersediaan paket ({{ $package->name }})</h5>
                            <span class="">Harga sewa perhari : @money($package->price->price , 'IDR')</span>
                            <br>
                            @if ($package->price->discount > 0)
                            <span style="font-style: italic">(*Anda akan mendapat diskon {{ $package->price->discount }}% dari total hari sewa)</span>
                            @endif
                            <br>
                            <hr>
                            <span id="date-interval" >Silahkan pilih tanggal*</span>
                            <span class="fw-bold" id="value"></span>
                            <br>
                            <button data-bs-toggle="modal" data-bs-target="#bookingModal" id="showBookingModal" class="btn btn-danger mt-2" type="button" disabled>Booking</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- Modal --}}
    <div class="modal fade" id="bookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Buat Booking</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
           
            <form action="/booking" method="POST">
              @csrf
              <label for="form-label">Paket</label>
              <input id="package_name" type="text" readonly required name="package_name" value="{{ $package->name }}" class="form-control mb-3">
              <label for="form-label">Mulai sewa</label>
              <input id="input-start-date" type="date" readonly required name="start_date" class="form-control mb-3">

              <label for="form-label">Akhir sewa</label>
              <input id="input-end-date" type="date" readonly required name="end_date" class="form-control mb-3">

              <label id="amount-label" for="form-label">Total Biaya</label>
              <input id="amount" type="text" readonly required name="amount" class="form-control mb-3">

              <label id="diskon-label" for="form-label">Total Biaya (*dipotong diskon {{ $package->price->discount }}%)</label>
              <input id="diskon_price" type="text" readonly required name="diskon_price" class="form-control mb-3">

              <label id="phone" for="form-label">No Whatsapp</label>
              <input id="phone" type="number" required name="phone" class="form-control mb-3">

              <label id="address" for="form-label">Alamat</label>
              <input id="address" type="text" required name="address" class="form-control mb-3">

              <input id="package" type="hidden" readonly required name="package" class="form-control" value="{{ $package->uuid }}">
              <input id="discount" type="hidden" readonly required name="discount" class="form-control" value="{{ $package->price->discount }}">
              <input id="package_id" type="hidden" readonly required name="package_id" class="form-control" value="{{ $package->id }}">

              <button type="submit" class="btn btn-primary mt-4">Simpan</button>
            </form>

          </div>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            const today = new Date();
            const tomorrow = new Date(today); //Buat salinan tanggal hari ini
            tomorrow.setDate(tomorrow.getDate() + 1); //Tambahkan satu hari untuk mendapatkan tanggal besok

            //Abaikan format Jam,Menit,Detik,Milisecond
            today.setHours(0, 0, 0, 0);
            tomorrow.setHours(0, 0, 0, 0);

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                aspectRatio: 1.5,
                selectable: true,
                themeSystem: 'bootstrap5',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth'
                },
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan'
                },
                select: function(info) {
                  if (info.start < tomorrow) {
                      alert('Anda hanya dapat memilih tanggal mulai dari besok.');
                      return;
                  }

                   const startDate = new Date(info.startStr);
                   const endDate = new Date(info.endStr);

                    //Menghitung selisih dalam milidetik
                    const intervalMilliSeconds = endDate - startDate;

                    //Mengonversi selisih milidetik menjadi selisih hari
                    const intervalDays = Math.floor(intervalMilliSeconds / (1000 * 60 * 60 * 24));

                    //Mengurangi satu hari dari tanggal
                    endDate.setDate(endDate.getDate() - 1);
                    //Mendapatkan tanggal yang sudah dimodifikasi dalam format "YYYY-MM-DD"
                    const endDateSubOneDay = endDate.toISOString().slice(0,10);

                    document.querySelector('#date-interval').innerHTML = info.startStr + " sampai " + endDateSubOneDay + ` (${intervalDays} hari)` + " : "

                    
                    const amount = intervalDays * {{ $package->price->price }}
                    let discountPrice = amount * ({{ $package->price->discount }} / 100)
                    discountPrice = amount - discountPrice
                
                    $.ajax({
                        url: "http://ta-wedding-decoration.test/check-date",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            start_date: info.startStr,
                            end_date: endDateSubOneDay,
                            package: "{{ $package->uuid }}"
                        },

                        success: function(data) {
                          document.querySelector('#value').innerHTML = data + " stok"
                          const showBookingElement = document.querySelector('#showBookingModal');
                          if(data == 0){
                            showBookingElement.disabled = true; 
                            showBookingElement.classList.remove('btn-primary');
                            showBookingElement.classList.add('btn-danger');
                          }else{
                            showBookingElement.disabled = false; 
                            showBookingElement.classList.add('btn-primary');
                            showBookingElement.classList.remove('btn-danger');

                            document.querySelector('#input-start-date').value = info.startStr;
                            document.querySelector('#input-end-date').value = endDateSubOneDay;
                            document.querySelector('#package_name').value = '{{ $package->name }}' + ` (${intervalDays} hari)`;

                            document.querySelector('#amount').value = amount
                            document.querySelector('#amount-label').innerHTML =  `Total Biaya (${intervalDays} hari)`

                            document.querySelector('#diskon_price').value = discountPrice
                          }
                        },
                        error: function(error) {
                            alert("Cannot get data");
                            console.log(error);
                        }
                    });
                }
            });
            calendar.render();
        });
    </script>
@endpush
