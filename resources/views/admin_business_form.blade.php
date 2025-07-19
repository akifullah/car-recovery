@extends('layouts.app')

@section('main')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h4>Add Business</h4>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.business.create') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2 align-items-end mb-3">
                                <div class="col-md-3">
                                    <label for="location_name" class="form-label">Location Name</label>
                                    <input type="text" class="form-control" id="location_name" name="location_name"
                                        value="{{ old('location_name', $business->location_name ?? '') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number', $business->phone_number ?? '') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="business_name" class="form-label">Business Name</label>
                                    <input type="text" class="form-control" id="business_name" name="business_name"
                                        value="{{ old('business_name', $business->business_name ?? '') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="business_address" class="form-label">Business Address</label>
                                    <input type="text" class="form-control" id="business_address" name="business_address"
                                        value="{{ old('business_address', $business->business_address ?? '') }}">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label for="image" class="form-label">Business Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    @if(isset($business) && $business->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/business/' . $business->image) }}" alt="Business Image" class="img-thumbnail" style="max-width: 120px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mt-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success w-auto px-5">
                                        @if (isset($business) && $business)
                                            Update Business
                                        @else
                                            Add Business
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('admin.logout') }}" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>



        {{-- render the button ui here --}}
        <div class="my-5">
            <h4>Manage 404 Page Buttons</h4>

            <div class="card mb-4">
                <div class="card-header">Add New Button</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.buttons.store') }}">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Button Text</label>
                                <input type="text" name="text" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Button URL</label>
                                <input type="text" name="url" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Target</label>
                                <select name="target" class="form-select">
                                    <option value="_self">Same Tab</option>
                                    <option value="_blank">New Tab</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Existing Buttons</div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Text</th>
                                <th>URL</th>
                                <th>Target</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\Button::all() as $button)
                                <tr>
                                    <form method="POST" action="{{ route('admin.buttons.update', $button) }}">
                                        @csrf
                                        <td><input type="text" name="text" value="{{ $button->text }}"
                                                class="form-control" required></td>
                                        <td><input type="text" name="url" value="{{ $button->url }}"
                                                class="form-control" required></td>
                                        <td>
                                            <select name="target" class="form-select">
                                                <option value="_self" @if ($button->target == '_self') selected @endif>
                                                    Same Tab</option>
                                                <option value="_blank" @if ($button->target == '_blank') selected @endif>New
                                                    Tab</option>
                                            </select>
                                        </td>
                                        <td><button type="submit" class="btn btn-success btn-sm">Update</button></td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
