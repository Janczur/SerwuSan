@extends('layouts.app')
@section('title', 'Marże dostawców')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Marże dostawców</h6>
                            <div class="ml-auto">
                                <a href="{{ route('providersMargins.import') }}"
                                   class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                        class="fas fa-file-import fa-sm text-white-50"></i> Prześlij plik</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="providers-margins-table">
                            <thead>
                            <tr>
                                <th scope="col" class="dont-copy-dataTables text-center" style="width: 4%;">#</th>
                                <th scope="col" class="dont-copy-dataTables" hidden>id</th>
                                <th scope="col" style="width: 48%;">Kraj</th>
                                <th scope="col" style="width: 48%;">Marża</th>
                            </tr>
                            </thead>
                            <tbody>
                            @each('providers.margins.tbody._index', $providersMargins, 'providerMargin')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/b-html5-1.6.2/sl-1.3.1/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-editable.css') }}">
@endpush
@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/b-html5-1.6.2/sl-1.3.1/datatables.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/datatable/language.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-editable.min.js') }}"></script>
@endpush
@section('js')
    <script type="text/javascript">
        let providersTable = $('#providers-margins-table').DataTable({
            dom: 'Blfrtip',
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, 'Wszystkie']],
            order: [[1, 'asc']],
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-primary btn-sm',
                    enabled: false,
                    text: '<i class="far fa-clipboard"></i> Kopiuj zaznaczone',
                    exportOptions: {
                        columns: ':not(.dont-copy-dataTables)',
                        rows: {selected: true}
                    }
                },
                {
                    text: '<i class="fas fa-trash-alt"></i> Usuń zaznaczone',
                    className: 'btn-danger btn-sm',
                    enabled: false,
                    action: function () {
                        if (!confirm('{{ __('app.general.batch.deleteConfirm') }}')) {
                            return;
                        }
                        let providerMarginIds = [];
                        providersTable.rows({selected: true}).data().each(function (value) {
                            providerMarginIds.push(value[1]);
                        });
                        $.ajax({
                            url: '{{ route('providersMargins.batch.delete') }}',
                            type: "DELETE",
                            async: true,
                            data: {
                                "providerMarginIds": providerMarginIds,
                            },
                            success: function (data) {
                                $.toast({
                                    heading: data.heading,
                                    text: data.message,
                                    position: 'top-center',
                                    icon: data.status,
                                });
                                providersTable.rows({selected: true}).remove().draw();
                            },
                            error: function () {
                                $.toast({
                                    heading: 'Błąd',
                                    text: '{{ __('app.general.error') }}',
                                    position: 'top-center',
                                    icon: 'error',
                                });
                            }
                        });
                    }
                },
                {
                    extend: 'selectAll',
                    className: 'btn-sm',
                    text: '<i class="fa fa-check-square"></i> Zaznacz'
                },
                {
                    extend: 'selectNone',
                    className: 'btn-sm',
                    text: '<i class="fa fa-square-o"></i> Odznacz'
                }
            ],
            fnRowCallback: function () {
                applyXeditable();
            }
        });
        providersTable.on( 'select deselect', function () {
            let selectedRows = providersTable.rows( { selected: true } ).count();

            providersTable.button( 0 ).enable( selectedRows > 0 );
            providersTable.button( 1 ).enable( selectedRows > 0 );
        });

        applyXeditable();

        function applyXeditable(){
            $('.apply-xeditable').editable({
                mode: 'inline',
                type: 'text',
                ajaxOptions: {
                    type: "PUT"
                },
                error: function (response) {
                    let json = $.parseJSON(response.responseText);
                    let errors = [];
                    $.each(json.errors, function(key, value){
                        errors.push(value);
                    });
                    $.toast({
                        text: errors,
                        position: 'top-center',
                        icon: 'error',
                    });
                }
            });
        }
    </script>
@endsection
