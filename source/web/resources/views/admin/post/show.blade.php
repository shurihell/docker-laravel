@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.post') }}
@endsection

@section( 'content' )
    <div class="container-fluid">

        <div class="row margin-bottom">
            <div class="col-md-12">
                <form class="form-horizontal">
                <fieldset class=" margin-bottom">
                    <div class="form-group">
                        <label for="title" class="control-label col-md-2 text-left">제목</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" placeholder="포스트 제목 입력" name="title" id="title" value="{{ $row->title }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category" class="control-label col-md-2 text-left">대분류선택</label>
                        <div class="col-md-4 control-label">
                            <p class="text-left">{{ substr($row->posts_code, 0, 4) }} ({{ \App\Helpers\Helper::get_category_name(substr($row->posts_code, 0, 4)) }})</p>
                        </div>

                        <label for="sub_category" class="control-label-2 col-md-2 text-left">섹션선택</label>
                        <div class="col-md-4 control-label-2">
                            <p class="text-left">{{ substr($row->posts_code, 4) }}</p>
                        </div>
                    </div>

                    <div class="form-group margin-bottom">
                        <label for="background" class="control-label col-md-2 text-left">Visual영역 이미지</label>
                        <div class="col-md-10 control-label">
                            @if($row->background)
                                <a href="javascript:void(0);" class="img-click" data-img="{{ $row->background }}">
                                    <img src="{{ $row->background }}" alt="visual영역 이미지" class="thumbnail" style="max-width: 400px;">
                                </a>
                            @else
                                <h4 class="text-danger text-center">Visual영역 이미지가 없습니다.</h4>
                            @endif
                        </div>
                    </div>

                    <div class="form-group margin-bottom">
                        <label for="img" class="control-label col-md-2 text-left">포스트 이미지</label>
                        <div class="col-md-4 control-label">
                            <a href="#" class="img-click" data-img="{{ $row->img }}"><img class="thumbnail" src="{{ $row->img }}" style="max-width: 60px;"></a>
                        </div>

                        <label for="is_open" class="control-label-2 col-md-2 text-left">오픈여부</label>
                        <div class="col-md-4 control-label-2">
                            {{ $row->is_open }}
                        </div>
                    </div>

                    <div class="form-group margin-bottom">
                        <label for="created_at" class="control-label col-md-2">등록일</label>
                        <div class="col-md-4 control-label text-left"><p class="text-left">{{ $row->created_at }}</p></div>
                        <label for="created_at" class="control-label-2 col-md-2">수정일</label>
                        <div class="col-md-4 control-label-2"><p class="text-left">{{ $row->updated_at }}</p></div>
                    </div>

                    @if($row->openGraph->id)

                        {{-- SEO 처리 --}}

                        <div class="col-md-12">
                            <div class="panel panel-warning">
                                <div class="panel-heading clearfix">
                                    <h4 class="panel-title panel-title-icon pull-left" style="padding-top: 7.5px;">검색엔진 메타 정보</h4>
                                    <div class="btn-group pull-right"><a href="#" class="btn btn-primary btn-xs" id="og-close" data-toggle="arcodion" data-target="#seo">close</a> </div>
                                </div>
                                <div class="panel-body" id="seo">

                                    <div class="row margin-bottom">

                                        <div class="form-group">
                                            <label class="control-label col-md-1"><span class="badge badge-primary"><i class="fa fa-star"></i> </span> 제목<p><span class="badge badge-info">og:title</span></p></label>
                                            <div class="col-md-10">
                                                <input name="og_title" id="og_title" class="form-control" value="{{ $row->openGraph->title }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="description" class="control-label col-md-1"><span class="badge badge-primary"><i class="fa fa-star"></i></span> 설명<p><span class="badge badge-info">og:description</span></p></label>
                                            <div class="col-md-5"><textarea name="description" class="form-control" style="max-width: 95%;" readonly>{{ $row->openGraph->description }}</textarea></div>
                                            <label for="keywords" class="control-label-2 col-md-1"><span class="badge badge-primary"><i class="fa fa-star"></i></span> 키워드<p><span class="badge badge-info">og:keywords</span></p></label>
                                            <div class="col-md-5"><textarea name="keyword" class="form-control" style="max-width: 95%;" readonly>{{ $row->openGraph->keywords }}</textarea></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="author" class="control-label col-md-1">작성자<p><span class="badge badge-info">og:author</span></p> </label>
                                            <div class="col-md-5">
                                                <input name="author" class="form-control" value="{{ $row->openGraph->ogArticle->author }}" readonly>
                                            </div>
                                            <label for="section" class="control-label-2 col-md-1">섹션<p><span class="badge badge-info">og:section</span></p></label>
                                            <div class="col-md-5">
                                                <input type="text" name="section" class="form-control" value="{{ $row->openGraph->ogArticle->section }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="tag" class="control-label col-md-1">태그<p><span class="badge badge-info">og:tag</span></p></label>
                                            <div class="col-md-10">
                                                <input type="text" name="tag" class="form-control" value="{{ $row->openGraph->ogArticle->tag }}" readonly>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                    @else

                        <div class="form-group margin-bottom">
                            <div class="col-md-12">
                                <h3 class="text-warning text-center">검색엔진 최적화 메타태그가 없습니다.</h3>
                                <p class="text-center"><a href="{{ route('post.edit', ['id' => $row->id]) }}" class="btn btn-danger">포스트 수정</a></p>
                            </div>
                       </div>

                    @endif

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="panel panel-primary" style="min-height: 650px;">
                                <div class="panel-heading">포스트 내용</div>
                                <div class="panel-body">
                                    <div>{!! $row->body !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-7 col-md-offset-3">
                            <a href="{{ route('post.index') }}" class="btn btn-default"><i class="fa fa-reply"></i> 목록</a>
                            @if(Auth::user()->id == $row->users_id || \App\Helpers\UserHelper::get_role_info()['role_id'] == 2)
                                <a href="{{ route('post.edit', ['id' => $row->id]) }}" class="btn btn-success" data-loading-text="포스트 수정" type="submit">포스트 수정</a>
                            @endif

                        </div>
                        <div class="col-md-2">
                            <p class="text-right">
                                <button type="button" id="del-btn" class="btn btn-danger">삭제</button>
                            </p>
                        </div>
                    </div>
                </fieldset>
                </form>
            </div>
        </div>

    </div>
    {{-- 이미지 모달 --}}
    <div class="modal fade bs-example-modal-lg in movie-info" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog modal-lg form-group">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">포스트 목록 이미지</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center"><img src="" id="imagepreview"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(['method' => 'DELETE', 'route' => ['post.destroy', $row->id], 'class' => 'form-horizontal', 'id' => 'del-frm']) !!}{!! FORM::close() !!}
@endsection



@section( 'footer-script' )
    <script src="{{ env('APP_URL') }}/assets/vendor/h5p/h5p-core/js/h5p-resizer.js" charset="UTF-8"></script>

    <script type="text/javascript">
        $(function () {
            $(".img-click").on("click", function () {

                $('#imagepreview').attr('src', $(this).data('img')).css({'max-width': '680px'}); // here asign the image to the modal when the user click the enlarge link
//                $('#imagemodal').modal('show');
                $('#imagemodal').modal({
                    'display': 'show',
                    'width': '1000px'
                });

            });

            $("#del-btn").on("click", function () {
                if(confirm("포스트를 삭제 하시겠습니까?")){
                    $("#del-frm").submit();
                }
            })

        });
    </script>
@endsection