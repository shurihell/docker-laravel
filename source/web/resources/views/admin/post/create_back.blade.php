@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.post') }}
@endsection

@section( 'content' )
    <div class="container-fluid">
        <div class="row margin-bottom">
            <div class="col-md-12">
                {!! Form::open(['method' => 'POST', 'route' => ['post.store'], 'class' => 'form-horizontal', 'id' => 'post-form', 'enctype'=>"multipart/form-data"]) !!}
                <fieldset>
                    <div class="form-group">
                        <label for="title" class="control-label col-md-2 text-left">제목</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" placeholder="포스트 제목 입력" name="title" id="title" value="" required>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                {{ $errors->first('title') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category" class="control-label col-md-2 text-left">대분류선택</label>
                        <div class="col-md-4">
                            <select class="form-control" name="category" required>
                                <option value="">카테고리선택</option>
                                <option value="N001">뉴스</option>
                                <option value="R001">리뷰</option>
                                <option value="F001">FEATURES</option>
                                <option value="D001">핫딜</option>
                            </select>
                            @if($errors->has('category'))
                                <span class="help-block">{{ $errors->first('category') }}</span>
                            @endif
                        </div>

                        <label for="sub_category" class="control-label-2 col-md-2 text-left">섹션선택</label>
                        <div class="col-md-4">
                            <select class="form-control" name="sub_category" required>
                                <option value="">섹션선택</option>
                                <option value="HOTEL">호텔</option>
                                <option value="FLIGHT">항공</option>
                            </select>
                            @if($errors->has('sub_category'))
                                <span class="help-block">{{ $errors->first('sub_category') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group margin-bottom">
                        <label for="img" class="control-label col-md-2 text-left">Visual영역 이미지</label>
                        <div class="col-md-4">
                            <input type="file" name="background" id="background" class="form-control">
                            @if($errors->has('background'))
                                <span class="help-block">{{ $errors->first('background') }}</span>
                            @endif
                        </div>

                        <label for="is_open" class="control-label-2 col-md-4 text-left">
                            <p class="text-warning">백그라운드이미지 최소크기: 1920X450 px 이미지</p>
                        </label>

                    </div>

                    <div class="form-group margin-bottom">
                        <label for="img" class="control-label col-md-2 text-left">포스트 이미지</label>
                        <div class="col-md-4">
                            <input type="file" name="img" id="img" class="form-control" required="required">
                            @if($errors->has('img'))
                                <span class="help-block">{{ $errors->first('img') }}</span>
                            @endif
                        </div>

                        <label for="is_open" class="control-label-2 col-md-2 text-left">오픈여부</label>
                        <div class="col-md-4">
                            <select name="is_open" id="is_open" class="form-control" required="required">
                                <option value="">오픈여부 선택</option>
                                <option value="Y">오픈</option>
                                <option value="N">비오픈</option>
                            </select>
                        </div>
                    </div>

                    {{-- SEO 처리 --}}

                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading clearfix">
                                <h4 class="panel-title panel-title-icon pull-left" style="padding-top: 7.5px;">검색엔진 메타 설정</h4>
                                <div class="btn-group pull-right"><a href="#" class="btn btn-primary btn-xs" id="og-close" data-toggle="arcodion" data-target="#seo">close</a> </div>
                            </div>
                            <div class="panel-body" id="seo">

                                <div class="row margin-bottom">

                                    <div class="form-group">
                                        <label class="control-label col-md-1"><span class="badge badge-primary"><i class="fa fa-star"></i> </span> 제목<p><span class="badge badge-info">og:title</span></p></label>
                                        <div class="col-md-10">
                                            <input name="og_title" id="og_title" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="control-label col-md-1"><span class="badge badge-primary"><i class="fa fa-star"></i></span> 설명<p><span class="badge badge-info">og:description</span></p></label>
                                        <div class="col-md-5"><textarea name="description" class="form-control" style="max-width: 95%;"></textarea></div>
                                        <label for="keywords" class="control-label-2 col-md-1"><span class="badge badge-primary"><i class="fa fa-star"></i></span> 키워드<p><span class="badge badge-info">og:keywords</span></p></label>
                                        <div class="col-md-5"><textarea name="keywords" class="form-control" style="max-width: 95%;"></textarea></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="author" class="control-label col-md-1">작성자<p><span class="badge badge-info">og:author</span></p> </label>
                                        <div class="col-md-5">
                                            <input name="author" class="form-control" value="{{ Auth::user()->name }}">
                                        </div>
                                        <label for="section" class="control-label-2 col-md-1">섹션<p><span class="badge badge-info">og:section</span></p></label>
                                        <div class="col-md-5">
                                            <input type="text" name="section" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tag" class="control-label col-md-1">태그<p><span class="badge badge-info">og:tag</span></p></label>
                                        <div class="col-md-10">
                                            <input type="text" name="tag" class="form-control">
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <div class="col-md-12"><textarea name="body" id="body-text" cols="30" rows="10" autocomplete="off" required></textarea></div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-7 col-md-offset-5">
                            <a href="{{ route('post.index') }}" class="btn btn-default"><i class="fa fa-reply"></i> 목록</a>
                            <button class="btn btn-success" data-loading-text="포스트 저장 " type="submit">포스트 저장</button>
                            <button class="btn btn-info" id="post-preview" type="button">미리보기</button>
                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>

    </div>

    {{--미리보기 모달--}}
    <div class="modal fade bs-example-modal-lg in movie-info" id="post-modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog modal-lg form-group">
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">포스트 미리보기</h4>
                </div>
                <div class="modal-body">
                    <div id="preview"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection



@section( 'footer-script' )
    <script type="text/javascript" src="/assets/editor/js/plugins/align.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/char_counter.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/code_beautifier.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/code_view.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/colors.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/draggable.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/emoticons.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/entities.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/file.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/font_size.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/fullscreen.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/image.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/image_manager.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/line_breaker.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/inline_style.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/link.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/lists.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/paragraph_format.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/paragraph_style.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/quick_insert.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/quote.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/table.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/save.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/url.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/video.min.js"></script>
    <script type="text/javascript" src="/assets/editor/js/languages/ko.js"></script>
    <script type="text/javascript" src="/assets/editor/js/plugins/font_family.min.js"></script>
    <script type="text/javascript">

        $(function () {

            //form validateion
            $("#post-form").validate({
                rules: {
                    title: {
                        required: true, minlength: 6, maxlength: 400
                    },
                    category: {required: true},
                    sub_category: {required: true},
                    img: {required: true},
                    is_open: {required: true},
                    body: {required: true, minlength: 10}
                },
                messages: {
                    title: {
                        required: "제목을 입력해 주세요."
                    },
                    category: {
                        required: "카테고리를 선택해 주세요."
                    },
                    sub_category: {
                        required: "서브 카테고리를 선택해 주세요."
                    },
                    img: {
                        required: "포스트 대표이미지를 업로드해주세요."
                    },
                    is_open: {
                        required: "포스트 오픈여부를 확인해 주세요."
                    },
                    body: {
                        required: "포스트 내용을 입력해 주세요.",
                        minlength: "포스트 내용은 최소 10자 이상이어야 합니다."
                    }
                },
                invalidHandler: function (frm, validator) {
                    var error = validator.numberOfInvalids();
                    if(error){
//                        alerts(validator.errorList[0].message, "error");
                    }
                },
                submitHandler: function (frm) {
                    frm.submit();
                }
            });

            $("#og-close").on("click", function () {

                var btn = $(this);
                $("#seo").toggle(function () {
                    if(btn.text() == 'close'){
                        btn.text('open');
                    }else{
                        btn.text('close');
                    }
                });
            });

            //에디터 처리
            $('#body-text').froalaEditor({
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
                enter: $.FroalaEditor.ENTER_P, //ENTER_P, ENTER_BR, ENTER_DIV
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
            })
                .on('froalaEditor.save.before', function(e, editor){

                    //console.log('before', editor);

                }).on('froalaEditor.save.after', function(e, editor, response){

//                var content = $("#content").val();

//            consle.log(content);
//            console.log('after', editor);
            }).on('froalaEditor.save.error', function(e, editor, error){

                console.log('error', error);
            }).on('froalaEditor.contentChanged', function (e, editor) {
                $('#preview').html(editor.html.get());
            });
            //모달 미리보기
            $("#post-preview").on("click", function () {
                $("#post-modal").modal({
                    'display': 'show',
                    'width': '1200px'
                })
            });
        });
    </script>
@endsection