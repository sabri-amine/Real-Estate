@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-section position-relative py-5" style="min-height: 90vh; background: linear-gradient(135deg, #F5F7FA 0%, #E8EEF2 100%);">
    <div class="container h-100 d-flex align-items-center position-relative" style="z-index: 2; padding-top: 60px; padding-bottom: 60px;">
        <div class="row w-100 align-items-center g-5">
            <!-- Left Column - Text Content -->
            <div class="col-lg-6 hero-content-left">
                <h1 class="display-3 fw-bold mb-4 hero-title" style="color: #17324D; font-size: 52px; line-height: 1.1; letter-spacing: -0.5px;">
                    Find the Perfect Place<br>for Your Next Escape
                </h1>
                <p class="mb-5 hero-subtitle" style="color: #6B7280; font-size: 20px; line-height: 1.7; max-width: 550px;">
                    Discover luxury properties, stunning villas, and exceptional hotels around the world. Your dream destination awaits.
                </p>

                <!-- Search Form -->
                <div class="bg-white rounded-4 p-4 shadow-lg hero-search-form" style="max-width: 550px; border: 1px solid #E5E7EB;">
                    <form action="{{ route('show') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="position-relative">
                                    <i class="fas fa-map-marker-alt position-absolute top-50 start-3 translate-middle-y" style="color: #6B7280;"></i>
                                    <input type="text" class="form-control ps-5 rounded-3 py-3" style="border: 1px solid #E5E7EB;" placeholder="Where are you going?">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative">
                                    <i class="fas fa-calendar position-absolute top-50 start-3 translate-middle-y" style="color: #6B7280;"></i>
                                    <input type="date" class="form-control ps-5 rounded-3 py-3" style="border: 1px solid #E5E7EB;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative">
                                    <i class="fas fa-user position-absolute top-50 start-3 translate-middle-y" style="color: #6B7280;"></i>
                                    <select class="form-select ps-5 rounded-3 py-3" style="border: 1px solid #E5E7EB;">
                                        <option>1 guest</option>
                                        <option>2 guests</option>
                                        <option>3 guests</option>
                                        <option>4+ guests</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn w-100 py-3 rounded-3 fw-bold" style="background-color: #17324D; color: white; border: none;">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="mt-4 hero-cta">
                    <a href="{{ route('properties.index') }}" class="btn btn-primary rounded-pill px-5 py-3 fw-bold" style="background-color: #17324D; color: white; border: none; box-shadow: 0 4px 12px rgba(23, 50, 77, 0.3);">
                        Explore Properties
                    </a>
                </div>
            </div>

            <!-- Right Column - Hero Image -->
            <div class="col-lg-6 hero-content-right">
                <div class="position-relative hero-image-container">
                    <div class="hero-image-wrapper rounded-4 overflow-hidden shadow-lg" style="box-shadow: 0 20px 60px rgba(23, 50, 77, 0.2);">
                        <img class="img-fluid w-100 hero-image" src="{{ asset('img/carousel-1.jpg') }}" alt="Luxury Resort" style="object-fit: cover; height: 550px;">
                    </div>
                    <!-- Floating Card -->
                    <div class="position-absolute hero-floating-card bg-white rounded-3 p-4 shadow-lg" style="bottom: 30px; left: -20px; max-width: 280px; animation: float 3s ease-in-out infinite;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #F5F7FA;">
                                <i class="fas fa-plane" style="color: #315C7D; font-size: 20px;"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold" style="color: #17324D; font-size: 14px;">Your next escape awaits</p>
                                <p class="mb-0" style="color: #6B7280; font-size: 12px;">Discover premium stays</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Promotional Slider Section -->
<div class="py-5" style="background-color: #F5F7FA;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">
                    <!-- Carousel Indicators -->
                    <div class="carousel-indicators mb-0">
                        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>

                    <!-- Carousel Inner -->
                    <div class="carousel-inner rounded-4 overflow-hidden" style="box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);">
                        <!-- Slide 1 - Luxury Hotels -->
                        <div class="carousel-item active">
                            <div class="position-relative" style="height: 450px;">
                                <img src="{{ asset('img/carousel-1.jpg') }}"
                                     class="d-block w-100 h-100"
                                     alt="Luxury Hotels"
                                     style="object-fit: cover;">
                                <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex align-items-center"
                                     style="background: linear-gradient(135deg, rgba(23, 50, 77, 0.85), rgba(23, 50, 77, 0.65));">
                                    <div class="container text-center text-white">
                                        <h2 class="display-4 fw-bold mb-3 slide-title" style="font-size: 42px;">Discover Exceptional Hotels</h2>
                                        <p class="lead mb-4 slide-subtitle" style="font-size: 20px; opacity: 0.95;">
                                            Experience comfort, elegance, and unforgettable stays.
                                        </p>
                                        <a href="{{ route('properties.index') }}"
                                           class="btn btn-light rounded-pill px-5 py-3 fw-bold slide-button"
                                           style="background-color: white; color: #17324D; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
                                            Explore Hotels
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 - Villas and Homes -->
                        <div class="carousel-item">
                            <div class="position-relative" style="height: 450px;">
                                <img src="{{ asset('img/carousel-2.jpg') }}"
                                     class="d-block w-100 h-100"
                                     alt="Villas and Homes"
                                     style="object-fit: cover;">
                                <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex align-items-center"
                                     style="background: linear-gradient(135deg, rgba(23, 50, 77, 0.85), rgba(23, 50, 77, 0.65));">
                                    <div class="container text-center text-white">
                                        <h2 class="display-4 fw-bold mb-3 slide-title" style="font-size: 42px;">Your Dream Villa Awaits</h2>
                                        <p class="lead mb-4 slide-subtitle" style="font-size: 20px; opacity: 0.95;">
                                            Find beautiful villas and homes for your next getaway.
                                        </p>
                                        <a href="{{ route('properties.index') }}"
                                           class="btn btn-light rounded-pill px-5 py-3 fw-bold slide-button"
                                           style="background-color: white; color: #17324D; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
                                            Explore Properties
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 - Dream Destinations -->
                        <div class="carousel-item">
                            <div class="position-relative" style="height: 450px;">
                                <img src="{{ asset('img/header.jpg') }}"
                                     class="d-block w-100 h-100"
                                     alt="Dream Destinations"
                                     style="object-fit: cover;">
                                <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex align-items-center"
                                     style="background: linear-gradient(135deg, rgba(23, 50, 77, 0.85), rgba(23, 50, 77, 0.65));">
                                    <div class="container text-center text-white">
                                        <h2 class="display-4 fw-bold mb-3 slide-title" style="font-size: 42px;">Discover Your Next Destination</h2>
                                        <p class="lead mb-4 slide-subtitle" style="font-size: 20px; opacity: 0.95;">
                                            Explore unique places and create unforgettable memories.
                                        </p>
                                        <a href="{{ route('show') }}"
                                           class="btn btn-light rounded-pill px-5 py-3 fw-bold slide-button"
                                           style="background-color: white; color: #17324D; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
                                            Find Your Stay
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 4 - Special Offers -->
                        <div class="carousel-item">
                            <div class="position-relative" style="height: 450px;">
                                <img src="{{ asset('img/property-1.jpg') }}"
                                     class="d-block w-100 h-100"
                                     alt="Special Offers"
                                     style="object-fit: cover;">
                                <div class="position-absolute top-0 start-0 end-0 bottom-0 d-flex align-items-center"
                                     style="background: linear-gradient(135deg, rgba(23, 50, 77, 0.85), rgba(23, 50, 77, 0.65));">
                                    <div class="container text-center text-white">
                                        <h2 class="display-4 fw-bold mb-3 slide-title" style="font-size: 42px;">Find Your Perfect Getaway</h2>
                                        <p class="lead mb-4 slide-subtitle" style="font-size: 20px; opacity: 0.95;">
                                            Explore exceptional accommodations for your next trip.
                                        </p>
                                        <a href="{{ route('properties.index') }}"
                                           class="btn btn-light rounded-pill px-5 py-3 fw-bold slide-button"
                                           style="background-color: white; color: #17324D; border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);">
                                            Discover Offers
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev"
                            type="button"
                            data-bs-target="#promoCarousel"
                            data-bs-slide="prev"
                            style="width: 50px; height: 50px; background-color: rgba(255, 255, 255, 0.9); border-radius: 50%; top: 50%; transform: translateY(-50%); margin-left: -25px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next"
                            type="button"
                            data-bs-target="#promoCarousel"
                            data-bs-slide="next"
                            style="width: 50px; height: 50px; background-color: rgba(255, 255, 255, 0.9); border-radius: 50%; top: 50%; transform: translateY(-50%); margin-right: -25px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Properties Section -->
<div class="py-5" style="background-color: #FFFFFF;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3" style="color: #17324D; font-size: 36px;">Popular Properties</h2>
            <p style="color: #6B7280; font-size: 18px;">Discover our most sought-after accommodations</p>
        </div>

        <div class="row g-4">
            @foreach ($properties->take(6) as $property)
            <div class="col-lg-4 col-md-6">
                <div class="property-item rounded-4 overflow-hidden bg-white shadow-sm h-100" style="border: 1px solid #E5E7EB; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    <div class="position-relative overflow-hidden" style="height: 250px;">
                        @if ($property->listingType->name == 'sell')
                            <div class="rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3 fw-bold" style="background-color: #17324D;">
                                <i class="fas fa-tag me-1"></i>For Sale
                            </div>
                        @else
                            <div class="rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3 fw-bold" style="background-color: #D6AD60;">
                                <i class="fas fa-key me-1"></i>For Rent
                            </div>
                        @endif
                        <div class="rounded-top position-absolute start-0 bottom-0 mx-4 pt-1 px-3 fw-bold shadow" style="background-color: white; color: #17324D;">
                            <i class="fas fa-building me-1"></i>{{ $property->category->name }}
                        </div>
                        @if ($property->images->count() > 0)
                            <a href="{{ route('properties.show', $property->id) }}" class="d-block h-100">
                                <img class="img-fluid w-100 h-100 object-fit-cover" src="{{ asset('images/' . $property->images->first()->image_path) }}" alt="{{ $property->name }}">
                            </a>
                        @else
                            <a href="{{ route('properties.show', $property->id) }}" class="d-block h-100">
                                <img class="img-fluid w-100 h-100 object-fit-cover" src="{{ asset('img/generic.jpg') }}" alt="{{ $property->name }}">
                            </a>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold" style="color: #17324D;">${{ number_format($property->price, 2) }}</h5>
                            <small style="color: #6B7280;">
                                <i class="fas fa-map-marker-alt me-1" style="color: #315C7D;"></i>{{ $property->city }}
                            </small>
                        </div>
                        <a class="d-block h5 mb-2 text-decoration-none fw-bold" href="{{ route('properties.show', $property->id) }}" style="color: #202B38;">
                            {{ $property->name }}
                        </a>
                        <p class="mb-3" style="color: #6B7280;">
                            <i class="fas fa-map-marker-alt me-2" style="color: #315C7D;"></i>{{ $property->address }}
                        </p>
                        <div class="d-flex border-top pt-3" style="border-color: #E5E7EB;">
                            <div class="flex-fill text-center border-end" style="border-color: #E5E7EB;">
                                <small class="d-block fw-bold" style="color: #315C7D;">
                                    <i class="fas fa-ruler-combined me-1"></i>{{ $property->size }} Sqft
                                </small>
                            </div>
                            <div class="flex-fill text-center border-end" style="border-color: #E5E7EB;">
                                <small class="d-block fw-bold" style="color: #315C7D;">
                                    <i class="fas fa-bed me-1"></i>{{ $property->bedrooms }} Bed
                                </small>
                            </div>
                            <div class="flex-fill text-center">
                                <small class="d-block fw-bold" style="color: #315C7D;">
                                    <i class="fas fa-bath me-1"></i>{{ $property->bathrooms }} Bath
                                </small>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('properties.show', $property->id) }}" class="btn btn-sm w-100" style="background-color: #17324D; color: white; border: none;">
                                <i class="fas fa-eye me-1"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('properties.index') }}" class="btn btn-outline-primary rounded-pill px-5 py-3 fw-bold" style="border-color: #17324D; color: #17324D;">
                View All Properties
            </a>
        </div>
    </div>
