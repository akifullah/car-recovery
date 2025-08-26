@extends('layouts.admin')

@section('main')
    <div class="container mt-5">
        <div class="row ">
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
                                    <input type="file" class="form-control" id="image" name="image"
                                        accept="image/*">
                                    @if (isset($business) && $business->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/business/' . $business->image) }}"
                                                alt="Business Image" class="img-thumbnail" style="max-width: 120px;">
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-3 align-self-start pt-2">
                                    <label for="whatsapp" class="form-label">WhatsApp Number</label>
                                    <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                        value="{{ old('whatsapp', $business->whatsapp ?? '') }}"
                                        placeholder="e.g. +923001234567">
                                </div>

                                <div class="col-md-4 mt-3 d-flex justify-content-end">
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

        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4>Add Pages</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pages.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-4 px-1">
                                <label for="page_url">Page Url</label>
                                <input type="text" id="page_url" name="url" placeholder="Like about"
                                    class="form-control" required maxlength="255">
                            </div>
                            <div class="form-group col-sm-4 px-1">
                                <label for="location_name">Location Name</label>
                                <input type="text" id="location_name" name="location_name" placeholder="Location name"
                                    class="form-control" required maxlength="255">
                            </div>

                            <div class="col-sm-4 px-1 mt-2 align-self-end">
                                <button class="btn btn-success w-100">Add Page</button>
                            </div>



                        </div>
                    </form>

                    <div class="col-12 mt-4">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Location Name</td>
                                    <td>URL</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pages->isNotEmpty())
                                    @foreach ($pages as $page)
                                        <tr>
                                            <td>{{ $page->id }}</td>
                                            <td>{{ $page->location_name }}</td>
                                            <td>{{ $page->url }}</td>
                                            <td>
                                                <form action="{{ route('admin.pages.destroy', $page->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">No pages found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>




    </div>
@endsection
