@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin') }}
@endsection

@section( 'content' )
    <div class="container-fluid">

        <div class="row margin-bottom">
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title panel-title-icon pull-left" style="padding-top: 7.5px;">동영상 컨텐츠 목록</h4>
                        <div class="btn-group pull-right"><a href="{{ route('mov-content.index') }}" class="btn btn-default btn-xs">more</a> </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-info">
                            <colgroup>
                                <col width="10%">
                                <col width="*">
                                <col width="15%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th class="activate text-center">#</th>
                                <th class="text-center">제목</th>
                                <th class="activate text-center">등록자</th>
                                <th class="activate text-center">등록일</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($mov_rows) > 0)
                                @foreach($mov_rows as $key => $row)
                                <tr>
                                    <td class="text-center td-middle">{{ $mov_rows_num - $key }}</td>
                                    <td class="text-center td-middle"><a href="{{ route('mov-content.edit', $row->id) }}">{{ $row->subject }}</a></td>
                                    <td class="text-center td-middle">{{ $row->user->nickname }}</td>
                                    <td class="text-center">{{ $row->created_at->format('Y-m-d') }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="5">
                                        <h4 class="text-center">컨텐츠 정보가 없습니다.</h4>
                                    </th>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel panel-success">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title panel-title-icon pull-left" style="padding-top: 7.5px;">파일 컨텐츠 목록</h4>
                        <div class="btn-group pull-right"><a href="{{ route('file-content.index') }}" class="btn btn-default btn-xs">more</a> </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <colgroup>
                                <col width="10%">
                                <col width="*">
                                <col width="15%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th class="activate text-center">#</th>
                                <th class="text-center">제목</th>
                                <th class="activate text-center">등록자</th>
                                <th class="activate text-center">등록일</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($file_rows) > 0)
                                @foreach($file_rows as $key => $row)
                                    <tr>
                                        <td class="text-center td-middle">{{ $file_rows_num - $key }}</td>
                                        <td class="text-center"><a href="{{ route('file-content.edit', $row->id) }}">{{ $row->subject }}</a></td>
                                        <td class="text-center td-middle">{{ $row->user->nickname }}</td>
                                        <td class="text-center">{{ $row->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="5">
                                        <h4 class="text-center">컨텐츠 정보가 없습니다.</h4>
                                    </th>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row margin-bottom">

            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title panel-title-icon pull-left" style="padding-top: 7.5px;">버블콘 컨텐츠 목록</h4>
                        <div class="btn-group pull-right"><a href="{{ route('pomelo.index') }}" class="btn btn-default btn-xs">more</a> </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <colgroup>
                                <col width="10%">
                                <col width="15%">
                                <col width="*">
                                <col width="15%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">라이브러리</th>
                                <th class="text-center">제목</th>
                                <th class="text-center">등록자</th>
                                <th class="text-center">작성일</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($bubble_rows) > 0)
                                @foreach($bubble_rows as $key => $row)
                                    <tr>
                                        <td class="text-center td-middle">{{ $bubble_rows_num - $key }}</td>
                                        <td class="text-center">{{ $row->get_library->title }}</td>
                                        <td class="text-center"><a href="{{ route('pomelo.edit', $row->id) }}">{{ $row->title }}</a></td>
                                        <td class="text-center td-middle">{{ $row->user->nickname }}</td>
                                        <td class="text-center td-middle">{{ $row->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="5">
                                        <h4 class="text-center">컨텐츠 정보가 없습니다.</h4>
                                    </th>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title panel-title-icon pull-left" style="padding-top: 7.5px;">문제 라이브러리 컨텐츠 목록</h4>
                        <div class="btn-group pull-right"><a href="{{ route('question-bank.index') }}" class="btn btn-default btn-xs">more</a> </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <colgroup>
                                <col width="10%">
                                <col width="15%">
                                <col width="*">
                                <col width="15%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">라이브러리</th>
                                <th class="text-center">제목</th>
                                <th class="text-center">등록자</th>
                                <th class="text-center">작성일</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($bank_rows) > 0)
                                @foreach($bank_rows as $key => $row)
                                    <tr>
                                        <td class="text-center td-middle">{{ $bank_rows_num - $key }}</td>
                                        <td class="text-center">{{ $row->get_library->title }}</td>
                                        <td class="text-center"><a href="{{ route('pomelo.edit', $row->id) }}">{{ $row->title }}</a></td>
                                        <td class="text-center td-middle">{{ $row->user->nickname }}</td>
                                        <td class="text-center td-middle">{{ $row->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="5">
                                        <h4 class="text-center">컨텐츠 정보가 없습니다.</h4>
                                    </th>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection



@section( 'footer-script' )
    <script type="text/javascript">
        $(function () {

        });
    </script>
@endsection