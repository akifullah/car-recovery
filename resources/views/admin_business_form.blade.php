@extends('layouts.app')

@section('main')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4>Add Business</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form method="POST" action="{{ route('admin.business.create') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="location_name" class="form-label">Location Name</label>
                            <input type="text" class="form-control" id="location_name" name="location_name" value="{{ old('location_name', $business->location_name ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $business->phone_number ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="business_name" class="form-label">Business Name</label>
                            <input type="text" class="form-control" id="business_name" name="business_name" value="{{ old('business_name', $business->business_name ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="business_address" class="form-label">Business Address</label>
                            <textarea row="5"  class="form-control" id="business_address" name="business_address" required>{{ old('business_address', $business->business_address ?? '') }}</textarea>
                        </div>
                       
                        <button type="submit" class="btn btn-success w-100">Save Business</button>
                    </form>
                    <form method="POST" action="{{ route('admin.logout') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 