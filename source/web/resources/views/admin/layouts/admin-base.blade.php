<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Styles -->
{{--    {!! Html::style(mix('/assets/css/app.css')) !!}--}}
    <link href="{{ asset('assets/css/app.css') }}" crossorigin="anonymous">
    <link href="{{ asset('assets/css/vendor.css') }}" crossorigin="anonymous">
{{--    {{ Html::style(mix('/assets/css/vendor.css')) }}--}}

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    {{ Html::script('/assets/js/web.js') }}

    @yield('content-header-script')

</head>

<body class="@yield( 'body-class' )" @yield( 'body-attr' )>

<div id='document'>

    @yield('content-header')

    @yield('content-body')

    @yield('content-footer')

</div>

@yield('content-footer-script')

{{-- 본문에서 오는 푸터 --}}
@yield( 'footer-script' )
</body>

</html>
