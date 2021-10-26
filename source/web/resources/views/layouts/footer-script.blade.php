<script>
    $(document).ready(function () {
        @if($message = \Illuminate\Support\Facades\Session::get('alert-message'))
        var msg_status = "{{ Session::get('alert-message') }}";
        alert(msg_status);
        @endif
    });
</script>