</div>

<!-- Destinations Section -->
<div class="py-5" style="background-color: #F5F7FA;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3" style="color: #17324D; font-size: 36px;">Popular Destinations</h2>
            <p style="color: #6B7280; font-size: 18px;">Explore our most beloved locations</p>
        </div>

        @php
            $cities = $properties->pluck('city')->unique()->take(4);
        @endphp

        <div class="row g-4">
            @foreach ($cities as $city)
            @php
                $cityProperties = $properties->where('city', $city);
                $cityCount = $cityProperties->count();
                $firstProperty = $cityProperties->first();
            @endphp
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('show') }}?location_filter={{ $city }}" class="text-decoration-none">
                    <div class="destination-card position-relative rounded-4 overflow-hidden" style="height: 350px; transition: transform 0.3s ease;">
                        @if ($firstProperty && $firstProperty->images->count() > 0)
                            <img class="img-fluid w-100 h-100" style="object-fit: cover;" src="{{ asset('images/' . $firstProperty->images->first()->image_path) }}" alt="{{ $city }}">
                        @else
                            <img class="img-fluid w-100 h-100" style="object-fit: cover;" src="{{ asset('img/generic.jpg') }}" alt="{{ $city }}">
                        @endif
                        <div class="position-absolute bottom-0 start-0 end-0 p-4" style="background: linear-gradient(to top, rgba(23, 50, 77, 0.9), transparent);">
                            <h4 class="text-white fw-bold mb-1" style="font-size: 22px;">{{ $city }}</h4>
                            <p class="text-white mb-0" style="font-size: 14px; opacity: 0.9;">{{ $cityCount }} properties</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Why Choose Us Section -->
