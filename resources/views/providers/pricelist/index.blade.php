@extends('layouts.app')
@section('title', 'Lista cenników dostawców')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Lista cenników</h6>
                            <div class="ml-auto">
                                <a href="{{ route('providersPriceLists.import') }}"
                                   class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                        class="fas fa-file-import fa-sm text-white-50"></i> Prześlij plik</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nazwa cennika</th>
                                <th scope="col">Utworzono</th>
                                <th scope="col">Akcje</th>
                            </tr>
                            </thead>
                            <tbody>
                                @each('providers.pricelist.tbody._index', $providersPricelists, 'providerPricelist')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
