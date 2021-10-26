<footer id="footer" class=''>

    <div class="container-fluid">

        <small class="text-muted text-light">POSCO Contents Hub POC</small>
        <div class="copyrights">COPYRIGHTS ©2019 POSCO. All Rights Reserved.</div>
{{--        <div class="copyrights">본 저작도구 POC는 포스코 인재창조원 테스트 버전입니다.</div>--}}
    </div>
</footer>
<script type="text/javascript">

    //@.btn 은 모든 버튼 클래스를 대상함으로 지정클래스로 변경할 필요가 있습니다
    var clipboard = new Clipboard('.btn-copy');

    clipboard.on('success', function(e) {
        e.clearSelection();
        alert('복사되었습니다.');
    });

    clipboard.on('error', function(e) {
        alert('복사에 실패하였습니다.');
    });

    //dropdown 메뉴
    @if (Request::is('board*'))
        $("#board-mgnt").addClass('open');
    @elseif (Request::is('h5p*'))
        $("#pomelo-mgnt").addClass('open');
    @elseif (Request::is('mme*'))
        $("#mme-mgnt").addClass('open');
    @endif



    $(".dropdown-toggle").on("click", function (event) {
        $(this).dropdown('toggle');
    });
</script>
