<script type="text/javascript">
    @if ($message = session('success'))
        $.toast({
            text: '{{ $message }}',
            position: 'top-center',
            icon: 'success',
        });
    @endif
    @if ($message = session('error'))
        $.toast({
            text: '{{ $message }}',
            position: 'top-center',
            icon: 'error',
            hideAfter: 7000
        });
    @endif
    @if ($message = session('warning'))
        $.toast({
            text: '{{ $message }}',
            position: 'top-center',
            icon: 'warning',
        });
    @endif
    @if ($message = session('info'))
        $.toast({
            text: '{{ $message }}',
            position: 'top-center',
            icon: 'info',
        });
    @endif
</script>
