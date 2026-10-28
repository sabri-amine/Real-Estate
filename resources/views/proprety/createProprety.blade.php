@extends('layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Create New Property</h1>
            <p>List your property and reach thousands of potential buyers and renters</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-white rounded p-4 wow fadeInUp" data-wow-delay="0.1s">
                    <form class="add-property-form" method="POST" action="{{ route('addproprety') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="bg-light rounded p-4 mb-4">
                            <h4 class="mb-4 text-primary"><i class="fas fa-info-circle me-2"></i>Basic Information</h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Property Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter property name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="Enter city" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter full address" required>
                                </div>
                            </div>
                        </div>

                        <!-- Property Details Section -->
                        <div class="bg-light rounded p-4 mb-4">
                            <h4 class="mb-4 text-primary"><i class="fas fa-home me-2"></i>Property Details</h4>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Price ($)</label>
                                    <input type="number" step="0.01" class="form-control" name="price" placeholder="Enter price" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Size (Sqft)</label>
                                    <input type="number" step="0.01" class="form-control" name="size" placeholder="Enter size" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Category</label>
                                    <select class="form-select" name="property-category" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bedrooms</label>
                                    <input type="number" class="form-control" name="bedrooms" placeholder="Number of bedrooms" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Bathrooms</label>
                                    <input type="number" class="form-control" name="bathrooms" placeholder="Number of bathrooms" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Listing Type</label>
                                    <select class="form-select" name="listing-type" required>
                                        <option value="">Select Type</option>
                                        @foreach ($listingTypes as $listingType)
                                            <option value="{{ $listingType->id }}">{{ $listingType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="bg-light rounded p-4 mb-4">
                            <h4 class="mb-4 text-primary"><i class="fas fa-align-left me-2"></i>Description</h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Property Description</label>
                                    <textarea class="form-control" name="description" rows="5" placeholder="Describe your property in detail..." required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Images Section -->
                        <div class="bg-light rounded p-4 mb-4">
                            <h4 class="mb-4 text-primary"><i class="fas fa-images me-2"></i>Property Images</h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Upload Images</label>
                                    <input class="form-control" type="file" name="images[]" multiple accept="image/*">
                                    <small class="text-muted">You can upload multiple images (JPEG, PNG, JPG, GIF, WEBP)</small>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary w-100 py-3">
                                    <i class="fas fa-plus-circle me-2"></i>Create Property
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('properties.index') }}" class="btn btn-outline-secondary w-100 py-3">
                                    <i class="fas fa-arrow-left me-2"></i>Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
