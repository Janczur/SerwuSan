<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to describe application actions
    |
    */

    'general' => [
        'error' => 'Coś poszło nie tak. Spróbuj ponownie później lub skontaktuj się z administratorem.'
    ],

    'billing' => [
        'added' => 'Poprawnie dodano billing do bazy',
        'deleted' => 'Popranie usunięto billing z bazy',
        'edited' => 'Edycja wybranego billingu przebiegła pomyślnie',
        'queued' => 'Import bilingu został dodany do kolejki. Proces powinien potrawać od kilku do kilkunastu sekund'
    ],

    'billingData' => [
        'added' => 'Poprawnie zapisano dane bilingu do bazy',
        'imported' => 'Dane bilingu zostały przetworzone i przygotowane do zapisu popranie',
        'error' => 'Przy próbie zapisu danych do bilingu wystąpił błąd',
    ],

    'import' => [
        'readerError' => 'W trakcie otwierania pliku wystąpił błąd. Spróbuj ponownie lub wybierz inny plik',
        'spreadsheetError' => 'Nie można odczytać danych z pliku. Spróbuj ponownie lub wybierz inny plik',
        'error' => 'W trakcie importowania pliku coś poszło nie tak. Spróbuj ponownie lub skontaktuj się z administratorem'
    ]

];
