@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.post') }}
@endsection

@section( 'content' )

    <div class="container-fluid">
        <div class="row margin-bottom">
            <div class="col-md-12">
                {!! Form::open([
                    'method' => 'POST', 'route' => ['post.store'], 'class' => 'form-horizontal', 'id' => 'post-form',
                    'enctype'=>"multipart/form-data", 'autocomplete' => 'off'
                ]) !!}

                <fieldset>
                    <div class="form-group">
                        <label for="title" class="control-label col-md-1 text-left">제목</label>
                        <div class="col-md-11">
                            <input class="form-control" placeholder="키워드 명 입력" required="" name="title" type="text" id="title" value="{{ old('title') }}" required="true">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                {{ $errors->first('title') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="control-label col-md-1 text-left">카테고리</label>
                        <div class="col-md-5">
                            {!! Form::select('category_id', $category_list, old('category_id'), ['class'=>'form-control', 'placeholder' => '선택하세요', 'required' => 'true']) !!}
                            @if ($errors->has('title'))
                                <span class="help-block">
                            {{ $errors->first('title') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="control-label col-md-1 text-left">토픽 키워드</label>
                        <div class="col-md-5">
                            {!! Form::select('keyword_id', $keyword_list, old('keyword_id'), ['class'=>'form-control', 'placeholder' => '선택하세요', 'required' => 'true' ]) !!}
                            @if ($errors->has('keyword_id'))
                                <span class="help-block">
                            {{ $errors->first('keyword_id') }}
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="title" class="control-label col-md-1 text-left">내용</label>
                        <div class="col-md-11">
                            <textarea class="form-control" name="content" rows="5" id="editor" >{{ old('content') }}</textarea>
                            @if ($errors->has('require'))
                                <span class="help-block">
                            {{ $errors->first('require') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="control-label col-md-1 text-left">썸네일</label>
                        <div class="col-md-5">
                            <input type="file" class="form-control" placeholder="이미지를 선택해 주세요." name="thumbnail">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="control-label col-md-1 text-left">콘텐츠 유형</label>
                        <div class="col-md-5">
                            {!! Form::select('type', $type_list, '', ['class'=>'form-control', 'placeholder' => '선택하세요']) !!}
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="avatar" class="control-label col-md-1 text-left">학습 시간</label>
                        <div class="col-md-5">
                            <input class="" type="number" name="minute" placeholder="분을 입력해주세요." max="59" style="width: 150px;" value="{{ old('minute') }}" required="true"> :
                            <input class="" type="number" name="second" placeholder="초를 입력해주세요." style="width: 150px;" value="{{ old('second') }}" required="true">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="title" class="control-label col-md-1 text-left">추천 여부</label>
                        <div class="col-md-5">
                            <input id="toggle-demo" type="checkbox" data-toggle="toggle" name="is_recommend" value="1" >
                            @if ($errors->has('is_recommend'))
                                <span class="help-block">
                            {{ $errors->first('is_recommend') }}
                            </span>
                            @endif
                        </div>
                    </div>




                </fieldset>

                <div class="form-group">
                    <div class="col-md-7 col-md-offset-5">
                        <a href="{{ route('post.index') }}" class="btn btn-default"><i class="fa fa-reply"></i> 목록</a>
                        <button class="btn btn-success" data-loading-text="게시글 저장 " type="submit">저장</button>
                        {{--<button class="btn btn-info" id="post-preview" type="button">미리보기</button>--}}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>

        </div>
    </div>

@endsection

@section( 'footer-script' )
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script type="text/javascript" src="/assets/editor/js/languages/ko.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/font_family.min.js"></script>


    <script type="text/javascript">
        $(function () {
            $('input[type="file"]').prettyFile();

            //form validation
            $("#post-form").validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    category_id: {
                        required: true
                    },
                    keyword_id: {
                        required: true
                    },
                    content: {
                        required: true,
                        minlength: 10
                    },
                    thumbnail: {
                        required: true
                    },
                    type: {
                        required: true
                        // required: true,
                        // fileType: {
                        //     types: ["jpeg","png","jpg","gif","svg"]
                        // },
                    },
                    minute: {
                        required: true,
                        max: 59
                    },
                    second: {
                        required: true,
                        max: 59
                    }
                },
                messages: {
                    title: {
                        required: "제목을 입력해주세요.",
                        minlength: "2자 이상 입력해주세요.",
                        maxlength: "최대 255자까지 입력 가능합니다."
                    },
                    category_id: {
                        required: "카테고리를 선택해주세요."
                    },
                    keyword_id: {
                        required: "토픽 키워드를 선택해주세요."
                    },
                    content: {
                        required: "내용을 입력해주세요.",
                        minlength: "최소 10자 이상 입력해주세요."
                    },
                    thumbnail: {
                        required: "썸네일을 등록해주세요.",
                        fileType: "파일타입은 jpeg,png,jpg,gif,svg 형식만 가능합니다."
                    },
                    type: {
                        required: "학습 콘텐츠 유형을 선택해주세요."
                    },
                    minute: {
                        required: "분을 입력해주세요.",
                        max: "최대 59까지 입력 가능합니다."
                    },
                    second: {
                        required: "초를 입력해주세요.",
                        max: "최대 59까지 입력 가능합니다."
                    }
                },
                submitHandler: function (frm) {
                    frm.submit();
                }
            });


//에디터 처리
            new FroalaEditor('#editor', {
                // documentReady: true,
                attribution: false,
                inlineMode: false,
                useClasses: true,
                language: 'ko',
                imageUploadURL: '/fr/img-up',
                imageMove: true,
                imageUploadParams: {id: 'editor', 'user_id': '{{ Auth::user()->id }}', _token: "{{ csrf_token() }}"},
                imageManagerLoadURL: '/fr/img-list?user_id={{ Auth::user()->id }}',
                imageManagerDeleteURL: '/fr/img-del',
                imageManagerLoadMethod: 'POST',
                imageManagerLoadParams: {user_id: '{{ Auth::user()->id }}', _token: "{{ csrf_token() }}"},
                fileUploadURL: '/fr/file-up?user_id={{ Auth::user()->id }}',
//                imageUploadParam: 'image',
                key: '{{ env('EDITOR') }}',
                fileAllowedTypes: ['*'],
                // enter: $.FroalaEditor.ENTER_P, //ENTER_P, ENTER_BR, ENTER_DIV
                tabSpaces: 4,
                fontFamilyDefaultSelection: '나눔고딕',
                fontFamily: {
                    'Nanum Gothic,sans-serif': '나눔고딕',
                    'Arial,Helvetica,sans-serif': 'Arial',
                    'Georgia,serif': 'Georgia',
                    'Impact,Charcoal,sans-serif': 'Impact',
                    'Tahoma,Geneva,sans-serif': 'Tahoma',
                    'Times New Roman,Times,serif,-webkit-standard': 'Times New Roman',
                    'Verdana,Geneva,sans-serif': 'Verdana'
                },
                // videoResponsive: true,
//            fontFamilySelection: true,
                heightMin: 500,
                heightMax: 27000,
                zIndex: 1,
                codeMirror: window.CodeMirror,
                codeMirrorOptions: {
                    tabSize: 4,
                    lineNumbers: true,
                    mode: 'text/html',
                    tabMode: 'indent',
                    lineWrapping: true
                },
                codeBeautifierOptions: {
                    end_with_newline: true,
                    indent_inner_html: true,
                    extra_liners: "['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'blockquote', 'pre', 'ul', 'ol', 'table', 'dl']",
                    brace_style: 'expand',
                    indent_char: ' ',
                    indent_size: 4,
                    wrap_line_length: 0
                },
                paragraphFormatSelection: true, //true가 선언되면 셀렉트박스 형태이다. 기본 false(아이콘형식)
                paragraphFormat: {
                    N: 'Normal',
                    H1: 'Heading 1',
                    H2: 'Heading 2',
                    H3: 'Heading 3',
                    H4: 'Heading 4',
                    H5: 'Heading 5',
                    PRE: 'Code',
                },
                paragraphFormatSelection: true,
                spellcheck: true,
                pasteAllowLocalImages: true,
                linkConvertEmailAddress: true,
                linkAlwaysBlank: true,
                //자동 save기능 설정
//                saveInterval: 2500,
//                saveMethod: 'POST',
//                saveParam: 'content',
//                saveURL: 'http://localhost/wysiwyg/auto-save',
//                saveParams: {uuid: '', id: '', 'subject': $("#subject").val(), 'category': ""},
                imagePasteProcess: true,
                pasteAllowLocalImages: true,
                pastePlain: false,
//            shortcutsEnabled: ['show', 'bold', 'italic', 'underline', 'strikeThrough', 'indent', 'outdent', 'undo', 'redo', 'insertImage', 'createLink', 'paragraphFormat']
            });

        });
    </script>
@endsection
