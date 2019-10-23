@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Lista billingów</h6>
                            <a href="{{ route('billings.create') }}" class="d-none d-sm-inline-block btn btn-sm bg-gradient-success btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Dodaj billing</a>
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
                                <th scope="col">Akcje</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($billings as $billing)
                                <tr>
                                    <th scope="row">{{ $billing->id }}</th>
                                    <td><a href="{{ route('billings.show', $billing) }}">{{ $billing->name }}</a></td>
                                    <td>{{ $billing->working_days_rate }}</td>
                                    <td>{{ $billing->saturday_rate }}</td>
                                    <td>{{ $billing->created_at }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('billings.destroy', $billing) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger bg-gradient-danger">Usuń</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
