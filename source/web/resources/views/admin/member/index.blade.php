@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin.member') }}
@endsection

@section( 'content' )
    <div class="container-fluid">

        <div class="row" style="margin-bottom: 10px;">
            <div class="col-md-9">
                {!! Form::open(['method' => 'GET', 'route' => ['member.index'], 'class' => 'form-inline', 'role' => 'form', 'autocomplete' => 'off']) !!}
                <fieldset>
                    <p class="form-control-static">
                        {{ trans('laravel-h5p.content.search-result', ['count' => number_format($rows->total())]) }}
                    </p>
                    {!! Form::select('sf', $search_fields, [$sf], ['class'=>'form-control']) !!}
                    <input type="text" class="form-control" placeholder="{{ trans('laravel-h5p.content.keyword') }}"
                           name='s' value='{{ $s }}'>
                    <button type="submit" class="btn btn-primary"><i
                                class="fa fa-search"></i> {{ trans('laravel-h5p.content.search') }}</button>
                </fieldset>
                {!! Form::close() !!}
            </div>
            <div class="col-md-3">
{{--                <a href="{{ route("member.create") }}" class="btn btn-primary pull-right">{{ trans('laravel-h5p.content.create') }}</a>--}}
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
                        <th class="text-center">성명</th>
                        <th class="text-center">email</th>
                        <th class="text-center">구분</th>
                        <th class="text-center">등록일</th>
                        <th class="text-center">수정일</th>
                        <th class="text-center">{{ trans('laravel-h5p.content.action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($rows->total() > 0)
                        @foreach($rows as $key => $row)
                            <tr>
                                <td class="text-center td-middle">{{ $start_num - $key }}</td>
{{--                                <td class="text-center td-middle"><a href="{{ route('member.edit', $row->id) }}">{{ $row->nickname }}</a></td>--}}
                                <td class="text-center td-middle"><a href="{{ route('member.edit', $row->id) }}">{{ $row->name }}</a></td>
                                <td class="text-center td-middle"><a href="{{ route('member.edit', $row->id) }}">{{ $row->email }}</a></td>
                                <td class="text-center td-middle">{{ sizeof($row->roles->pluck('name')) > 0 ? $row->roles->pluck('name')[0] : '-' }}</td>
                                <td class="text-center td-middle">{{ $row->created_at->format('Y-m-d') }}</td>
                                <td class="text-center td-middle">{{ $row->updated_at->format('Y-m-d') }}</td>
                                <td class="text-center td-middle">
                                    <a class="btn btn-default" href="{{ route('member.edit', ["id" => $row->id]) }}">수정</a>
{{--                                    <a class="btn btn-danger" href="#" id="del-btn" data-id="{{ $row->id }}">삭제</a>--}}
                                </td>
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
        <div class="row">
            <div class="text-center">
                {{--{!! $rows->appends(\Illuminate\Support\Facades\Input::except('page'))->render() !!}--}}
                {!! $rows->appends(['sf' => $sf, 's' => $s])->render() !!}
            </div>
        </div>
    </div>

{{--    {!! Form::open(['method' => 'DELETE', 'route' => ['member.destroy', $row->id], 'class' => 'form-horizontal', 'id' => 'del-frm']) !!}--}}
{{--    <input type="hidden" name="id" id="row-del">--}}
{{--    {!! FORM::close() !!}--}}
@endsection



@section( 'footer-script' )
    <script type="text/javascript">
        // $('#del-btn').click(function(){
        //     if(confirm('해당 유저를 삭제시겠습니까?')){
        //         alert('삭제되었습니다.');
        //     }
        // })
    </script>
@endsection
