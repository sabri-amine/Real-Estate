@extends('layouts.app')

@section('content')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Category Slider Section Start -->
<section class="py-5 bg-light-subtle">
    <div class="container py-4">
        
        <!-- Section Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
            <div>
                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill mb-2">Explore Options</span>
                <h2 class="fw-bold text-dark display-6 mb-1">Property Categories</h2>
                <p class="text-muted fs-5 mb-0">Browse through our curated selection of property types.</p>
            </div>
            
            <!-- Custom Navigation Buttons -->
            <div class="d-flex gap-2 mt-3 mt-md-0">
                <button class="btn btn-outline-dark rounded-circle category-prev d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="bi bi-arrow-left fs-5"></i>
                </button>
                <button class="btn btn-outline-dark rounded-circle category-next d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="bi bi-arrow-right fs-5"></i>
                </button>
            </div>
        </div>

        <!-- Swiper Container -->
        <div class="swiper categorySwiper py-3">
            <div class="swiper-wrapper">
                @foreach ($categories as $category)
                @php
                    $imageName = strtolower($category->name) . '.png';
                    $imagePath = public_path('img/' . $imageName);
                    $fallbackImage = 'icon-housing.png';

                    // Mapping for category names to existing images
                    $imageMapping = [
                        'home' => 'house.png',
                        'office' => 'icon-building.png',
                        'townhouse' => 'house.png',
                    ];

                    if (array_key_exists(strtolower($category->name), $imageMapping)) {
                        $imageName = $imageMapping[strtolower($category->name)];
                    } elseif (!file_exists($imagePath)) {
                        $imageName = $fallbackImage;
                    }
                @endphp
                <div class="swiper-slide">
                    <a href="{{ route('show') }}?category_filter={{ urlencode($category->name) }}" class="text-decoration-none">
                        <div class="category-card card border-0 shadow-sm rounded-4 p-4 text-center h-100">

                            <!-- Icon Box -->
                            <div class="icon-box rounded-4 p-3 mb-3 mx-auto d-flex align-items-center justify-content-center">
                                <img src="{{ asset('img/' . $imageName) }}"
                                     alt="{{ $category->name }}"
                                     class="img-fluid category-icon"
                                     style="max-height: 50px; object-fit: contain;">
                            </div>

                            <!-- Content -->
                            <div class="card-body p-0">
                                <h5 class="fw-bold text-dark mb-2 fs-6 text-truncate">{{ $category->name }}</h5>
                                <span class="badge bg-light text-secondary rounded-pill px-3 py-1 fw-normal border border-light-subtle" style="font-size: 0.8rem;">
                                    {{ $category->properties_count ?? $category->properties()->count() }} {{ ($category->properties_count ?? $category->properties()->count()) == 1 ? 'Property' : 'Properties' }}
                                </span>
                            </div>

                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination Dots -->
            <div class="swiper-pagination mt-4 position-relative"></div>
        </div>

    </div>
</section>
<!-- Category Slider Section End -->

<!-- Custom CSS -->
<style>
.category-card {
    background-color: #ffffff;
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    border: 1px solid rgba(0, 0, 0, 0.06) !important;
}

.category-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 32px rgba(23, 50, 77, 0.1) !important;
}

.icon-box {
    background-color: #f8fafc;
    width: 90px;
    height: 90px;
    transition: background-color 0.3s ease;
}

.category-card:hover .icon-box {
    background-color: #eef2f6;
}

.category-icon {
    transition: transform 0.3s ease;
}

.category-card:hover .category-icon {
    transform: scale(1.08);
}

.swiper-pagination-bullet-active {
    background: #0d6efd !important;
    width: 24px !important;
    border-radius: 4px !important;
}
</style>

<!-- Swiper JS Script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        new Swiper(".categorySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".category-next",
                prevEl: ".category-prev",
            },
            breakpoints: {
                576: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 24,
                },
            },
        });
    });
</script>
@endsection