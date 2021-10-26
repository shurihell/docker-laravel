<!doctype html>
<html lang="utf-8">
<head>
    <meta charset="utf-8">
    <title>Signin idus</title>
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.kr/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Favicons -->

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body class="text-center">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<main class="form-signin">
    {!! Form::open(['route' => 'login', 'class' =>'', 'method' => 'post', 'role' => 'form', 'id'=>'login-form', 'encrypt' => 'multipart/form-data']) !!}
    <a href="/">
        <img class="mb-4" src="https://www.idus.com/resources/dist/images/logo.svg" width="72" height="57" alt="">
    </a>
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" name="email">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name="password">
        <label for="floatingPassword">Password</label>
    </div>
    <p class="mb-3 text-muted">
        <a href="{{ route('register-form') }}">회원 가입</a>
    </p>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    {!! Form::close() !!}
</main>

@yield('layout.footer-script')

</body>
</html>
