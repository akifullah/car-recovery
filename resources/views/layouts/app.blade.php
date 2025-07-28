@php
    $business = \App\Models\Business::first('whatsapp');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- FONTAWESOME ICON CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- BOOSTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />

    <!-- CUSTOM CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
            width: 50px;
            height: 50px;
            background-color: #25d366;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .whatsapp-button:hover {
            transform: scale(1.1);
        }

        .whatsapp-button img {
            width: 30px;
            height: 30px;
        }
    </style>

</head>

<body>

    <!-- WhatsApp Button -->
    @if ($business->whatsapp)
        <a href="https://wa.me/{{$business->whatsapp}}" class="whatsapp-button" target="_blank" aria-label="Chat on WhatsApp">
            <img src="https://cdn-icons-png.flaticon.com/512/124/124034.png" alt="WhatsApp" />
        </a>
    @endif

    <div class="wrapper position-relative ">

        @yield('main')



    </div>

</body>

</html>
