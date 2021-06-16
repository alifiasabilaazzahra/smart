<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags-->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{$title}}</title>
    
    <link href="/assets/cm/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="/assets/cm/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="/assets/cm/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Main CSS--><link href="/assets/cm/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="/assets/cm/css/theme.css" rel="stylesheet" media="all">
    <link rel="icon" href="/assets/img/logo/logo.png">
</head>

<body>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        @include('temp/assets_siswa/header_mobile')
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        @include('temp/assets_siswa/menu_sidebar')
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            @include('temp/assets_siswa/header_desktop')
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="pt-5">
                <div class="section__content section__content--p30">
                    @foreach($load as $key)
                        @include($key)
                    @endforeach

                    
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                @csrf                                                           
    </form>
    
    <!-- Jquery JS-->
    <script src="/assets/cm/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="/assets/cm/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="/assets/cm/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <script src="/assets/cm/vendor/animsition/animsition.min.js"></script>

    <!-- Main JS-->
    <script src="/assets/cm/js/yand.js"></script>

</body>

</html>
<!-- end document-->
