{{-- LAYOUT --}}
@extends( 'admin.layouts.admin-base' )

@section( 'body-title', config("app.name") )

@section('body-class') layout-wide  @endsection

@section( 'content-header' )
    {{-- 플래쉬 메세지 관련 css 수정 필요 --}}
    {{--@include('alert-message')--}}
    {{-- 헤더 메뉴 --}}
    @includeIf( 'admin.partials.header' )

@endsection

@section( 'content-body' )

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div data-alerts="alerts" data-titles='{"warning": "<em>Warning!</em>", "error": "<em>Error!</em>"}' data-ids="myid" data-fade="3000"></div>


    <div id="body" class="margin-vertical">
        @yield( 'content' )
    </div>

    {{-- 본문의 사이드 --}}
    @includeIf( 'admin.partials.left' )
{{--    @includeIf( 'admin.partials.right' )--}}



@endsection


@section( 'content-header-script' )
    @stack('header-script')
@endsection


@section( 'content-footer' )
    @stack( 'footer-script' )
    {{-- 푸터 카피라이트 --}}
    @includeIf( 'admin.partials.footer' )
@endsection

@section( 'content-footer-script' )
    <script type="text/javascript">
        $(function () {
            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        });
    </script>
@endsection
