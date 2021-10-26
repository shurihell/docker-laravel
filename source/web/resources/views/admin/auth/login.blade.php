@extends( 'admin.layouts.default' )

@section( 'content' )
    <div class="container-fluid">

        <div class="row margin-bottom">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title">Contents Hub 로그인</h1>
                <div class="account-wall">
                    {!! Form::open(['method' => 'POST', 'route' => 'login', 'class' => 'form-signin', 'id' => 'login-form', 'autocomplete' => 'off']) !!}
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



@push( 'footer-script' )
    <script type="text/javascript">
        $(function () {

            $("#login-form").validate({
                rules: {
                    email: {
                        required: true, email: true, email_check: true
                    },
                    password: {
                        required: true, minlength: 6, maxlength: 20, char_check: true
                    }
                },
                messages: {
                    email: {
                        required: "이메일주소를 입력해 주세요.",
                        email: "입력하신 이메일 주소 형식이 잘못되었습니다.",
                        email_check: "입력하신 이메일 주소 형식이 잘못되었습니다.2"
                    },
                    password: {
                        required: "비밀번호를 입력해 주세요.",
                        char_check: "비밀번호는 영문, 숫자, 특수기호('!', '@', '*', '.', '-', '_', '=') 만 허용됩니다.",
                        minlength: "비밀번호는 6자리 이상입니다.(20자리 이하)",
                        maxlength: "비밀번호는 20자리 이하입니다.(4자리 이상)"
                    }
                },
                invalidHandler: function (frm, validator) {
//                    var error = validator.numberOfInvalids();
//                    if(error){
//                        alert(validator.errorList[0].message);
////                        console.info(validator.errorList);
//                    }
                },
                submitHandler: function (frm) {
                    frm.submit();
                    // $.ajax({
                    //     url : 'token_check',
                    //     method : 'post',
                    //     data : {
                    //         email : $('#email').val()
                    //     },
                    //     success: function(data){
                    //         if(data.state == 'success'){
                    //             frm.submit();
                    //         }
                    //
                    //         else{
                    //             if(confirm('이미 로그인 된 아이디입니다. 로그아웃 시키시겠습니까?')){
                    //                 token_delete();
                    //             }
                    //         }
                    //     },
                    //     error: function(data){
                    //         console.log(JSON.stringify(data));
                    //     }
                    // })
                }
            });



            // function token_delete(){
            //     $.ajax({
            //         url : 'token_delete',
            //         method : 'post',
            //         data : {
            //             email : $('#email').val()
            //         },
            //         success: function(data){
            //             alert('성공적으로 로그아웃 되었습니다. 다시 로그인해주세요.');
            //         },
            //         error: function(data){
            //             // console.log(JSON.stringify(data));
            //             alert('에러가 발생했습니다. 관리자에게 문의하세요.');
            //         }
            //     })
            // }
        })
    </script>
@endpush
