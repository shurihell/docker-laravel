{{-- LAYOUT --}}
@extends( 'admin.layouts.admin-base' )

@section( 'body-title', config("app.name") )

@section('body-class') layout-wide  @endsection

@section( 'content-header' )
    @include('flash-message')
    {{-- 헤더 메뉴 --}}
    @includeIf( 'admin.partials.header' )
@endsection

@section( 'content-body' )

    @hasSection('breadcrumbs')
        @yield( 'breadcrumbs' )
    @endif

    <div data-alerts="alerts" data-titles='{"warning": "<em>Warning!</em>", "error": "<em>Error!</em>"}' data-ids="myid" data-fade="3000"></div>

    <div id="body" class="margin-vertical">
        @yield( 'content' )
        @yield( 'h5p' )
    </div>

    {{-- 본문의 사이드 --}}
    @includeIf( 'admin.partials.left' )
    @includeIf( 'admin.partials.right' )



@endsection


@section( 'content-header-script' )
    @stack('header-script')

    @stack('h5p-header-script')

@endsection


@section( 'content-footer' )
    @stack( 'footer-script' )
    {{-- 푸터 카피라이트 --}}
    @includeIf( 'admin.partials.footer' )
@endsection

@section( 'content-footer-script' )
    @stack('h5p-footer-script')

    {{-- tracking script --}}
    @if( config('app.analytics'))
        <script type="text/javascript" >
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                a = s.createElement(o), m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
            ga('create', "{{ config('app.analytics') }}", 'auto');
            ga('send', 'pageview');
        </script>
    @endif

    <script type="text/javascript">
        $(function () {
            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        });
    </script>
@endsection
