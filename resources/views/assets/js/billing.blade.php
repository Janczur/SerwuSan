<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".calculate-settlement").click(function(e){
        e.preventDefault();

        let $this = $(this);
        let parent = $(this).parent();
        let loadingText = '<span class="icon text-white-50">' +
            '   <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' +
            '</span>' +
            '<span class="text">Przeliczam...</span>';
        let billing_id = $(this).data('billing_id');

        $this.html(loadingText);

        $.ajax({
            type:'POST',
            url:'{{ route('billings.calculate.settlement') }}',
            data:{billing_id:billing_id},
            success:function(data){
                $this.removeClass('btn-primary').addClass('btn-success');
                $this.html('<span class="text">' + data.settlement +'</span>' +
                    '<span class="icon text-white-50">zł</span>');
            }
        });
    });
</script>
