@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.post') }}
@endsection

@section( 'content' )
    <div class="container-fluid">

        <div class="row" style="margin-bottom: 10px;">

            <div class="col-md-9">

                {!! Form::open(['route'=>"post.index", 'class'=>'form-inline', 'method'=>'GET']) !!}
                <fieldset>
                    <p class="form-control-static">
                        {{ trans('laravel-h5p.content.search-result', ['count' => number_format($rows->total())]) }}
                    </p>
                    {!! Form::select('category_id', $category_list, $request->get('category_id'), ['class'=>'form-control', 'placeholder' => '전체']) !!}
                    {!! Form::select('keyword_id', $keyword_list, [ $request->get('keyword_id') ], ['class'=>'form-control', 'placeholder' => '전체']) !!}
                    <input type="text" class="form-control" placeholder="{{ trans('laravel-h5p.content.keyword') }}"
                           name='s' value='{{ $request->get('s') }}'>
                    <button type="submit" class="btn btn-primary"><i
                                class="fa fa-search"></i> 검색</button>
                </fieldset>

                {!! Form::close() !!}

            </div>

            <div class="col-md-3">
                <a href="{{ route("post.create") }}"
                   class="btn btn-primary pull-right">신규</a>
            </div>
        </div>

        <div class="row margin-bottom">
            <div class="col-md-12">

                <table class="table text-middle text-center">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="*">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                    <tr class="active">
                        <th class="text-center">No.</th>
                        <th class="text-center">썸네일</th>
                        <th class="text-center">제목</th>
                        <th class="text-center">카테고리</th>
                        <th class="text-center">토픽 키워드</th>
                        <th class="text-center">생성일</th>
                        <th class="text-center">{{ trans('laravel-h5p.content.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($rows->total() > 0)
                        @foreach($rows as $key => $row)
                            <tr>
                                <td class="text-center td-middle">{{ $start_num - $key }}</td>
                                <td><a href="{{route("post.edit", ["id" => $row->id])}}"><img id="thumb-{{$row->id}}" src="{{ $row->thumb_url }}" style="width:100px;"></a></td>
                                <td class="text-center td-middle"><a href="{{ route('post.edit', $row->id) }}">{{ $row->title }}</a></td>
                                <td class="text-center td-middle">{{ $row->category->title }}</td>
                                <td class="text-center td-middle">{{ $row->keyword->title }}</td>
                                <td class="text-center td-middle">{{ $row->updated_at->format('Y-m-d') }}</td>
                                <td class="text-center td-middle">
                                    <a class="btn btn-default" href="{{ route('post.edit', ["id" => $row->id]) }}">수정</a>
                                    <a class="btn btn-primary" href="{{ env('APP_URL').'/content/'.$row->id }}">콘텐츠 바로보기</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">
                                <p class="text-center">등록된 공지사항이 없습니다.</p>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="text-center">
                {{--{!! $rows->appends(\Illuminate\Support\Facades\Input::except('page'))->render() !!}--}}
                {!! $rows->appends(['s' => $request->get('s'), 'category_id' => $request->get('category_id'), 'keyword_id' => $request->get('keyword_id')])->render() !!}
            </div>
        </div>

    </div>
@endsection



@section( 'footer-script' )
    <script type="text/javascript">
        $(function () {

        })
    </script>
@endsection
