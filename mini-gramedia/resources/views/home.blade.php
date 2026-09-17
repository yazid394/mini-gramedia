@extends('layout.app')

@push('styles')
    <style>
        .slick-prev:before,
        .slick-next:before {
            color: #333;
        }
    </style>
@endpush()
@section('content')
    <div class="container-xl py-4">
        @if (Session::get('success'))
            <div class="alert alert-important alert-success alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>{{ Session::get('success') }}</div>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        @if (Session::get('error'))
            <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <circle cx="12" cy="12" r="9" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                    </div>
                    <div>{{ Session::get('error') }}</div>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif
        {{-- Banner Utama --}}
        <div id="carousel-sample" class="carousel slide rounded-3 overflow-hidden" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" alt=""
                        src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" alt=""
                        src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" alt=""
                        src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" alt=""
                        src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" alt=""
                        src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                </div>
            </div>
            <a class="carousel-control-prev" data-bs-target="#carousel-sample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" data-bs-target="#carousel-sample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
        <div class="mt-4">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-yellow text-yellow-fg p-2">
                    <i class="fa-solid fa-crown fs-3"></i>
                </span>
                <h2 class="mt-3 text-dark">Paket Langganan</h2>
            </div>

            <div class="row g-4">
                @foreach ($subscriptionPackages as $subscriptionPackage)
                    <div class="col-md-4">
                        <div class="card mt-3 h-100"
                            style="background: linear-gradient(135deg, #ffffff 0%, {{ $subscriptionPackage->color }} 200%);">
                            <div class="card-body row">
                                <div class="col-4"></div>
                                <div class="col-6 text-center text-dark">
                                    <h2 style="font-weight: bold;">{{ $subscriptionPackage->name }}</h2>
                                    <p class="text-secondary" style="font-weight: bold; margin: 0 !important;">
                                        {{ $subscriptionPackage->description }}</p>
                                    <div>
                                        <span style="font-size: 2rem; font-weight: bold;" class="text-warning">Rp
                                            {{ number_format($subscriptionPackage->price, 0, ',', '.') }}</span>
                                        <br />
                                        <span style="font-weight: bold; margin: 0 !important;" class="text-secondary">/30
                                            Days</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        {{-- <div class="col-md-4">
                    <div class="card h-100" style="background: linear-gradient(135deg, #ffffff 0%, #a7e8f1 100%)">
                        <div class="card-body row">
                            <div class="col-4"></div>
                            <div class="col-6 text-center text-dark">
                                <h2 style="font-weight: bold;">FICTION</h2>
                                <P class="text-secondary" style="font-weight: bold; margin: 0 !important;">PACKAGE</P>
                                <div>
                                    Rp <span style="font-size: 2rem; font-weight: bold;"
                                        class="text-warning">79.000</span><br>
                                    <span style="font-weight: bold; margin: 0 !important;" class="text-secondary">/30
                                        Days</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
        {{-- <div class="col-md-4">
                    <div class="card h-100" style="background: linear-gradient(135deg, #ffffff 0%, #ca62c2 100%)">
                        <div class="card-body row">
                            <div class="col-4"></div>
                            <div class="col-6 text-center text-dark">
                                <h2 style="font-weight: bold;">PREMIUM</h2>
                                <P class="text-secondary" style="font-weight: bold; margin: 0 !important;">PACKAGE</P>
                                <div>
                                    Rp <span style="font-size: 2rem; font-weight: bold;"
                                        class="text-warning">109.000</span><br>
                                    <span style="font-weight: bold; margin: 0 !important;" class="text-secondary">/30
                                        Days</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
        </div>
    </div>

    <div class="mt-4">
        <div class="d-flex align-items-center gap-2 mb-4">
            <h2 class="mt-3 text-dark" style="font-weight: bold;">Buku Baru Di Rilis</h2>
        </div>

        <div id="wrapper-slide">
            <div class="px-2">
                <div class="card">
                    <div class="card-body">
                        <img class="d-block mx-auto w-75 h-50"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTVCgj5UJ0embiBvxoBI0iq8JI95VsGLg4pULJbwDBUzA&s=10" />
                        <div class="d-flex gap-2 mt-2 text-center  ">
                            <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                            <p class="badge">3+</p>
                        </div>
                        <div>
                            <h5><span style="font-size: 0.8rem;" class="text-secondary">Silverqueen</span></h5><br>
                            <span style="font-size: 1rem;">Card with Title</span></h5>
                            <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 49.000</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-2">
                <div class="card">
                    <div class="card-body">
                        <img class="d-block mx-auto w-75 h-50"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTCLocrrm6JhpH2PDU1eEBKA3UdaFvYdQczoH-2JDluUA&s=10" />
                        <div class="d-flex gap-2 mt-2 text-center  ">
                            <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                            <p class="badge">3+</p>
                        </div>
                        <div>
                            <h5><span style="font-size: 0.8rem;" class="text-secondary">Silverqueen</span></h5><br>
                            <span style="font-size: 1rem;">Card with Title</span></h5>
                            <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 49.000</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-2">
                <div class="card">
                    <div class="card-body">
                        <img class="d-block mx-auto w-75 h-50"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTCjfv8sDUtc2obHo-oipsjHhH2pAwvo_4mgueJdGK5bw&s=10" />
                        <div class="d-flex gap-2 mt-2 text-center  ">
                            <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                            <p class="badge">3+</p>
                        </div>
                        <div>
                            <h5><span style="font-size: 0.8rem;" class="text-secondary">Silverqueen</span></h5><br>
                            <span style="font-size: 1rem;">Card with Title</span></h5>
                            <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 49.000</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-2">
                <div class="card">
                    <div class="card-body">
                        <img class="d-block mx-auto w-75 h-50"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBcZbIJYO9LW99lvcM4rKgmdTo0uSkJSWykcdFFiyH8Q&s" />
                        <div class="d-flex gap-2 mt-2 text-center  ">
                            <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                            <p class="badge">3+</p>
                        </div>
                        <div>
                            <h5><span style="font-size: 0.8rem;" class="text-secondary">Silverqueen</span></h5><br>
                            <span style="font-size: 1rem;">Card with Title</span></h5>
                            <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 49.000</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-2">
                <div class="card">
                    <div class="card-body">
                        <img class="d-block mx-auto w-75 h-50"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8bXKNhgkj7rrxBFcoIQ5ll4bUdKHTH_dx9VF7chdckw&s=10" />
                        <div class="d-flex gap-2 mt-2 text-center  ">
                            <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                            <p class="badge">3+</p>
                        </div>
                        <div>
                            <h5><span style="font-size: 0.8rem;" class="text-secondary">Silverqueen</span></h5><br>
                            <span style="font-size: 1rem;">Card with Title</span></h5>
                            <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 49.000</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-2">
                <div class="card">
                    <div class="card-body">
                        <img class="d-block mx-auto w-75 h-50"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2YGgfZ_MLkkIXjwto96afP2L94K13M8EZRQ52SN2UAw&s=10" />
                        <div class="d-flex gap-2 mt-2 text-center  ">
                            <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                            <p class="badge">3+</p>
                        </div>
                        <div>
                            <h5><span style="font-size: 0.8rem;" class="text-secondary">Silverqueen</span></h5><br>
                            <span style="font-size: 1rem;">Card with Title</span></h5>
                            <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 49.000</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-2">
                <div class="card">
                    <div class="card-body">
                        <img class="d-block mx-auto w-75 h-50"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTB8eB0qIPB1g4N3PL2L9FdsOgrRL1Muxnsu8QvOUkX5g&s=10" />
                        <div class="d-flex gap-2 mt-2 text-center  ">
                            <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                            <p class="badge">3+</p>
                        </div>
                        <div>
                            <h5><span style="font-size: 0.8rem;" class="text-secondary">Silverqueen</span></h5><br>
                            <span style="font-size: 1rem;">Card with Title</span></h5>
                            <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 49.000</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-2">
                <div class="card">
                    <div class="card-body">
                        <img class="d-block mx-auto w-75 h-50"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdBUE3eRkJnVe0qbUCRwbNVI7gPo-BiAFsVlrPhT6eGA&s=10" />
                        <div class="d-flex gap-2 mt-2 text-center  ">
                            <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                            <p class="badge">3+</p>
                        </div>
                        <div>
                            <h5><span style="font-size: 0.8rem;" class="text-secondary">Silverqueen</span></h5><br>
                            <span style="font-size: 1rem;">Card with Title</span></h5>
                            <h4 style="font-size: 1.2rem; font-weight: bold;">Rp 49.000</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- buku gratis --}}
    <div class="mt-4">
        <div class="d-flex align-items-center gap-2 mb-4">
            <h2 class="mt-3 text-dark" style="font-weight: bold">Buku Gratis</h2>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card d-flex flex-column">
                    <div class="row row-0 flex-fill">
                        <div class="col-md-3">
                            <a href="#">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlrndeC24B3zvs_-kTHhIUW-_L-GEYoqs-adkqLMVpFQ&s=10"
                                    class="w-100 h-100 object-cover" alt="Card side image" />
                            </a>
                        </div>
                        <div class="col">
                            <div class="card-body h-full d-flex flex-column">
                                <h3 class="card-title">
                                    <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                                </h3>
                                <div class="text-secondary">
                                    Penulis
                                    <br><span class="text-dark">Judul Buku</span>
                                </div>
                                <div class="d-flex align-items-center pt-4 mt-auto">
                                    <h3><span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                        <span class="text-dark">Rp 0</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card d-flex flex-column">
                    <div class="row row-0 flex-fill">
                        <div class="col-md-3">
                            <a href="#">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlrndeC24B3zvs_-kTHhIUW-_L-GEYoqs-adkqLMVpFQ&s=10"
                                    class="w-100 h-100 object-cover" alt="Card side image" />
                            </a>
                        </div>
                        <div class="col">
                            <div class="card-body h-full d-flex flex-column">
                                <h3 class="card-title">
                                    <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                                </h3>
                                <div class="text-secondary">
                                    Penulis
                                    <br><span class="text-dark">Judul Buku</span>
                                </div>
                                <div class="d-flex align-items-center pt-4 mt-auto">
                                    <h3><span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                        <span class="text-dark">Rp 0</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card d-flex flex-column">
                    <div class="row row-0 flex-fill">
                        <div class="col-md-3">
                            <a href="#">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlrndeC24B3zvs_-kTHhIUW-_L-GEYoqs-adkqLMVpFQ&s=10"
                                    class="w-100 h-100 object-cover" alt="Card side image" />
                            </a>
                        </div>
                        <div class="col">
                            <div class="card-body h-full d-flex flex-column">
                                <h3 class="card-title">
                                    <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                                </h3>
                                <div class="text-secondary">
                                    Penulis
                                    <br><span class="text-dark">Judul Buku</span>
                                </div>
                                <div class="d-flex align-items-center pt-4 mt-auto">
                                    <h3><span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                        <span class="text-dark">Rp 0</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card d-flex flex-column">
                    <div class="row row-0 flex-fill">
                        <div class="col-md-3">
                            <a href="#">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlrndeC24B3zvs_-kTHhIUW-_L-GEYoqs-adkqLMVpFQ&s=10"
                                    class="w-100 h-100 object-cover" alt="Card side image" />
                            </a>
                        </div>
                        <div class="col">
                            <div class="card-body h-full d-flex flex-column">
                                <h3 class="card-title">
                                    <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                                </h3>
                                <div class="text-secondary">
                                    Penulis
                                    <br><span class="text-dark">Judul Buku</span>
                                </div>
                                <div class="d-flex align-items-center pt-4 mt-auto">
                                    <h3><span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                        <span class="text-dark">Rp 0</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card d-flex flex-column">
                    <div class="row row-0 flex-fill">
                        <div class="col-md-3">
                            <a href="#">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlrndeC24B3zvs_-kTHhIUW-_L-GEYoqs-adkqLMVpFQ&s=10"
                                    class="w-100 h-100 object-cover" alt="Card side image" />
                            </a>
                        </div>
                        <div class="col">
                            <div class="card-body h-full d-flex flex-column">
                                <h3 class="card-title">
                                    <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                                </h3>
                                <div class="text-secondary">
                                    Penulis
                                    <br><span class="text-dark">Judul Buku</span>
                                </div>
                                <div class="d-flex align-items-center pt-4 mt-auto">
                                    <h3><span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                        <span class="text-dark">Rp 0</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card d-flex flex-column">
                    <div class="row row-0 flex-fill">
                        <div class="col-md-3">
                            <a href="#">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlrndeC24B3zvs_-kTHhIUW-_L-GEYoqs-adkqLMVpFQ&s=10"
                                    class="w-100 h-100 object-cover" alt="Card side image" />
                            </a>
                        </div>
                        <div class="col">
                            <div class="card-body h-full d-flex flex-column">
                                <h3 class="card-title">
                                    <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                                </h3>
                                <div class="text-secondary">
                                    Penulis
                                    <br><span class="text-dark">Judul Buku</span>
                                </div>
                                <div class="d-flex align-items-center pt-4 mt-auto">
                                    <h3><span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                        <span class="text-dark">Rp 0</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#wrapper-slide').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>
@endpush
