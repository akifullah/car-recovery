@php
    $buttons = \App\Models\Button::all();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background: #f4f4f4;
        }
    </style>
</head>

<body>
    <div class="container-fluid text-center d-flex justify-content-center align-items-center min-vh-100 p-0">
        <div class="center-box w-100 p-4" style="max-width: none;">
            <h1 class="display-4 mb-2 fw-semibold ">Mobile Tyre Fitting</h1>
            <h4 class="mb-4">24/7 Mobile Tyres Fitting</h4>
            <div class="d-flex gap-2 justify-content-center btn-group-custom mb-2 flex-wrap">
                @foreach ($buttons as $btn)
                    <a href="{{ $btn->url }}" target="{{ $btn->target }}"
                        class="btn btn-primary btn-sm mb-2">{{ $btn->text }}</a>
                @endforeach
            </div>
            <p class="mt-3 text-secondary">The page you are looking for does not exist.</p>
        </div>
    </div>
</body>

</html>
