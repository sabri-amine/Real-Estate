@extends('layouts.app')
@section('content')
<div class="container-xxl py-5" style="background-color: #F8FAFC; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('profile') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold" style="border-color: #CBD5E0; color: #4A5568;">
                        <i class="fas fa-arrow-left me-2"></i>Back to Profile
                    </a>
                </div>

                <!-- Edit Profile Card -->
                <div class="bg-white rounded-4 shadow-sm overflow-hidden" style="border: 1px solid #E5E7EB;">
                    <div class="p-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold mb-2" style="color: #1A365D; font-size: 28px;">Edit Profile</h2>
                            <p style="color: #718096;">Update your personal information</p>
                        </div>

                        <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Profile Image Section -->
                            <div class="text-center mb-5">
                                <div class="position-relative d-inline-block mb-3">
                                    @if ($user->image)
                                        <img src="{{ asset('storage/users/' . $user->image) }}"
                                             alt="{{ $user->name }}"
                                             class="rounded-circle border-4"
                                             style="width: 120px; height: 120px; object-fit: cover; border-color: #E5E7EB; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                    @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center border-4"
                                             style="width: 120px; height: 120px; background-color: #F7FAFC; border-color: #E5E7EB; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                            <i class="fas fa-user" style="font-size: 40px; color: #CBD5E0;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <label class="btn btn-outline-primary rounded-pill px-4 py-2 fw-semibold"
                                           style="border-color: #1A365D; color: #1A365D;">
                                        <i class="fas fa-camera me-2"></i>Change Photo
                                        <input type="file" name="image" class="d-none" accept="image/*">
                                    </label>
                                    <p class="mt-2 mb-0" style="color: #718096; font-size: 12px;">JPG, PNG or GIF (max 2MB)</p>
                                </div>
                            </div>

                            <!-- Form Fields -->
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold mb-2" style="color: #2D3748;">Full Name</label>
                                    <input type="text"
                                           class="form-control rounded-3 py-3"
                                           name="name"
                                           value="{{ old('name', $user->name) }}"
                                           placeholder="Enter your full name"
                                           required
                                           style="border: 1px solid #E5E7EB;">
                                    @error('name')
                                        <p class="text-danger mt-1 mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-semibold mb-2" style="color: #2D3748;">Email Address</label>
                                    <input type="email"
                                           class="form-control rounded-3 py-3"
                                           name="email"
                                           value="{{ old('email', $user->email) }}"
                                           placeholder="Enter your email"
                                           required
                                           style="border: 1px solid #E5E7EB;">
                                    @error('email')
                                        <p class="text-danger mt-1 mb-0" style="font-size: 13px;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 mt-5">
                                <button type="submit"
                                        class="btn btn-primary rounded-pill px-5 py-3 fw-semibold flex-grow-1"
                                        style="background-color: #1A365D; border: none; box-shadow: 0 4px 12px rgba(26, 54, 93, 0.2);">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                                <a href="{{ route('profile') }}"
                                   class="btn btn-outline-secondary rounded-pill px-5 py-3 fw-semibold"
                                   style="border-color: #CBD5E0; color: #4A5568;">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    border-color: #1A365D !important;
    box-shadow: 0 0 0 3px rgba(26, 54, 93, 0.1) !important;
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
</style>
@endsection
