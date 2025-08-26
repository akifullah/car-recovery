@extends('layouts.admin')

@section('main')
    <div class="container mt-5">
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
                                                <option value="_blank" @if ($button->target == '_blank') selected @endif>
                                                    New
                                                    Tab</option>
                                            </select>
                                        </td>
                                        <td class="d-flex gap-1">
                                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.buttons.delete', $button) }}"
                                        onsubmit="return confirm('Delete this button?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
