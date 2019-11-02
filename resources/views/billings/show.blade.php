@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <a href="{{ route('billings.edit', $billing) }}" class="btn btn-primary">Edytuj</a>
                <h1>{{ $billing->name }}</h1>
                <p>Opłata za dni robocze: {{ $billing->working_days_rate }}</p>
                <p>Opłata za sobotę: {{ $billing->saturday_rate }}</p>
            </div>
        </div>

    </div>
@endsection
