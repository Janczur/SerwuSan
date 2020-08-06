@inject('importStrategies', 'App\Imports\Strategies\ProviderMargin')
@extends('layouts.app')
@section('title', 'Importuj cennik')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Dodaj cennik</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('providersPriceLists.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nazwa cennika</label>
                                <input type="text" pattern=".{3,200}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Na przykład: Cennik od ACO" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control @error('importFile') is-invalid @enderror" name="importFile" aria-describedby="importFileDescription">
                                @error('importFile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="importFileDescription" class="form-text text-muted">Dozwolone rozszerzenia plików: <strong>*.xlsx, *.csv</strong></small>
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
