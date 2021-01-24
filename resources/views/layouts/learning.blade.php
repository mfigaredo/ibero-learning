<!DOCTYPE html>
<html lang="es">
    <head>
        <title>{{ env('APP_NAME') }}</title>
        <meta charset="UTF-8">
        <meta name="description" content="WebUni Education Template">
        <meta name="keywords" content="webuni, education, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link href="/img/favicon.ico" rel="shortcut icon"/>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="/css/owl.carousel.css"/>
        <link rel="stylesheet" href="/css/style.css"/>


        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        @stack('css')
    </head>
    <body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('partials.learning.navigation')

    @yield('hero')
    
    @component('components.alert-component')@endcomponent

    <div id="app">
        @yield('content')
    </div>

    @include('partials.learning.footer')

    <!--====== Javascripts & Jquery ======-->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/mixitup.min.js"></script>
    <script src="/js/circle-progress.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js" integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg==" crossorigin="anonymous"></script>
    <script>
        jQuery(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                }
            });

            $('.toggle-wish').unbind().on('click', function(e) {
                const self = $(this);
                const route = self.data('route');
                jQuery.ajax({
                    method: 'PUT',
                    url: route,
                    beforeSend: function() {
                        $.blockUI({
                            message: '{{ __('Procesando....') }}',
                        });
                    },
                    success: function(data) {
                        self.toggleClass('text-danger')
                            .removeClass(data.icon_remove)
                            .addClass(data.icon_add);
                    },
                    complete: function() {
                        $.unblockUI();
                    },
                });
            });
        });
    </script>

    @stack('js')
    </body>
</html>
