@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-6 col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Dane <small class="text-muted">(Tylko 10 pierwszych wyników)</small></h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Początek rozmowy</th>
                                <th scope="col">Czas trwania <small>(sekundy)</small></th>
                            </tr>
                            </thead>
                            <tbody>
                                @each('billings.tbody._show', $billingData, 'billingData')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary">{{ $billing->name }}</h4>
                            <a href="{{ route('billings.edit', $billing) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edytuj billing</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="working_days_rate">Opłata za dni robocze:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">zł</span>
                                        </div>
                                        <input class="form-control" id="working_days_rate" value="{{ $billing->working_days_rate }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="saturday_rate">Opłata w sobotę:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">zł</span>
                                        </div>
                                        <input class="form-control" id="saturday_rate" value="{{ $billing->saturday_rate }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
