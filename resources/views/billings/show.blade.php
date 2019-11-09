@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-7 col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Dane</h6>
                    </div>
                    <div class="card-body">
                        Dane
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Informacje o billingu</h6>
                            <a href="{{ route('billings.edit', $billing) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edytuj billing</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h1>{{ $billing->name }}</h1>
                        <p>Opłata za dni robocze: {{ $billing->working_days_rate }}</p>
                        <p>Opłata za sobotę: {{ $billing->saturday_rate }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
