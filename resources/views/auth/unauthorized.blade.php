
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="AFEX - Affiliate Express is a complete solution for affiliate marketers.">
    <meta name="keywords" content="AFEX, Affiliate Express, CPA Solution, SMS Autoresponder, Email Autoresponder, Chat Bot">
    <meta name="author" content="AFEX">
    <title>Not-authorized</title>
    <link rel="apple-touch-icon" href="{!! asset('app-assets/images/ico/apple-icon-120.png') !!}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('app-assets/images/ico/favicon.ico') !!}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/vendors.min.css') !!}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/bootstrap.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/bootstrap-extended.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/colors.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/components.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/themes/dark-layout.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/themes/semi-dark-layout.css') !!}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/core/menu/menu-types/horizontal-menu.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/core/colors/palette-gradient.css') !!}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/style.css') !!}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- maintenance -->
                <section class="row flexbox-container">
                    <div class="col-xl-7 col-md-8 col-12 d-flex justify-content-center">
                        <div class="card auth-card bg-transparent shadow-none rounded-0 mb-0 w-100">
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <img src="{!! asset('app-assets/images/pages/not-authorized.png') !!}" class="img-fluid align-self-center" alt="branding logo">
                                    <h1 class="font-large-2 my-2">You are not authorized!</h1>
                                    <p class="p-2">
                                        Sorry! You are not authorized to access this page. If you see the page unexpectedly then please inform us to our <a href="{{ url('contact') }}">contact page</a>.<br/>
                                        -Thank you
                                    </p>
                                    <a class="btn btn-primary btn-lg mt-2" href="{{ url('dashboard') }}">Back to Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- maintenance end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{!! asset('app-assets/vendors/js/vendors.min.js') !!}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{!! asset('app-assets/vendors/js/ui/jquery.sticky.js') !!}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{!! asset('app-assets/js/core/app-menu.js') !!}"></script>
    <script src="{!! asset('app-assets/js/core/app.js') !!}"></script>
    <script src="{!! asset('app-assets/js/scripts/components.js') !!}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>