@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{--todo breadcrumbs 구성해야 함--}}
    {{--@include('/vendor/breadcrumbs/wide', ['breadcrumbs' => Breadcrumbs::generate('admin.config.board')])--}}
@endsection

@section( 'content' )
    <div class="container-fluid">

        <div class="row margin-bottom">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">Contents Hub 로그인</h1>
                <div class="account-wall">
                    {!! Form::open(['method' => 'POST', 'route' => ['login.authenticated'], 'class' => 'form-signin', 'id' => 'login-form', 'autocomplete' => 'off']) !!}
                    <fieldset>
                        <p class="margin-bottom"><input type="text" class="form-control" placeholder="Email 입력" required
                                                        autofocus name="email" id="email"></p>
                        <p class="margin-bottom"><input type="password" class="form-control" placeholder="비밀번호 입력"
                                                        required name="password" id="passwd"></p>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
