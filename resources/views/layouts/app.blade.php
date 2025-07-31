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
            width: 60px;
            height: 60px;
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
            width: 40px;
            height: 40px;
        }
        .whatsapp-button  h5{
            font-size: 20px;
            position: absolute;
            right: calc(100% + 10px);
            top: 50%;
            transform: translateY(-50%);
            white-space: nowrap;
            color: #000000;
            background: #fff;
            box-shadow:  0 0 10px rgba(0, 0, 0, 0.2);
            padding: 4px 8px;
            border-radius: 5px;
        }
    </style>

</head>

<body>

    <!-- WhatsApp Button -->
    @if ($business->whatsapp)
        <div class="d-flex align-items-center gap-2">
            <a  href="https://api.whatsapp.com/send?phone={{ $business->whatsapp }}&text=Need+Help%3F"
                class="whatsapp-button" target="_blank" aria-label="Chat on WhatsApp">
                <h5>Need Help?</h5>

                <img src="https://cdn-icons-png.flaticon.com/512/124/124034.png" alt="WhatsApp" />
            </a>
        </div>
    @endif

    <div class="wrapper position-relative ">

        @yield('main')



    </div>
    <script type='text/javascript'>
        window.smartlook || (function(d) {
            var o = smartlook = function() {
                    o.api.push(arguments)
                },
                h = d.getElementsByTagName('head')[0];
            var c = d.createElement('script');
            o.api = new Array();
            c.async = true;
            c.type = 'text/javascript';
            c.charset = 'utf-8';
            c.src = 'https://web-sdk.smartlook.com/recorder.js';
            h.appendChild(c);
        })(document);
        smartlook('init', '43adb320c41f63674d5523146230b9b5c319c691', {
            region: 'eu'
        });
    </script>
</body>

</html>
