<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lekad Siduri Homepage</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/dist/library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/dist/library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">

<style>
    /* Selector untuk scrollbar pada browser WebKit */
    .scrollable::-webkit-scrollbar {
        width: 0;  /* Lebar scrollbar menjadi 0 */
        background: transparent;  /* Warna latar belakang scrollbar menjadi transparan */
    }
    
    /* Opsional: Anda juga bisa menyesuaikan gaya scroll bar lainnya */
    .scrollable::-webkit-scrollbar-thumb {
        background: transparent;  /* Warna thumb scrollbar menjadi transparan */
    }
    </style>

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container ms-auto">
                <a class="btn btn-primary" href="/item/orders"><i class="bi bi-cart-check-fill"></i></a>
                @if (!auth()->user())
                <a class="btn btn-primary" href="/login">Login</a>
                @else
                <div class="dropstart">
                    <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" type="button"><i class="bi bi-person-check-fill"></i></button>
                    <ul class="dropdown-menu ms-auto">
                        <li><a class="dropdown-item" href="/item/orders">Riwayat & Keranjang</a></li>
                       <li class="px-3">
                        <form method="POST" action="/logout" class="m">
                            @csrf
                            <button class="m-auto" style="background: none; border: none; padding: 0; font: inherit; cursor: pointer; color: blue; text-decoration: underline;">Logout</button>
                        </form>
                       </li>
                      </ul>
                </div>
               
                @endif
            </div>
        </nav>
        
        <!-- Masthead-->
        <header class="masthead object-fit-cover" style="background-image: url(https://loremflickr.com/1200/720/wedding)">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
                            <h1 class="mb-5 text-white">Meriahkan Acara Anda Dengan Dekorasi Professional Dan Eksentrik!</h1>
                            <!-- Signup form-->
                            <!-- * * * * * * * * * * * * * * *-->
                            <!-- * * SB Forms Contact Form * *-->
                            <!-- * * * * * * * * * * * * * * *-->
                            <!-- This form is pre-integrated with SB Forms.-->
                            <!-- To make this form functional, sign up at-->
                            <!-- https://startbootstrap.com/solution/contact-forms-->
                            <!-- to get an API token!-->
                         {{--    <form class="form-subscribe" id="contactForm" data-sb-form-api-token="API_TOKEN">
                                <!-- Email address input-->
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control form-control-lg" id="emailAddress" type="email" placeholder="Email Address" data-sb-validations="required,email" />
                                        <div class="invalid-feedback text-white" data-sb-feedback="emailAddress:required">Email Address is required.</div>
                                        <div class="invalid-feedback text-white" data-sb-feedback="emailAddress:email">Email Address Email is not valid.</div>
                                    </div>
                                    <div class="col-auto"><button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button></div>
                                </div>
                                <!-- Submit success message-->
                                <!---->
                                <!-- This is what your users will see when the form-->
                                <!-- has successfully submitted-->
                                <div class="d-none" id="submitSuccessMessage">
                                    <div class="text-center mb-3">
                                        <div class="fw-bolder">Form submission successful!</div>
                                        <p>To activate this form, sign up at</p>
                                        <a class="text-white" href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                    </div>
                                </div>
                                <!-- Submit error message-->
                                <!---->
                                <!-- This is what your users will see when there is-->
                                <!-- an error submitting the form-->
                                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Icons Grid-->
        <section class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-award-fill m-auto text-primary"></i></div>
                            <h3>Paket Terlengkap</h3>
                            <p class="lead mb-0">Menyediakan paket-paket dekor lengkap dan variatif!</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi bi-emoji-sunglasses-fill m-auto text-primary"></i></i></div>
                            <h3>Berkualitas</h3>
                            <p class="lead mb-0">Kualitas barang dan peralatan dijamin terbaik dan proper!</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-piggy-bank-fill m-auto text-primary"></i></div>
                            <h3>Murah</h3>
                            <p class="lead mb-0">Mengcover untuk segala kondisi kantong anda!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Image Showcases-->
        <section class="showcase">
            <div class="container-fluid p-0">
                @foreach ($packages as $package)
                <div class="row g-0"> {{-- owl-carousel owl-theme --}}
                    <div class="{{ $package['class_1'] }}" >
                        <div class="owl-carousel owl-theme">
                         @foreach ($package['catalogs'] as $catalog)
                         <img src="{{ $catalog['path'] }}" alt="broke" style="height:500px; object-fit:cover">
                        
                         @endforeach
                        </div>
                     </div>
                    <div class="scrollable  z-3 bg-white {{ $package['class_2'] }}" style="max-height: 600px; height:600px; position: relative;">
                     <div class="scrollable h-100" style="position: relative; overflow-y: auto;">
                        <div class="sticky-top z-3 bg-white" style="box-shadow: 0px 10px 10px -15px #111;">
                            <div class="d-flex w-100 ">
                             <h2>{{ $package['package_name'] }}</h2>
     
                             <div class="d-flex align-items-center ms-auto" data-bs-toggle="modal" data-bs-target="#rating{{ $package['id'] }}" style="cursor: pointer">
                                 😁{{ $package['good'] }}
                                 🙂{{ $package['normal'] }}
                                 😡{{ $package['bad'] }}
                             </div>
                            </div>
                            </div>
                             <p class="lead mb-0" class="height:300px;">
                                 Dengan paket dekorasi yang didapat,
                                 <br>
                                 @foreach ($package['decorations'] as $decoration)
                                     <p>
                                         {{ $decoration['decoration_name'] }} :
                                         {!! $decoration['decoration_detail'] !!}
                                     </p>
                                 @endforeach
                             </p>
     
                            <div class="sticky-bottom z-3 bg-white py-2" style="box-shadow: 0px -10px 10px -15px #111;">
                             <div class="d-flex w-100">
                                <a href="{{ route('booking.view' , $package['uuid']) }}" class="btn btn-primary">Pesan sekarang</a>
                                 <div class="ms-auto">
                                    @money($package['normal_price'] , 'IDR')
                                 </div>
                             </div>
                            </div>
                     </div>
                    </div>
                </div>

                {{-- Rating modal --}}
                <div class="modal fade" id="rating{{ $package['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Beri rating paket ini</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formRating{{ $package['id'] }}" action="{{ route('feedback.rating' , $package['uuid']) }}" method="POST" class="feedbackForm mx-auto">
                                @csrf
                                
                                <div class="d-flex gap-4 w-50 mx-auto">
                                    <div onclick="submitRating('formRating{{ $package['id'] }}', 'good')" class="mx-auto">
                                        <label for="good{{ $package['id'] }}" style="font-size:50px; cursor: pointer;">😁</label>
                                        <input type="radio" id="good{{ $package['id'] }}" name="feedback" value="good" style="display: none;">
                                    </div>
                                    <div onclick="submitRating('formRating{{ $package['id'] }}', 'normal')" class="mx-auto">
                                        <label for="normal{{ $package['id'] }}" style="font-size:50px; cursor: pointer;">🙂</label>
                                        <input type="radio" id="normal{{ $package['id'] }}" name="feedback" value="normal" style="display: none;">
                                    </div>
                                    <div onclick="submitRating('formRating{{ $package['id'] }}', 'bad')" class="mx-auto">
                                        <label for="bad{{ $package['id'] }}" style="font-size:50px; cursor: pointer;">😡</label>
                                        <input type="radio" id="bad{{ $package['id'] }}" name="feedback" value="bad" style="display: none;">
                                    </div>
                                </div>
                            </form>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                @endforeach
              
            </div>
        </section>
        <!-- Testimonials-->
        <section class="testimonials text-center bg-light">
            <div class="container">
                <h2 class="mb-5">Pendapat para penyewa...</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="assets/testimonials-1.jpg" alt="..." />
                            <h5>Luh Diana</h5>
                            <p class="font-weight-light mb-0">"Luar biasa bagus dan berkualitas!"</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="assets/testimonials-2.jpg" alt="..." />
                            <h5>Kadek Riko S.P</h5>
                            <p class="font-weight-light mb-0">"Pelayanan dan dekorasi terbaik, lengkap dan termurah!"</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                            <img class="img-fluid rounded-circle mb-3" src="assets/testimonials-3.jpg" alt="..." />
                            <h5>Winda Sayuti</h5>
                            <p class="font-weight-light mb-0">"Acara menjadi meriah, dengan photobooth yang disediakan!"</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Call to Action-->
        <section class="call-to-action text-white text-center object-fit-cover" id="signup" style="background-image: url(https://loremflickr.com/1200/720/clap)">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <h2 class="mb-4">Berminat untuk menyewa? Buat akun sekarang!</h2>
                        <!-- Signup form-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                       {{--  <form class="form-subscribe" id="contactFormFooter" data-sb-form-api-token="API_TOKEN">
                            <!-- Email address input-->
                            <div class="row">
                                <div class="col">
                                    <input class="form-control form-control-lg" id="emailAddressBelow" type="email" placeholder="Email Address" data-sb-validations="required,email" />
                                    <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:required">Email Address is required.</div>
                                    <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:email">Email Address Email is not valid.</div>
                                </div>
                                <div class="col-auto"><button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button></div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    <p>To activate this form, sign up at</p>
                                    <a class="text-white" href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                        </form> --}}

                        <div class="col-auto"><a class="btn btn-primary btn-lg" id="submitButton" href="/register" type="button">Sign up</a></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                        <ul class="list-inline mb-2">
                            <li class="list-inline-item"><a href="#!">Tentang</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Contact</a></li>
                            <li class="list-inline-item">⋅</li>
                            
                            <li class="list-inline-item"><a href="#!">Privacy Policy</a></li>
                        </ul>
                        <p class="text-muted small mb-4 mb-lg-0">&copy; Lekad Siduri Decor 2024.</p>
                    </div>
                    <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-facebook fs-3"></i></a>
                            </li>
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-twitter fs-3"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!"><i class="bi-instagram fs-3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="/js/scripts.js"></script>
       
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="{{ asset('/dist/library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
        
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        <script>
            $(document).ready(function(){
                $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: true,
      autoplay: true,
      autoplayTimeout: 2000, // Ganti sesuai kebutuhan
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
    });
});
        </script>

<script>
     const submitRating = (formId, value) => {
        const input = document.querySelector(`#${formId} input[value="${value}"]`);
        input.checked = true;
        document.querySelector(`#${formId}`).submit();
    }
</script>
    </body>
</html>
