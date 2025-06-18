<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Recovery</title>

    <!-- FONTAWESOME ICON CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- BOOSTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">

</head>

<body>

    <!-- HEADER SECTION START -->
    <header class="header-section  d-md-none">
        <div class="d-flex align-items-center justify-content-center flex-column">
            <a href="tel:07523890308" class="btn-link header-btn mx-auto mx-md-0 text-start">
                <div class="icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <p class="m-0 text-22 pnum">0752 389 0308</p>
                <small class="text-14">24/7 Service - Call Now</small>
            </a>
            <p class="text-16 mb-0 para">ETA From 20 mins in Manchester</p>
        </div>
    </header>
    <!-- HEADER SECTION END -->
    <div class="wrapper position-relative ">

        @yield("main")

        <!-- FOOTER SECTION START -->
        <div class="footer-section">
            <div class="ft-content text-center">
                <h5 class="text-16 text-white fw-bold">INSTANT TYRE SOLUTIONS LTD</h5>
                <p class="text-16 text-white mb-0">Unit 3 Hollingworth Rd, Bredbury, Stockport SK6 2AR, United Kingdom
                </p>
                <p class="text-16 text-white mb-0">Copyright 2025, all rights reserved.</p>

                <div class="links d-flex justify-content-center text-uppercase py-2">
                    <!--  <a href="#" class="text-20 highlight-text">Home</a>
                    <span class="text-white px-1">-</span>
                    <a href="#" class="text-20 highlight-text">About</a> -->
                </div>

                <div class="links d-flex justify-content-center text-uppercase">
                    <a href="#" class="text-14 text-white">Privacy Policy</a>
                    <span class="text-white px-1">-</span>
                    <a href="#" class="text-14 text-white">Terms & Conditions</a>
                </div>

            </div>
        </div>
        <!-- FOOTER SECTION END -->

    </div>

</body>

</html>