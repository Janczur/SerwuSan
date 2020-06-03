// init filestyle https://markusslima.github.io/bootstrap-filestyle/
$(":file").filestyle({
    buttonBefore: true,
    badge: true,
    btnClass: "btn-primary",
    placeholder: "Upuść plik tutaj lub wybierz",
    text: "Wybierz plik"
});

// init tolltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});
