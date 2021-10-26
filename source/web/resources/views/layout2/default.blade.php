{{-- LAYOUT --}}
@extends( 'layouts.admin-base' )

@section( 'body-title', config("app.name") )

@section('body-class') layout-wide  @endsection

@section( 'content-header' )
    {{-- 플래쉬 메세지 관련 css 수정 필요 --}}
    @include('flash-message')
    {{--@include('alert-message')--}}
    {{-- 헤더 메뉴 --}}
    @includeIf( 'admin.partials.header' )
    {!! Html::script('/assets/js/zplayer/zplayer.js') !!}
    {!! Html::script('/assets/js/zplayer/lang/ko.js') !!}
    {!! Html::style('/assets/css/zplayer.min.css') !!}
@endsection

@section( 'content-body' )
    @hasSection('breadcrumbs')
        @yield( 'breadcrumbs' )
    @endif
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div data-alerts="alerts" data-titles='{"warning": "<em>Warning!</em>", "error": "<em>Error!</em>"}' data-ids="myid" data-fade="3000"></div>

    {{--@include('flash::message')--}}
    <div id="body" class="margin-vertical">
        @yield( 'content' )
    </div>

    {{-- 본문의 사이드 --}}
    @includeIf( 'admin.partials.left' )
    @includeIf( 'admin.partials.right' )
@endsection


@section( 'content-header-script' )
    @stack('header-script')
@endsection


@section( 'content-footer' )
    @stack( 'footer-script' )
@endsection

@section( 'content-footer-script' )
@endsection
