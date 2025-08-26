@extends('layouts.admin')

@section('main')
    <div class="container mt-5">




        {{-- render the button ui here --}}
        <div class="my-5">

            <div class="card mb-4">
                <div class="card-header bg-success text-white text-center">
                    <h4>Add Scripts</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('scripts.store') }}">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Scripts Name</label>
                                <input type="text" name="name" class="form-control" required
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Select scope</label>
                                <select name="scope" class="form-select">
                                    <option selected value="entire_website"
                                        {{ old('scope') == 'entire_website' ? 'selected' : '' }}>Entire Website</option>
                                    <option value="single_page" {{ old('scope') == 'single_page' ? 'selected' : '' }}>Single
                                        Page</option>
                                </select>
                                @error('scope')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Where to:</label>
                                <select name="position" class="form-control">
                                    <option value="head" {{ old('position') == 'head' ? 'selected' : '' }}>Head tag
                                    </option>
                                    <option value="body" {{ old('position') == 'body' ? 'selected' : '' }}>Body end
                                    </option>
                                </select>
                                @error('position')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Select Pages (If not entire website)</label>
                                <select name="page[]" multiple class="form-select">
                                    {{-- Example options, should be dynamic --}}
                                    <option value="all" {{ collect(old('page'))->contains('all') ? 'selected' : '' }}>
                                        Entire Website</option>
                                    <option value="single"
                                        {{ collect(old('page'))->contains('single') ? 'selected' : '' }}>Single Page
                                    </option>
                                </select>
                                @error('page')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-9">
                                <label for="">Scripts or Links</label>
                                <textarea class="form-control" name="code" cols="30" rows="4">{{ old('code') }}</textarea>
                                @error('code')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2 ms-auto">
                                <button type="submit" class="btn btn-primary w-100">Add</button>
                            </div>
                        </div>
                    </form>
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
            <div class="card">
                <div class="card-header">Existing Scripts</div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Scope</th>
                                <th>Position</th>
                                <th>Pages</th>
                                <th>Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($scripts as $script)
                                <tr>
                                    <td>{{ $script->id }}</td>
                                    <td>{{ $script->name }}</td>
                                    <td>
                                        @if ($script->scope === 'entire_website')
                                            Entire Website
                                        @else
                                            Single Page
                                        @endif
                                    </td>
                                    <td>
                                        @if ($script->position === 'head')
                                            Head
                                        @else
                                            Body
                                        @endif
                                    </td>
                                    <td>
                                        @if ($script->scope === 'entire_website')
                                            <span class="badge bg-success">All</span>
                                        @else
                                            @php
                                                $pages = [];
                                                if (is_array($script->page)) {
                                                    $pages = $script->page;
                                                } elseif (is_string($script->page) && $script->page) {
                                                    $pages = json_decode($script->page, true) ?? [];
                                                }
                                            @endphp
                                            @if (!empty($pages))
                                                @foreach ($pages as $page)
                                                    <span class="badge bg-info text-dark">{{ $page }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td style="max-width: 500px">
                                        <pre>{{ $script->code }}</pre>
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a href="{{ route('scripts.edit', $script) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="{{ route('scripts.destroy', $script) }}"
                                            onsubmit="return confirm('Delete this script?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No scripts found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
