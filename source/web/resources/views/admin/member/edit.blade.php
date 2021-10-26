@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.member') }}
@endsection

@section( 'content' )
    <div class="container-fluid">

        <div class="row margin-bottom">
            <div class="col-md-12">
                {!! Form::open(['method' => 'PATCH', 'route' => ['member.update', $row->id], 'class' => 'form-horizontal', 'id' => 'member-form', 'enctype'=>"multipart/form-data"]) !!}
                <fieldset>
                    <div class="form-group">
                        <label for="name" class="control-label col-md-2">성명</label>
                        <div class="col-md-4">
                            <input type="text" name="name" value="{{ $row->name }}" placeholder="성명을 입력해 주세요" class="form-control" required>
                            @if($errors->has('name'))
                                {{ $errors->first('name') }}
                            @endif
                        </div>
                        <label for="email" class="control-label-2 col-md-2">이메일</label>
                        <div class="col-md-4">
                            <input type="text" name="email" value="{{ $row->email }}" placeholder="이메일을" 입력해="$입력해$" 주세요="$주세요$"
                                   class="form-control" required>
                            @if($errors->has('email'))
                                {{ $errors->first('email') }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label col-md-2">패스워드</label>
                        <div class="col-md-4">
                            <input type="password" placeholder="비밀번호를 입력해주세요." name="password" id="password" class="form-control">
                            @if($errors->has('password'))
                                {{ $errors->first('password') }}
                            @endif
                        </div>

                        <label for="conf_password" class="control-label-2 col-md-2">생년월일</label>
                        <div class="col-md-4">
                            <input type="text" placeholder="ex)2020010" name="birth" class="form-control" value="{{ $row->birth }}" required>
                            @if($errors->has('birth'))
                                {{ $errors->first('birth') }}
                            @endif
                        </div>
{{--                        <label for="conf_password" class="control-label-2 col-md-2">패스워드 확인</label>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <input type="password" placeholder="동일한 비밀번호를 재입력해주세요." name="conf_password" class="form-control" required>--}}
{{--                            @if($errors->has('conf_password'))--}}
{{--                                {{ $errors->first('conf_password') }}--}}
{{--                            @endif--}}
{{--                        </div>--}}
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label col-md-2">부서명</label>
                        <div class="col-md-4">
                            <input type="text" name="department" value="{{ $row->department }}" placeholder="성명을 입력해 주세요" class="form-control" required>
                            @if($errors->has('department'))
                                {{ $errors->first('department') }}
                            @endif
                        </div>
                        <label for="email" class="control-label-2 col-md-2">직급</label>
                        <div class="col-md-4">
                            <input type="text" name="rank" value="{{ $row->rank }}" placeholder="이메일을" 입력해="$입력해$" 주세요="$주세요$"
                                   class="form-control" required>
                            @if($errors->has('rank'))
                                {{ $errors->first('rank') }}
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nickname" class="control-label col-md-2">계정 활성화</label>
                        <div class="col-md-4">
                            <input id="toggle-demo" type="checkbox" data-toggle="toggle" name="is_active" value="1"
                                   @if($row->is_active == 'Y')
                                   checked
                                    @endif
                            >
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('super-admin'))
                            <label for="role" class="control-label-2  col-md-2">권한설정</label>
                            <div class="col-md-4">
                                <label class="radio-inline"><input type="radio" name="role" value="1"{!! ($row->hasRole('super-admin'))? ' checked': '' !!}>슈퍼 어드민</label>
                                <label class="radio-inline"><input type="radio" name="role" value="2"{!! ($row->hasRole('admin'))? ' checked': '' !!}>어드민</label>
                                <label class="radio-inline"><input type="radio" name="role" value="3"{!! ($row->hasRole('editor'))? ' checked': '' !!}>에디터</label>
                                <label class="radio-inline"><input type="radio" name="role" value="4"{!! ($row->hasRole('member'))? ' checked': '' !!}>유저</label>
                            </div>
                        @endif

                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <a href="{{ route('member.index') }}" class="btn btn-default"><i class="fa fa-reply"></i> 목록</a>
                            @if(\App\Helpers\LgeHelper::isWritable())
                                <button class="btn btn-success" data-loading-text="회원 수정" type="submit">회원 수정</button>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('super-admin') && !$row->hasRole('super-admin'))
                                <div class="pull-right" style="padding-right: 15px;">
                                    <a class="btn btn-danger" id="del" data-delete="{{ route('member.destroy', $row->id) }}">회원 삭제</a>
                                </div>
                            @endif

                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection



@section( 'footer-script' )
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#member-form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true, email: true, email_check: true
                    },
                    birth: {
                        required: true,
                        number: true,
                        minlength: 8,
                        maxlength: 8
                    },
                    department: {
                        required: true
                    },
                    rank: {
                        required: true
                    }
                    // password: {
                    //     required: true, char_check: true, minlength: 4, maxlength: 20
                    // },
                    // conf_password: {
                    //     required: true, equalTo: "#password"
                    // }
                },
                messages: {
                    name: {
                        required: "성명을 입력해 주세요.",
                        minlength: "최소 2글자를 입력해주세요."
                    },
                    email: {
                        required: "이메일 주소를 정확히 입력해 주세요.",
                        email: "입력하신 이메일 주소의 형식이 잘못되었습니다.",
                        email_check: "입력하신 이메일 주소의 형식이 잘못되었습니다."
                    },
                    birth: {
                        required: "생년월일을 입력해주세요.",
                        number: "숫자만 입력가능합니다.",
                        minlength: "숫자 8자로 입력해주세요.",
                        maxlength: "숫자 8자로 입력해주세요."
                        // maxlenght: "최대 15자 이내로 입력해주세요."
                    },
                    department: {
                        required: "부서명를 입력해주세요.",
                        // maxlenght: "최대 15자 이내로 입력해주세요."
                    },
                    rank: {
                        required: "직급을 입력해주세요.",
                        // maxlenght: "최대 15자 이내로 입력해주세요."
                    }
                    // password: {
                    //     required: "비밀번호를 입력해 주세요.",
                    //     char_check: "비밀번호는 영문, 숫자, 특수기호('!', '@', '*', '.', '-', '_', '=') 만 허용됩니다.",
                    //     minlength: "비밀번호는 4자리 이상입니다.(16자리 이하)",
                    //     maxlength: "비밀번호는 16자리 이하입니다.(4자리 이상)"
                    // },
                    // conf_password: {
                    //     required: "비밀번호 확인을 입력해 주세요.",
                    //     equalTo: "비밀번호와 비밀번호 확인이 틀립니다."
                    // }
                }
            });


            $('#del').on('click', function(){
                var $obj = $(this);
                var msg = "해당 유저를 삭제하시겠습니까?";

                if (confirm(msg)) {
                    $.ajax({
                        url: $obj.data('delete'),
                        method: "DELETE",
                        success: function (data) {
                            if(data.status == 'success'){
                                location.href='/member';
                            }else{
                                alert(data.message);
                                console.log(data.message);
                            }
                        },
                        error: function (data) {
                            alert(data.message);
                            console.log(data);
                            console.log(data.message);
                        }
                    })
                }
            });
        })
    </script>
@endsection