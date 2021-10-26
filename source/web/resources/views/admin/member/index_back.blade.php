@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.member') }}
@endsection

@section( 'content' )
    <div class="container-fluid">

        <div class="row margin-bottom">
            <div class="row margin-bottom">
                <div class="col-md-offset-8 col-md-4">
                    {!! Form::open(['method' => 'GET', 'route' => ['post.index'], 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off']) !!}
                    <input type="hidden" name="page" value="{{ Request::get('page') }}">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-search"></i> </span>
                                    <input type="text" class="form-control" name="stext" value="{{ Request::get('stext') }}" placeholder="콘텐츠 검색">

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
                    {{--<colgroup>--}}
                        {{--<col width="10%">--}}
                        {{--<col width="10%">--}}
                        {{--<col width="*">--}}
                        {{--<col width="10%">--}}
                        {{--<col width="10%">--}}
                        {{--<col width="10%">--}}
                    {{--</colgroup>--}}
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">아바타</th>
                        <th class="text-center">성명</th>
                        <th class="text-center">email</th>
                        <th class="text-center">구분</th>
                        <th class="text-center">등록일</th>
                        <th class="text-center">수정일</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($rows->total() > 0)
                        @foreach($rows as $key => $row)
                            <tr>
                                <td class="text-center td-middle">{{ $start_num - $key }}</td>
                                <td class="text-center">
                                    @if($row->avatar)
                                        <a href="{{ route('member.edit', $row->id) }}"><img src="{{ $row->avatar}}" class="img-thumbnail" style="max-height: 60px;"></a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center td-middle"><a href="{{ route('member.edit', $row->id) }}">{{ $row->name }}</a></td>
                                <td class="text-center td-middle"><a href="{{ route('member.edit', $row->id) }}">{{ $row->email }}</a></td>
                                <td class="text-center td-middle">
                                    {{ ($row->role_user['role_id'] == 1)? '에디터': '관리자' }}
                                    {{--@if($row->role_user->first()->role_id == 1)--}}
                                        {{--<p><a href="{{ ($row->html_cnt > 0)? route('site.index', ['editor' => $row->id]): 'javascript:void();' }}" class="btn btn-info btn-xs">HTML관리개수: {{ $row->html_cnt }}</a>--}}
                                        {{--<a href="{{ ($row->visual_cnt > 0)? route('visual.index', ['editor' => $row->id]): 'javascript:void()' }}" class="btn btn-success btn-xs">상단관리개수: {{ $row->visual_cnt }}</a></p>--}}
                                    {{--@endif--}}
                                </td>
                                <td class="text-center td-middle">{{ $row->created_at->format('Y-m-d') }}</td>
                                <td class="text-center td-middle">{{ $row->updated_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <p class="text-center">등록된 사용자가 없습니다.</p>
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
            <div class="col-md-3"><p class="text-center"><a href="{{ url('/member/create') }}" class="btn btn-primary">사용자 등록</a> </p> </div>
        </div>

    </div>

@endsection



@section( 'footer-script' )
    <script type="text/javascript">

    </script>
@endsection