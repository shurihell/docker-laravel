@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.member') }}
@endsection

@section( 'content' )
    <div class="container-fluid">

        <div class="row margin-bottom">
            <div class="col-md-12">
                {!! Form::open(['method' => 'POST', 'route' => ['member.store'], 'class' => 'form-horizontal', 'id' => 'member-form', 'enctype'=>"multipart/form-data"]) !!}
                <fieldset>
                    <div class="form-group">
                        <label for="name" class="control-label col-md-2">성명</label>
                        <div class="col-md-4">
                            <input type="text" name="name" placeholder="성명을 입력해 주세요" class="form-control" required>
                            @if($errors->has('name'))
                                {{ $errors->first('name') }}
                            @endif
                        </div>
                        <label for="email" class="control-label-2 col-md-2">이메일</label>
                        <div class="col-md-4">
                            <input type="text" name="email" placeholder="이메일을" 입력해="$입력해$" 주세요="$주세요$"
                                   class="form-control" required>
                            @if($errors->has('email'))
                                {{ $errors->first('email') }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label col-md-2">패스워드</label>
                        <div class="col-md-4">
                            <input type="password" placeholder="비밀번호를 입력해주세요." name="password" class="form-control" id="password" required>
                            @if($errors->has('password'))
                                {{ $errors->first('password') }}
                            @endif
                        </div>
                        <label for="conf_password" class="control-label-2 col-md-2">패스워드 확인</label>
                        <div class="col-md-4">
                            <input type="password" placeholder="동일한 비밀번호를 재입력해주세요." name="conf_password" class="form-control" required>
                            @if($errors->has('conf_password'))
                                {{ $errors->first('conf_password') }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nickname" class="control-label col-md-2">닉네임</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="nickname" value="" placeholder="닉네임을 입력해 주세요.">
                        </div>

                        <label for="role" class="control-label-2  col-md-2">권한설정</label>
                        <div class="col-md-4">
                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('super-admin'))
                                <label class="radio-inline"><input type="radio" name="role" value="1">슈퍼 어드민</label>
                            @endif
                            <label class="radio-inline"><input type="radio" name="role" value="2">어드민</label>
                            <label class="radio-inline"><input type="radio" name="role" value="3">에디터</label>
                        </div>
                        @if($errors->has('role'))
                            {{ $errors->first('role') }}
                        @endif
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <label for="avata" class="control-label col-md-2">아바타이미지</label>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <input type="file" class="form-control" placeholder="아바타이미지를 선택해  주세요"--}}
{{--                                   name="avatar">--}}
{{--                        </div>--}}
{{--                        <label for="nickname" class="control-label-2 col-md-2">닉네임</label>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <input type="text" class="form-control" name="nickname" placeholder="닉네임을 입력해 주세요.">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="role" class="control-label col-md-2">권한설정</label>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <label class="radio-inline"><input type="radio" name="role" value="2" required>관리자</label>--}}
{{--                            <label class="radio-inline"><input type="radio" name="role" value="1" required>에디터</label>--}}
{{--                        </div>--}}

{{--                        <label for="role" class="control-label-2 col-md-2">슬로건</label>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <textarea name="profile" style="max-width:90%;"></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group">
                        <div class="col-md-7 col-md-offset-5">
                            <a href="{{ route('member.index') }}" class="btn btn-default"><i class="fa fa-reply"></i> 목록</a>
                            <button class="btn btn-success" data-loading-text="회원 등록" type="submit">회원 등록</button>

                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection



@section( 'footer-script' )
    <script type="text/javascript">
        $(function () {
            $("#member-form").validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true, email: true, email_check: true
                    },
                    password: {
                        required: true, char_check: true, minlength: 4, maxlength: 20
                    },
                    conf_password: {
                        required: true, equalTo: "#password"
                    }
                },
                messages: {
                    name: {
                        required: "성명을 입력해 주세요."
                    },
                    email: {
                        required: "이메일 주소를 정확히 입력해 주세요.",
                        email: "입력하신 이메일 주소의 형식이 잘못되었습니다.",
                        email_check: "입력하신 이메일 주소의 형식이 잘못되었습니다."
                    },
                    password: {
                        required: "비밀번호를 입력해 주세요.",
                        char_check: "비밀번호는 영문, 숫자, 특수기호('!', '@', '*', '.', '-', '_', '=') 만 허용됩니다.",
                        minlength: "비밀번호는 4자리 이상입니다.(16자리 이하)",
                        maxlength: "비밀번호는 16자리 이하입니다.(4자리 이상)"
                    },
                    conf_password: {
                        required: "비밀번호 확인을 입력해 주세요.",
                        equalTo: "비밀번호와 비밀번호 확인이 틀립니다."
                    }
                },
                submitHandler: function (frm) {
                    if($('input[name=role]:checked').val()){
                        frm.submit()
                    }else{
                        alert('권한을 선택해주세요.');
                    }
                }
            });
        })
    </script>
@endsection