@extends( 'admin.layouts.default' )

@section('breadcrumbs')
    {{ Breadcrumbs::render('admin') }}
@endsection

@section( 'content' )
    <div class="container-fluid">

{{--        <iframe src="http://locker.bubblecon.io/dashboards/5e1fb234d5d79570e8f8732f/5e2023a9ec82167c9ffd86bd/Shareable" width="100%" height="1150" style="border: 0px;"></iframe>--}}
        <iframe src="http://locker.bubblecon.io/dashboards/5e3d929415e7ae56ae4aec68/5e40b88115e7ae56ae4aec93/Shareable" width="100%" height="1400" style="border: 0px;"></iframe>

    </div>
@endsection



@section( 'footer-script' )
    <script type="text/javascript">
        $(function () {

        });
    </script>
@endsection
