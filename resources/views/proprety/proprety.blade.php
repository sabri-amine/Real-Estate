@extends('layouts.app')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <!-- Page Header -->
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Property Listings</h1>
            <p>Explore our wide range of properties for sale and rent</p>
        </div>

        <!-- Filter/Search Bar -->
        <div class="rounded-4 p-4 mb-5 wow fadeInUp" style="background-color: #17324D;" data-wow-delay="0.2s">
            <form action="{{ route('show') }}" method="GET" class="row g-3">
                <div class="col-md-10">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control border-0 py-2" name="search_keyword" placeholder="Search Keyword" style="background-color: rgba(255, 255, 255, 0.1); color: white;" value="{{ request('search_keyword') }}">
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0 py-2" name="catigory_filter" id="catigory_filter" style="background-color: rgba(255, 255, 255, 0.1); color: white;">
                                <option value="Property Category" {{ request('catigory_filter') == 'Property Category' || !request('catigory_filter') ? 'selected' : '' }}>Property Category</option>
                                @foreach ($categories ?? [] as $category)
                                    <option value="{{ $category->name }}" {{ request('catigory_filter') == $category->name ? 'selected' : '' }} style="background-color: #17324D; color: white;">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0 py-2" name="location_filter" id="location_filter" style="background-color: rgba(255, 255, 255, 0.1); color: white;">
                                <option value="Location" {{ request('location_filter') == 'Location' || !request('location_filter') ? 'selected' : '' }}>Location</option>
                                @foreach ($cities ?? collect($properties ?? [])->pluck('city')->unique()->sort()->values() as $city)
                                    <option value="{{ $city }}" {{ request('location_filter') == $city ? 'selected' : '' }} style="background-color: #17324D; color: white;">{{ $city }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn w-100 py-2" style="background-color: #D6AD60; color: #17324D; border: none; font-weight: bold;">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Properties Grid -->
        <div class="row g-4">
            @foreach ($properties as $property)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
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
                        @if ($property->first_image)
                            <a href="{{ route('properties.show', $property->id) }}" class="d-block h-100">
                                <img class="img-fluid w-100 h-100 object-fit-cover" src="{{ asset('images/' . $property->first_image) }}" alt="{{ $property->name }}">
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

        <!-- Empty State -->
        @if ($properties->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-home fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">No Properties Found</h3>
                <p class="text-muted">Check back later or adjust your search criteria</p>
                <a href="{{ route('createproperties') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Property
                </a>
            </div>
        @endif
    </div>
</div>

<style>
select option {
    background-color: #17324D;
    color: white;
}

select option:hover {
    background-color: #D6AD60;
    color: #17324D;
}
</style>
@endsection

