@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.visual') }}
@endsection

@section( 'content' )
    <div class="container-fluid">

        <div class="row margin-bottom">
            <div class="row margin-bottom">
                <div class="col-md-offset-8 col-md-4">
                    {!! Form::open(['method' => 'GET', 'route' => ['visual.index'], 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off']) !!}
                    <input type="hidden" name="page" value="{{ Request::get('page') }}">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-search"></i> </span>
                                    <input type="text" class="form-control" name="stext" value="{{ Request::get('stext') }}" placeholder="검색">

                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">검색</button>
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="row margin-bottom">
            <div class="col-md-12">
                <table class="table table-hover table-bordered">
                    {{--<clogroup>--}}
                        {{--<col width="5%">--}}
                        {{--<col width="*">--}}
                        {{--<col width="8%">--}}
                        {{--<col width="8%">--}}
                        {{--<col width="8%">--}}
                        {{--<col width="7%">--}}
                        {{--<col width="7%">--}}
                        {{--<col width="7%">--}}
                        {{--<col width="7%">--}}
                    {{--</clogroup>--}}
                    <thread>
                        <tr>
                            <th class="text-center">#</th>
                            <th>상단 텍스트</th>
                            <th class="text-center">상단이미지</th>
                            <th class="text-center">백그라운드이미지</th>
                            <th class="text-center">위치</th>
                            <th class="text-center">사용여부</th>
                            <th class="text-center">HTML사용</th>
                            <th class="text-center">에디터</th>
                            <th class="text-center">등록일</th>
                            <th class="text-center">수정일</th>
                        </tr>
                    </thread>
                    <tbody>
                    @if($rows->total() > 0)
                        @foreach($rows as $key => $row)
                            <tr data-link="{{ route('visual.edit', ['id' => $row->id]) }}" style="cursor: pointer;" class="link">
                                <td class="text-center td-middle">{{ $start_num - $key }}</td>
                                <td class="td-middle">
                                    {{ $row->title or 'HTML'}}
                                </td>
                                <td class="text-center td-middle"><img class="img-thumbnail" style="max-height: 60px;" src="{{ $row->image }}"></td>
                                <td class="text-center td-middle">
                                    @if($row->background)
                                        <img class="img-thumbnail" style="max-height: 60px;" src="{{ $row->background }}">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center td-middle">{{ \App\Helpers\Helper::getSitePositionName($row->position) }}</td>{{-- 위치 처리  --}}
                                <td class="text-center td-middle">{{ $row->is_open }}</td>
                                <td class="text-center td-middle">{{ $row->is_html }}</td>
                                <td class="text-center td-middle">{{ $row->users_name }}</td>
                                <td class="text-center td-middle">{{ $row->created_at->format('Y-m-d') }}</td>
                                <td class="text-center td-middle">{{ $row->updated_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">
                                <h4 class="text-center">등록된 비주얼영역코드가 없습니다.</h4>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row margin-bottom">
            <div class="col-md-9">
                <p class="text-center">{!! $rows->render() !!}</p>
            </div>
            <div class="col-md-3"><p class="text-center"><a href="{{ url('/visual/create') }}" class="btn btn-primary">Visual 등록</a> </p> </div>
        </div>

    </div>
@endsection



@section( 'footer-script' )
    <script type="text/javascript">
        $(function () {
            $(".link").on("click", function () {
                location.href = $(this).data("link");
            })
        })
    </script>
@endsection