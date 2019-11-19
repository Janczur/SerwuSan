@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-6 col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">
                            @if($billing->imported)
                                Dane <small class="text-muted">(Tylko 10 pierwszych wyników)</small>
                            @else
                                Dane niepełne
                                <small class="text-muted"
                                       data-toggle="tooltip" data-placement="top" title="Kliknij aby odświeżyć stronę i sprawdzić czy dane się już zaimportowały"
                                       onclick="location.reload()">
                                    <span class="loading">
                                        (Trwa importowanie danych<span class="loader__dot">.</span><span class="loader__dot">.</span><span class="loader__dot">.</span>)
                                    </span>
                                </small>
                            @endif
                        </h4>
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
                                    <label for="weekend_rate">Opłata w weekend:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">zł</span>
                                        </div>
                                        <input class="form-control" id="weekend_rate" value="{{ $billing->weekend_rate }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">

                                <div class="form-group">
                                    <label for="settlement">Rozliczenie:</label>
                                    <div class="input-group">
                                        @if($billing->settlement)
                                            <div class="btn btn-success btn-icon-split">
                                                <span class="text">{{ $billing->settlement }}</span>
                                                <span class="icon text-white-50">zł</span>
                                            </div>
                                        @elseif($billing->imported)
                                            <button class="btn btn-primary btn-icon-split calculate-settlement" data-billing_id="{{ $billing->id }}">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-calculator fa-sm text-white-50"></i>
                                                </span>
                                                <span class="text">Przelicz</span>
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-warning btn-icon-split"
                                                    data-toggle="tooltip" data-placement="left" title="Kliknij aby odświeżyć stronę i sprawdzić czy dane się już zaimportowały"
                                                    onclick="location.reload()">
                                                <span class="icon text-white-50">
                                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                </span>
                                                <span class="text">Importowanie...</span>
                                            </button>
                                        @endif
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
@section('js')
    @include('assets.js.billing')
@endsection
