<!doctype html>
<html lang="utf-8">
<head>
    <meta charset="utf-8">
    <title>Signin idus</title>
    <!-- Bootstrap core CSS -->
    {{--    <link href="{{ asset('assets/css/web.css') }}" crossorigin="anonymous">--}}
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

        .form-signin input {
            margin-bottom: 20px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .error {
            margin-top: 50px;
            color: red;
        }

    </style>
</head>
<body class="text-center">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" crossorigin="anonymous"></script>

<main class="form-signin">
    {!! Form::open(['route' => 'register', 'class' =>'', 'method' => 'post', 'role' => 'form', 'id'=>'login-form', 'encrypt' => 'multipart/form-data']) !!}

    <a href="/">
        <img class="mb-4" src="https://www.idus.com/resources/dist/images/logo.svg" width="72" height="57" alt="">
    </a>
    <h1 class="h3 mb-3 fw-normal">회원 가입</h1>


    <div class="form-floating">
        <input type="email" class="form-control" id="floatingInput" name="email" value="test@test.com">
        <label for="floatingInput">이메일을 입력하세요.</label>
    </div>
    <div class="form-floating" >
        <input type="text" class="form-control" id="floatingPassword" name="password">
        <label for="floatingPassword">비밀번호를 입력하세요.</label>
    </div>
    <div class="form-floating">
        <input type="text" class="form-control" id="floatingName" name="name">
        <label for="floatingName">이름을 입력하세요.</label>
    </div>
    <div class="form-floating">
        <input type="text" class="form-control" id="floatingNickName" name="nickname">
        <label for="floatingNickName">별명을 입력하세요.</label>
    </div>
    <div class="form-floating">
        <input type="text" class="form-control" id="floatingTel" name="tel">
        <label for="floatingTel">전화번호를 입력하세요.</label>
    </div>

    <div class="form-control mb-4">
        <label class="mb-1">성별을 입력하세요.</label>
        <div class="row">
            <input type="radio" class="col-4" value="M" name="sex">남성
            <input type="radio" class="col-4" value="F" name="sex">여성
        </div>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    {!! Form::close() !!}
</main>

<script>
    $(document).ready(function () {
        @if($message = \Illuminate\Support\Facades\Session::get('alert-message'))
        var msg_status = "{{ Session::get('alert-message') }}";
        alert(msg_status);
        @endif

        $("form").validate({
            rules: {
                password: {
                    required : true,
                    minlength : 10,
                    regex : "(?=.*\d{1,50})(?=.*[~`!@#$%\^&*()-+=]{1,50})(?=.*[A-Za-z]{1,50}).{8,50}$"
                },
                name: {
                    required : true,
                    minlength : 2,
                    regex : "^[ㄱ-ㅎ|가-힣|a-z|A-Z]+$"
                },
                nickname: {
                    required : true,
                    minlength : 2,
                    regex : "^[a-z|]+$"
                },
                email: {
                    required : true,
                    minlength : 2,
                    email : true
                },
                tel: {
                    required : true,
                    minlength : 11,
                    regex : "^(010)[-\\s]?\\d{3,4}[-\\s]?\\d{4}$"
                },
            },
            messages : {
                password: {
                    required : "필수로입력하세요",
                    minlength : "최소 {0}글자이상이어야 합니다",
                    regex : "영문 소문자, 대문자, 숫자, 특수문자 1개 이상 입력해주세요."
                },
                name: {
                    required : "필수로입력하세요",
                    minlength : "최소 {0}글자이상이어야 합니다",
                    regex : "한글 혹은 영어만 입력 가능합니다."
                },
                nickname: {
                    required : "필수로입력하세요",
                    minlength : "최소 {0}글자이상이어야 합니다",
                    regex : "영어 소문자만 입력 가능합니다."
                },
                email: {
                    required : "필수로입력하세요",
                    minlength : "최소 {0}글자이상이어야 합니다",
                    email : "메일규칙에 어긋납니다"
                },
                tel: {
                    required : "필수로입력하세요",
                    minlength : "최소 {0}글자이상이어야 합니다",
                    regex : "010-0000-0000 형식으로 입력해주세요."
                },
            },
            submitHandler: function() {
                var f = confirm("회원가입을 완료하겠습니까?");
                if(f){
                    return true;
                } else {
                    return false;
                }
            },
        });
    });

    $.validator.addMethod("regex", function(value, element, regexp) {
        let re = new RegExp(regexp);
        let res = re.test(value)
        return res;
    });
    @yield('layout.footer-script')
</script>

</body>
</html>
