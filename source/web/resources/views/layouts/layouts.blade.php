<!doctype html>
<html lang="utf-8">
<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('assets/css/web.css') }}" crossorigin="anonymous">

    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
</head>

<script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token(), ]) !!};
    </script>
<body>
    @include('layouts.header')
    <div>

        @yield('content')
        @yield('script-bottom')
    </div>
</body>

</html>