<div class="py-5" style="background-color: #FFFFFF;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3" style="color: #17324D; font-size: 36px;">Why Choose Us</h2>
            <p style="color: #6B7280; font-size: 18px;">Experience the difference with our premium service</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-5 rounded-4" style="background-color: #F5F7FA; height: 100%;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; background-color: #E8EEF2;">
                        <i class="fas fa-search" style="color: #315C7D; font-size: 32px;"></i>
                    </div>
                    <h4 class="fw-bold mb-3" style="color: #17324D; font-size: 20px;">Easy Search</h4>
                    <p style="color: #6B7280; font-size: 15px;">Find your perfect property quickly with our advanced search filters</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-5 rounded-4" style="background-color: #F5F7FA; height: 100%;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; background-color: #E8EEF2;">
                        <i class="fas fa-home" style="color: #315C7D; font-size: 32px;"></i>
                    </div>
                    <h4 class="fw-bold mb-3" style="color: #17324D; font-size: 20px;">Wide Selection</h4>
                    <p style="color: #6B7280; font-size: 15px;">Choose from {{ $properties->count() }}+ carefully curated properties worldwide</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-5 rounded-4" style="background-color: #F5F7FA; height: 100%;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; background-color: #E8EEF2;">
                        <i class="fas fa-info-circle" style="color: #315C7D; font-size: 32px;"></i>
                    </div>
                    <h4 class="fw-bold mb-3" style="color: #17324D; font-size: 20px;">Clear Information</h4>
                    <p style="color: #6B7280; font-size: 15px;">Detailed descriptions, photos, and amenities for every property</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-5 rounded-4" style="background-color: #F5F7FA; height: 100%;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px; background-color: #E8EEF2;">
                        <i class="fas fa-shield-alt" style="color: #315C7D; font-size: 32px;"></i>
                    </div>
                    <h4 class="fw-bold mb-3" style="color: #17324D; font-size: 20px;">Secure Booking</h4>
                    <p style="color: #6B7280; font-size: 15px;">Book with confidence using our secure and reliable platform</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Hero Section Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

