@extends('layouts.app')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page Not Found</p>
            <p class="text-gray-500 mb-0">Wygląda na to, że podana strona nie istnieje.</p>
            <a href="{{ url('/') }}">&larr; Powrót do strony głównej</a>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
