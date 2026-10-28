<link rel="stylesheet">
@extends('layouts.app')


@section('content')
        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0" style="border:5px solid red ">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">Find A <span class="text-primary">Perfect Place</span> To Live With Your Family</h1>
                    <p class="animated fadeIn mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet
                        sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                    <a href="" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Get Started</a>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <div class="owl-carousel header-carousel">
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="{{ asset('img/carousel-1.jpg') }}" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
                <!-- Search Start -->
                <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
                    <div class="container">
                        <div class="row g-2">
                            <div class="col-md-10">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select border-0 py-3">
                                            <option selected>Property Category</option>
                                            @foreach ($categories as $category)
                                            <option >{{ $category->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select border-0 py-3">
                                            <option selected>Location</option>
                                            <option value="1">Location 1</option>
                                            <option value="2">Location 2</option>
                                            <option value="3">Location 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-dark border-0 w-100 py-3">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Search End -->
                <div class="container-xxl bg-white p-0">
                    <!-- Spinner Start -->
                    {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div> --}}
                    <!-- Spinner End -->

                    <!-- Category Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Property Types</h1>
            <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
        </div>
        <div class="row g-4">
            @foreach ($categories as $category)
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.{{ $loop->iteration }}s">
                <a class="cat-item d-block bg-light text-center rounded p-3" href="">
                    <div class="rounded p-4">
                        <div class="icon mb-3">
                            <img class="img-fluid" src="{{ asset('img/' . $category->name . '.png') }}" alt="Icon">
                        </div>
                        <h6>{{ $category->name }}</h6>
                        <span>{{ $category->properties_count }} Properties</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Category End -->
            
                    <!-- About Start -->
                    <div class="container-xxl py-5">
                        <div class="container">
                            <div class="row g-5 align-items-center">
                                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                                        <img class="img-fluid w-100" src="{{ asset('img/about.jpg') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                    <h1 class="mb-4">#1 Place To Find The Perfect Property</h1>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit impedit a optio libero id sapiente consequatur cupiditate repellat, repellendus reprehenderit, dignissimos quae quisquam esse perspiciatis. Rem quasi tenetur in magni!</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                                    <a class="btn btn-primary py-3 px-5 mt-3" href="">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- About End -->
            
            
                    <div class="container">
                        <div class="row">
                            @foreach ($properties as $property)
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        @if ($property->listingType->name == 'sell')
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div>
                                        @else
                                        <div class="bg-warning rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                                        @endif
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ $property->category->name }}</div>
                                        @if ($property->images->count() > 0)
                                        <a href=""><img class="img-fluid" src="{{ asset('images/' . $property->images->first()->image_path) }}" alt=""></a>
                                        @endif
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">${{ $property->price }}</h5>
                                        <a class="d-block h5 mb-2" href="">{{ $property->name }}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->address }}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->size }} Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{ $property->bedrooms }} Bed</small>
                                        <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{ $property->bathrooms }} Bath</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
            
            
            
                    <!-- Team Start -->
                    <div class="container-xxl py-5">
                        <div class="container">
                            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                                <h1 class="mb-3">Property Agents</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati totam reiciendis commodi dignissimos eaque facere impedit, eligendi atque minima labore et error sint adipisci saepe consequatur ab expedita libero minus.</p>
                            </div>
                            <div class="row g-4">
                                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="team-item rounded overflow-hidden">
                                        <div class="position-relative">
                                            <img class="img-fluid" src="{{ asset('img/team-1.jpg') }}" alt="">
                                            <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 mt-3">
                                            <h5 class="fw-bold mb-0">Full Name</h5>
                                            <small>Designation</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                    <div class="team-item rounded overflow-hidden">
                                        <div class="position-relative">
                                            <img class="img-fluid" src="{{ asset('img/team-2.jpg') }}" alt="">
                                            <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 mt-3">
                                            <h5 class="fw-bold mb-0">Full Name</h5>
                                            <small>Designation</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                    <div class="team-item rounded overflow-hidden">
                                        <div class="position-relative">
                                            <img class="img-fluid" src="{{ asset('img/team-3.jpg') }}" alt="">
                                            <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 mt-3">
                                            <h5 class="fw-bold mb-0">Full Name</h5>
                                            <small>Designation</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                                    <div class="team-item rounded overflow-hidden">
                                        <div class="position-relative">
                                            <img class="img-fluid" src="{{ asset('img/team-4.jpg') }}" alt="">
                                            <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center p-4 mt-3">
                                            <h5 class="fw-bold mb-0">Full Name</h5>
                                            <small>Designation</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Team End -->
                    <!-- Back to Top -->
                    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
                </div>
@endsection