.hero-title {
    animation: fadeInUp 0.8s ease-out;
}

.hero-subtitle {
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.hero-search-form {
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

.hero-cta {
    animation: fadeInUp 0.8s ease-out 0.6s both;
}

.hero-image-container {
    animation: fadeInRight 1s ease-out 0.3s both;
}

.hero-image-wrapper {
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.hero-image-wrapper:hover {
    transform: scale(1.02);
    box-shadow: 0 25px 70px rgba(23, 50, 77, 0.25);
}

.hero-floating-card {
    animation: float 3s ease-in-out infinite;
}

/* Slider Animations */
.slide-title, .slide-subtitle, .slide-button {
    opacity: 0;
}

.carousel-item.active .slide-title {
    animation: fadeInUp 0.8s ease-out forwards;
}

.carousel-item.active .slide-subtitle {
    animation: fadeInUp 0.8s ease-out 0.2s forwards;
}

.carousel-item.active .slide-button {
    animation: fadeInUp 0.8s ease-out 0.4s forwards;
}

/* Carousel Indicators */
.carousel-indicators {
    bottom: 20px;
}

.carousel-indicators button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin: 0 6px;
    background-color: rgba(255, 255, 255, 0.5);
    border: none;
    transition: all 0.3s ease;
}

.carousel-indicators button.active {
    background-color: white;
    width: 35px;
    border-radius: 6px;
}

.carousel-indicators button:hover {
    background-color: rgba(255, 255, 255, 0.8);
}

/* Carousel Control Buttons */
.carousel-control-prev,
.carousel-control-next {
    opacity: 0;
    transition: opacity 0.3s ease;
}

#promoCarousel:hover .carousel-control-prev,
#promoCarousel:hover .carousel-control-next {
    opacity: 1;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 20px;
    height: 20px;
    background-color: #17324D;
    border-radius: 50%;
}

/* Property Cards */
.property-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.destination-card:hover {
    transform: scale(1.05);
}

.btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

.rounded-4 {
    border-radius: 16px;
}

.rounded-3 {
    border-radius: 12px;
}

.rounded-pill {
    border-radius: 50px;
}

.shadow-sm {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.shadow-lg {
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

/* Navbar Styles */
.navbar-nav .nav-link {
    color: #202B38;
    transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #17324D;
}

.navbar-nav .nav-link.active {
    color: #17324D;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.dropdown-item {
    color: #202B38;
    transition: background-color 0.3s ease;
}

.dropdown-item:hover {
    background-color: #F5F7FA;
    color: #17324D;
}

/* Responsive Design */
@media (max-width: 991px) {
    .hero-content-left {
        text-align: center;
        margin-bottom: 2rem;
    }

    .hero-title {
        font-size: 36px;
    }

    .hero-subtitle {
        font-size: 18px;
        max-width: 100%;
    }

    .hero-search-form {
        max-width: 100%;
    }

    .hero-image-wrapper img {
        height: 400px !important;
    }

    .hero-floating-card {
        left: 10px !important;
        bottom: 20px !important;
        max-width: 260px !important;
    }

    /* Slider Responsive */
    .carousel-inner {
        height: 350px !important;
    }

    .slide-title {
        font-size: 32px !important;
    }

    .slide-subtitle {
        font-size: 18px !important;
    }
}

@media (max-width: 767px) {
    .hero-section {
        min-height: auto !important;
        padding-top: 40px !important;
        padding-bottom: 40px !important;
    }

    .hero-title {
        font-size: 28px;
    }

    .hero-subtitle {
        font-size: 16px;
    }

    .hero-image-wrapper img {
        height: 300px !important;
    }

    .hero-floating-card {
        left: 5px !important;
        bottom: 15px !important;
        max-width: 240px !important;
        padding: 12px !important;
    }

    .hero-floating-card p {
        font-size: 12px !important;
    }

    /* Slider Responsive */
    .carousel-inner {
        height: 300px !important;
    }

    .slide-title {
        font-size: 24px !important;
    }

    .slide-subtitle {
        font-size: 16px !important;
    }

    .slide-button {
        padding: 10px 20px !important;
        font-size: 14px !important;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 40px !important;
        height: 40px !important;
    }

    .carousel-indicators button {
        width: 10px;
        height: 10px;
    }
}
</style>
@endsection
