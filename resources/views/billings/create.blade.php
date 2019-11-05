@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Dodaj billing</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('billings.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nazwa billingu</label>
                                <input type="text" pattern=".{3,200}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Na przykład: Billing 2019 Wrzesien" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="working_days_rate">Opłata za minutę połączenia w dni robocze</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">zł</span>
                                            </div>
                                            <input type="number" max="1" min="0" step="0.0001" class="form-control @error('working_days_rate') is-invalid @enderror"
                                                   id="working_days_rate" name="working_days_rate" placeholder="Na przykład: 0,012" value="0.0191" required>
                                            @error('working_days_rate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="saturday_rate">Opłata za minutę połączenia w sobotę</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">zł</span>
                                            </div>
                                            <input type="number" max="1" min="0" step="0.0001" class="form-control @error('saturday_rate') is-invalid @enderror"
                                                   id="saturday_rate" name="saturday_rate" placeholder="Na przykład: 0,013" value="0.018" required>
                                            @error('working_days_rate')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control @error('import_file') is-invalid @enderror" name="import_file" aria-describedby="import_fileDescription">
                                @error('import_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="import_fileDescription" class="form-text text-muted">Dozwolone rozszerzenia plików: <strong>*.csv</strong></small>
                            </div>
                            <button class="btn btn-success btn-icon-split" type="submit">
                                <span class="icon text-white-50">
                                  <i class="fas fa-file-upload"></i>
                                </span>
                                <span class="text">Dodaj</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
