@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Lista billingów</h6>
                            <a href="{{ route('billings.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj billing</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nazwa billingu</th>
                                <th scope="col">Opłata za dni robocze</th>
                                <th scope="col">Opłata za sobotę</th>
                                <th scope="col">Data utworzenia</th>
                                <th scope="col">Rozliczenie</th>
                                <th scope="col">Akcje</th>
                            </tr>
                            </thead>
                            <tbody>
                                @each('billings.tbody._index', $billings, 'billing')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    @include('assets.js.billing')
@endsection
