@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.visual') }}
@endsection

@section( 'content' )
    {{--{{dd($errors)}}--}}
    <div class="container-fluid">

        <div class="row margin-bottom">

            <div class="col-md-12">
                @if($mode == 'PATCH')
                    {!! Form::open(['method' => $mode, 'route' => ['visual.update', $row->id], 'class' => 'form-horizontal', 'id' => 'visual-form', 'enctype'=>"multipart/form-data", 'autocomplete' => 'off']) !!}
                    <input type="hidden" id="set_img" value="{{ ($row->image)? '1': '0' }}">
                @else
                    {!! Form::open(['method' => 'POST', 'route' => ['visual.store'], 'class' => 'form-horizontal', 'id' => 'visual-form', 'enctype'=>"multipart/form-data", 'autocomplete' => 'off']) !!}
                @endif

                <fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <p class="text-center">
                                <label class="radio-inline"><input name="section" type="radio" value="v_mode" checked> 설정구성 모드</label>
                                <label class="radio-inline"><input name="section" type="radio" value="h_mode"> html 코드 모드</label>
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="control-label col-md-2 text-left">HTMl 위치</label>
                        <div class="col-md-4">
                            <select class="form-control" name="position" required>
                                <option value="">상단 위치 선택</option>
                                @foreach(\App\Helpers\Helper::positionList() as $k => $text)
                                    <option value="{{ $k }}"{!! ($row->position == $k)? ' selected': '' !!}>{{ $text }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">
                            @if($errors->has('position'))
                                {{ $errors->first('position') }}
                            @endif
                            </span>
                        </div>

                        <label for="sub_category" class="control-label-2 col-md-2 text-left">적용여부</label>
                        <div class="col-md-4">
                            <label class="radio-inline"><input type="radio" name="is_open" value="Y" required{!! ($row->is_open == 'Y')? ' checked': '' !!}>적용</label>
                            <label class="radio-inline"><input type="radio" name="is_open" value="N" required{!! ($row->is_open == 'N')? ' checked': '' !!}>미적용</label>
                            {{--<p class="text-warning">각 영역별 HTMl는 1개만 적용됩니다.<strong>(기존 설정된 HTML은 자동 미적용으로 변경됩니다.)</strong></p>--}}
                            @if($errors->has('is_open'))
                                <span class="help-block">{{ $errors->first('is_open') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="editor" class="control-label col-md-2">에디터선택</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <select name="users_id" id="users_id" class="form-control">
                                    <option value="">에디터를 선택해 주세요.</option>
                                    @if($editors->isEmpty() !=true)
                                        @foreach($editors as $key => $editor)
                                            <option data-users_name="{{ $editor->name }}" value="{{ $editor->id }}"{{ ($row->users_id == $editor->id)? ' selected': '' }}>{{ $editor->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <label for="editor" class="control-label-2 col-md-2">에디터명</label>
                        <div class="col-md-4">
                            {{--<input type="text" class="form-control" name="users_name" id="users_name" value="{{ ($row->users_id == $editor->id)? $editor->name: '' }}" readonly>--}}
                            <input type="text" class="form-control" name="users_name" id="users_name" value="{{ $row->users_name }}" readonly>
                        </div>
                    </div>

                    <div id="v_mode">
                        <div class="form-group">
                            <label for="title" class="control-label col-md-2">상단 텍스트</label>
                            <div class="col-md-10">
                                <input type="text" name="title" class="form-control"
                                       placeholder="상단에 출력될 텍스트를 입력해 주세요." value="{{ $row->title }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                {{ $errors->first('title') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="control-label col-md-2 text-left">상단 이미지 등록</label>
                            <div class="col-md-4">
                                @if($row->image)
                                    <p class=""><a href="{{ $row->image }}" target="_blank"><img src="{{ $row->image }}" id="image" class="img-thumbnail" style="max-width: 440px;"></a></p>
                                    <p class="text-center"><button type="button" data-id="{{ $row->id }}" data-field="image" class="btn btn-sm btn-danger del-image">이미지 삭제</button> </p>
                                @else
                                    <p class=""><img src="holder.js/430x100?text=No Image" class="img-thumbnail"></p>
                                @endif
                                <div class="input-group">
                                    <input type="file" name="image" placeholder="상단이미지 등록" class="file">
                                    <span class="input-group-addon"><i class="fa fa-file-image-o"></i></span>
                                </div>
                                <p class="text-danger">이미지 사이즈: 1920X450<strong>이미지 사이즈가 다를경우 등록이 불가 합니다.</strong></p>
                                @if($errors->has('image'))
                                    <span class="help-block">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <label for="image" class="control-label-2 col-md-2 text-left">상단 배경 이미지 등록</label>
                            <div class="col-md-4">
                                @if($row->background)
                                    <p class=""><a href="{{ $row->background }}" target="_blank"><img src="{{ $row->background }}" id="background" class="img-thumbnail" style="max-width: 440px;"></a></p>
                                    <p class="text-center"><button type="button" data-id="{{ $row->id }}" data-field="background" class="btn btn-sm btn-danger del-image">배경이미지 삭제</button> </p>
                                @else
                                    <p class=""><img src="holder.js/430x100?text=No Image" class="img-thumbnail"></p>
                                @endif
                                <div class="input-group">
                                    <input type="file" name="background" placeholder="상단이미지 등록" class="file">
                                    <span class="input-group-addon"><i class="fa fa-file-image-o"></i></span>
                                </div>
                                @if($errors->has('background'))
                                    <span class="help-block">{{ $errors->first('background') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="url" class="control-label col-md-2 text-left">이미지 URL</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" name="url" placeholder="연결된 이미지 url을 입력해 주세요." value="{{ $row->url }}">
                                <span class="input-group-addon">Event</span>
                                <select name="event" class="form-control">
                                    <option value="">링크 방식 선택</option>
                                    <option value="_self"{!! ($row->event == '_self')? ' selected': '' !!}>바로 연결</option>
                                    <option value="_blank"{!! ($row->event == '_blank')? ' selected': '' !!}>새창으로 연결</option>
                                </select>

                            </div>
                        </div>

                        <label for="position" class="col-md-2 control-label-2 text-left">이미지 위치</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">CSS</span>
                                <input type="text" name="style" class="form-control" placeholder="css 형식으로 입력해 주세요." value="{{ $row->style }}">
                            </div>
                        </div>
                    </div>

                    
                    <div id="h_mode" style="display:none;">
                        <div class="form-group">
                            <label for="title" class="control-label col-md-2 text-left">HTML</label>
                            <div class="col-md-10">
                                <textarea name="body" id="body-text" cols="30" rows="10" autocomplete="off">{!! $row->body !!}</textarea>
                                @if($errors->has('body'))
                                    <span class="help-block">{{ $errors->first('body') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-7 col-md-offset-5">
                            <a href="{{ route('visual.index') }}" class="btn btn-default"><i class="fa fa-reply"></i> 목록</a>
                            @if($mode == 'PATCH')
                                <button class="btn btn-success" data-loading-text="HTML 등록" type="submit">HTML 수정</button>
                                <p class="text-right">
                                    <button class="btn btn-danger" data-loading-text="HTML삭제" type="button" id="html-del">삭제</button>
                                </p>
                            @else
                                <button class="btn btn-success" data-loading-text="HTML 등록" type="submit">HTML 등록</button>
                            @endif

                        </div>
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>

        </div>

    </div>

    {!! Form::open(['method' => 'DELETE', 'id' => 'del-frm', 'route' => ['visual.destroy', 'id' => $row->id]]) !!}{!! Form::close() !!}
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

            $.validator.setDefaults({
                errorElement: "span",
                errorClass: "help-block"
            });

            @if($row->is_html == 'Y')
                $("input[name='section']").filter('[value="h_mode"]').attr("checked", true);
                $("#v_mode").hide();
                $("#h_mode").show();
            @endif

            //설정모드
            $("input[type='radio'][name='section']").on("click", function(){
                var mode = $(this).val();
                if(mode == 'v_mode'){
                    $("#"+mode).show();
                    $("#h_mode").hide();
                }else{
                    $("#"+mode).show();
                    $("#v_mode").hide();
                }
            });

            //서비스 적용 확인
//            $("input[type='radio'][name='is_open']").on("click", function(){
//                var is_open = $(this).val();
//                if(is_open == 'Y'){
//                    alerts('오픈 설정이 되면 해당 HTML위치에 오픈된 HTML 설정이 해제됩니다.', 'warning');
//                }
//            });

            //사용자 선택
            $("#users_id").on("change", function () {
                var users_name = $(this).children('option:selected').data('users_name');
                if(users_name != undefined){
                    $("#users_name").val(users_name);
                }else{
                    $("#users_name").val('');
                }
            });

            //form validation
            $("#visual-form").validate({
                rules: {
                    v_mode: {required: true},
                    position: {required: true},
                    is_open: {required: true},
                    users_id: {required: true}

                },
                messages: {
                    v_mode: {required: "상단 구성 모드를 선택해 주세요"},
                    position: {required: "작성되는 상단 데이터가 위치할 역역을 선택해 주세요."},
                    is_open: {required: "적용 여부를 선택해 주세요."},
                    users_id: {required: "해당 상단에 노출될 에티터를 선택해 주세요."}
                },
                submitHandler: function(frm){

                    var section = $("input[name='section']").val();
                    if(section == 'v_mode'){
                        var title = $("input[name='title']");
                        var image = $("input[name='image']");
                        var background = $("input[name='background']");

                        if(title.val() == ''){
                            alerts('상단 텍스트를 입력해 주세요.', "error");
                            title.focus();
                            return false;
                        }
                        if(image.val() == ''){
                            if($("#set_img").val() == 0){
                                alerts('상단 이미지를 등록해 주세요.', 'error');
                                image.focus();
                                return false;
                            }
                        }


                    }else{
                        var body = $("input[name='body']");
                        if(body.val() == ''){
                            alerts('HTML 코드를 입력해 주세요.', 'error');
                            body.focus();
                            return false;
                        }
                    }
                    return true;
                }
            });

            //삭제처리
            $("#html-del").on("click", function(){
                if(confirm('삭제하시겠습니까?')){
                    $("#del-frm").submit();
                }
            });

            //이미지 삭제처리
            $(".del-image").on("click", function () {
                if(confirm("이미지를 삭제하시겠습니까?")){
                    $.ajax({
                        url: "{{ route('visual.image-delete') }}",
                        type: "post",
                        dataType: "json",
                        data: {id: $(this).data('id'), field: $(this).data('field'), _token: "{{ csrf_token() }}"},
                        success: function(jdata, textStatus, jqXHR){

                            if(jdata.status == 'OK'){
                                alerts("이미지를 삭제하였습니다.", "success");
                                location.reload();
                            }else{
                                alerts(jdata.message, 'error');
                            }

                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            alerts("이미지 삭제를 실패하였습니다.", "error");
                            /*
                             console.log("HTTP Request Failed");
                             console.log(jqXHR);
                             console.log(textStatus);
                             console.log(errorThrown);
                             */
                        }
                    });
                }
            })

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
                enter: $.FroalaEditor.ENTER_BR,
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
                imagePasteProcess: true,
                pasteAllowLocalImages: true,
                pastePlain: false,
            });
        });
    </script>
@endsection