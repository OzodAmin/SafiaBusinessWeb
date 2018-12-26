<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('Login') }}</title>

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('front/login.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="{{ asset('front/images/icons/index.ico') }}">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('front/images/icons/index.ico') }}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('front/images/icons/index.ico') }}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('front/images/icons/index.ico') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('front/images/icons/index.ico') }}">
    </head>

    @yield('content')

        <!-- Javascript -->
        <script src="{{ asset('front/assets/js/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('front/assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('front/assets/js/jquery.backstretch.js') }}"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                $.backstretch("{{ asset('front/assets/img/backgrounds/1.jpg') }}");
                $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
                    $(this).removeClass('input-error');
                });
                
                $('.login-form').on('submit', function(e) {
                    
                    $(this).find('input[type="text"], input[type="password"], textarea').each(function(){
                        if( $(this).val() == "" ) {
                            e.preventDefault();
                            $(this).addClass('input-error');
                        }
                        else {
                            $(this).removeClass('input-error');
                        }
                    });
                    
                });
            });
        </script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>