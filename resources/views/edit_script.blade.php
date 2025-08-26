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

            <div class="card mb-4">
                <div class="card-header bg-success text-white text-center">
                    <h4>Edit Scripts</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('scripts.update', $script) }}">
                        @csrf
                        @method('PUT')
                        <div class="row g-2 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Scripts Name</label>
                                <input type="text" name="name" class="form-control" required
                                    value="{{ old('name', $script->name) }}">
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Select scope</label>
                                <select name="scope" class="form-select">
                                    <option value="entire_website"
                                        {{ old('scope', $script->scope) == 'entire_website' ? 'selected' : '' }}>Entire Website</option>
                                    <option value="single_page"
                                        {{ old('scope', $script->scope) == 'single_page' ? 'selected' : '' }}>Single Page</option>
                                </select>
                                @error('scope')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Where to:</label>
                                <select name="position" class="form-control">
                                    <option value="head" {{ old('position', $script->position) == 'head' ? 'selected' : '' }}>Head tag</option>
                                    <option value="body" {{ old('position', $script->position) == 'body' ? 'selected' : '' }}>Body end</option>
                                </select>
                                @error('position')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Select Pages (If not entire website)</label>
                                @php
                                    // $script->page may be a JSON string or array
                                    $selectedPages = [];
                                    if (old('page')) {
                                        $selectedPages = old('page');
                                    } elseif (is_array($script->page)) {
                                        $selectedPages = $script->page;
                                    } elseif (is_string($script->page) && $script->page) {
                                        $selectedPages = json_decode($script->page, true) ?? [];
                                    }
                                @endphp
                                <select name="page[]" multiple class="form-select">
                                    {{-- Example options, should be dynamic --}}
                                    <option value="all" {{ collect($selectedPages)->contains('all') ? 'selected' : '' }}>
                                        Entire Website</option>
                                    <option value="single" {{ collect($selectedPages)->contains('single') ? 'selected' : '' }}>Single Page</option>
                                </select>
                                @error('page')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-9">
                                <label for="">Scripts or Links</label>
                                <textarea class="form-control" name="code" cols="30" rows="4">{{ old('code', $script->code) }}</textarea>
                                @error('code')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2 ms-auto">
                                <button type="submit" class="btn btn-primary w-100">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
