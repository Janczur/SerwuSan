@extends('layouts.app')
@section('title', $providersPricelist->name)
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $providersPricelist->name }} <span
                                    class="text-muted">(Modyfikacje
                                    danych w tej tabeli nie są zapisywane do bazy. Odświeżenie strony spowoduje
                                    przywrócenie stanu początkowego)</span></h6>
                            <div class="ml-auto">
                                <a href="{{ route('providersMargins.import') }}"
                                   class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                        class="fas fa-file-import fa-sm text-white-50"></i> Prześlij plik</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="providers-pricelist-table">
                            <thead>
                            <tr>
                                <th scope="col" class="dont-copy-dataTables hide-colvis-dataTables dont-export-dataTables text-center"
                                    style="width: 4%;">#
                                </th>
                                <th scope="col" class="dont-copy-dataTables hide-colvis-dataTables dont-export-dataTables" hidden>id</th>
                                <th scope="col">Country</th>
                                <th scope="col" class="hide-column">Description</th>
                                <th scope="col" class="hide-column">Operator</th>
                                <th scope="col" class="hide-column">Type</th>
                                <th scope="col" class="hide-column">Prefix</th>
                                <th scope="col">T1</th>
                                <th scope="col">T2</th>
                                <th scope="col">T3</th>
                                <th scope="col" class="hide-column">Period1</th>
                                <th scope="col" class="hide-column">Period2</th>
                                <th scope="col" class="hide-column">Init charge</th>
                                <th scope="col" class="hide-column">Price for time</th>
                                <th scope="col" class="hide-column">Currency</th>
                            </tr>
                            </thead>
                            <tbody>
                            @each('providers.pricelist.tbody._show', $providersPricelist->providersPricelistData, 'providersPricelistData')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/b-html5-1.6.2/sl-1.3.1/datatables.min.css"/>
@endpush
@push('scripts')
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/dt-1.10.21/b-1.6.2/b-colvis-1.6.2/b-html5-1.6.2/sl-1.3.1/datatables.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/datatable/language.js') }}"></script>
@endpush
@section('js')
    <script type="text/javascript">
        let providersTable = $('#providers-pricelist-table').DataTable({
            dom: 'Blfrtip',
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, 'Wszystkie']],
            order: [[1, 'asc']],
            columnDefs: [
                {
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                },
                {
                    visible: false,
                    targets: 'hide-column'
                }
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            buttons: [
                {
                    extend: 'colvis',
                    className: 'btn-sm',
                    text: '<i class="fas fa-columns"></i> Kolumny',
                    columns: ':not(.hide-colvis-dataTables)'
                },
                {
                    extend: 'copy',
                    className: 'btn-primary btn-sm',
                    enabled: false,
                    text: '<i class="far fa-clipboard"></i> Kopiuj zaznaczone',
                    exportOptions: {
                        columns: ':visible:not(.dont-copy-dataTables)',
                        rows: {selected: true}
                    }
                },
                {
                    text: '<i class="fas fa-trash-alt"></i> Usuń zaznaczone',
                    className: 'btn-danger btn-sm',
                    enabled: false,
                    action: function () {
                        providersTable.rows({selected: true}).remove().draw();
                    }
                },
                {
                    text: '<i class="fas fa-calculator"></i> Oblicz cenę za połączenie',
                    className: 'btn-success btn-sm',
                    enabled: false,
                    action: function () {
                        let countryCallPrices = {};
                        providersTable.rows({selected: true}).data().each(function (value) {
                            let cleanCountry = value[2].replace(/(<([^>]+)>)/ig,"").replace('&amp;','&');
                            countryCallPrices[cleanCountry] = [
                                value[7].replace(/(<([^>]+)>)/ig,""),
                                value[8].replace(/(<([^>]+)>)/ig,""),
                                value[9].replace(/(<([^>]+)>)/ig,"")
                            ]
                        });
                        $.ajax({
                            url: '{{ route('providersPriceLists.calculateCallPrice') }}',
                            type: "POST",
                            contentType: "application/json",
                            async: true,
                            data: JSON.stringify(countryCallPrices),
                            success: function (data) {
                                $.toast({
                                    heading: data.heading,
                                    text: data.message,
                                    position: 'top-center',
                                    icon: data.status,
                                });
                                providersTable
                                    .rows({selected: true})
                                    .every(function (rowIdx) {
                                        let country = providersTable.cell(rowIdx, 2).data();
                                        let cleanCountry = country.replace(/(<([^>]+)>)/ig,"").replace('&amp;','&');

                                        if(cleanCountry in data.calculatedCallPrices) {
                                            providersTable.cell(rowIdx, 7).data('<strong>'+data.calculatedCallPrices[cleanCountry][0]+'</strong>')
                                            providersTable.cell(rowIdx, 8).data('<strong>'+data.calculatedCallPrices[cleanCountry][1]+'</strong>')
                                            providersTable.cell(rowIdx, 9).data('<strong>'+data.calculatedCallPrices[cleanCountry][2]+'</strong>')
                                        }
                                    })
                                    .draw();
                            },
                            error: function () {
                                $.toast({
                                    heading: 'Błąd',
                                    text: '{{ __('app.general.error') }}',
                                    position: 'top-center',
                                    icon: 'error',
                                });
                            },
                        });
                    }
                },
                {
                    extend: 'selectAll',
                    className: 'btn-sm',
                    text: '<i class="far fa-check-square"></i> Zaznacz'
                },
                {
                    extend: 'selectNone',
                    className: 'btn-sm',
                    text: '<i class="far fa-square"></i> Odznacz'
                },
                {
                    extend: 'csv',
                    className: 'btn-sm btn-primary',
                    enabled: false,
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    exportOptions: {
                        columns: ':not(.dont-export-dataTables)',
                        rows: {selected: true}
                    }
                }
            ],
        });

        providersTable.on('select deselect', function () {
            let selectedRows = providersTable.rows({selected: true}).count();

            providersTable.button(1).enable(selectedRows > 0);
            providersTable.button(2).enable(selectedRows > 0);
            providersTable.button(3).enable(selectedRows > 0);
            providersTable.button(6).enable(selectedRows > 0);
        });


    </script>
@endsection
