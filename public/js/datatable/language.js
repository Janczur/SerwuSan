// set default DataTables launguage to Polish
$.extend(true, $.fn.dataTable.defaults, {
    language: {
        "processing":     "Przetwarzanie...",
        "search":         "Szukaj:",
        "lengthMenu":     "Pokaż _MENU_ pozycji",
        "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
        "infoEmpty":      "Pozycji 0 z 0 dostępnych",
        "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
        "infoPostFix":    "",
        "loadingRecords": "Wczytywanie...",
        "zeroRecords":    "Nie znaleziono pasujących pozycji",
        "emptyTable":     "Brak danych",
        "paginate": {
            "first":      "Pierwsza",
            "previous":   "Poprzednia",
            "next":       "Następna",
            "last":       "Ostatnia"
        },
        "aria": {
            "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
            "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
        },
        buttons: {
            copyTitle: 'Skopiowano do schowka',
            copySuccess: {
                _: 'Skopiowano %d wierszy do schowka',
                1: 'Skopiowano wiersz do schowka',
            }
        },
        select: {
            rows: {
                _: "Wybrano %d wierszy",
                0: "Kliknij na checkbox aby wybrać wiersz",
                1: "Wybrano tylko jeden wiersz"
            }
        }
    }
} );
