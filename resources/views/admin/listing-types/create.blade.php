@extends('layouts.admin')

@section('content')
<!-- Create Listing Type -->
<div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h2 class="fw-bold mb-2" style="color: #17324D;">Add New Listing Type</h2>
                        <p class="text-muted mb-0">Create a new property listing type</p>
                    </div>

                        <form method="POST" action="{{ route('admin.listing-types.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="color: #202B38;">Name</label>
                                <input
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name"
                                    placeholder="e.g., Sale, Rent, Lease"
                                    value="{{ old('name') }}"
                                    required
                                >
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2 mt-4">
                                <a href="{{ route('admin.listing-types.index') }}" class="btn btn-outline-dark rounded-2" style="border-color: #17324D; color: #17324D;">
                                    Cancel
                                </a>
                                <button type="submit" class="btn rounded-2" style="background-color: #17324D; color: #FFFFFF;">
                                    <i class="fas fa-save me-2"></i>Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
