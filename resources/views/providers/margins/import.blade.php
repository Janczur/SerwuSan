@inject('importStrategies', 'App\Imports\Strategies\ProviderMargin')
@extends('layouts.app')
@section('title', 'Aktualizuj cennik')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Prześlij plik z marżami dostawców</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('providersMargins.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control @error('import_file') is-invalid @enderror" name="import_file" aria-describedby="import_fileDescription">
                                @error('import_file')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="import_fileDescription" class="form-text text-muted">Dozwolone rozszerzenia plików: <strong>*.xlsx, *.csv</strong></small>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{ $importStrategies::FORM_NAME }}"
                                           id="{{ $importStrategies::ADD_NEW }}"
                                           value="{{ $importStrategies::ADD_NEW }}" checked>
                                    <label class="form-check-label" for="{{ $importStrategies::ADD_NEW }}">
                                        Dodaj nowe pozycje z pliku
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="{{ $importStrategies::FORM_NAME }}"
                                           id="{{ $importStrategies::ADD_NEW_AND_REPLACE_MARGIN }}"
                                           value="{{ $importStrategies::ADD_NEW_AND_REPLACE_MARGIN }}">
                                    <label class="form-check-label" for="{{ $importStrategies::ADD_NEW_AND_REPLACE_MARGIN }}">
                                        Dodaj nowe pozycje z pliku i zastąp marżę istniejących
                                    </label>
                                </div>
                                <div class="form-check disabled">
                                    <input class="form-check-input" type="radio" name="{{ $importStrategies::FORM_NAME }}"
                                           id="{{ $importStrategies::REPLACE_MARGIN }}"
                                           value="{{ $importStrategies::REPLACE_MARGIN }}">
                                    <label class="form-check-label" for="{{ $importStrategies::REPLACE_MARGIN }}">
                                        Zastąp marzę istniejących pozycji
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-success btn-icon-split" type="submit">
                                <span class="icon text-white-50">
                                  <i class="fas fa-file-import"></i>
                                </span>
                                <span class="text">Importuj plik</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
