@extends('layouts.appDashboard')
@section('title', 'Панель приборов')

@section('content')
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h5 style="text-transform: capitalize">{{ implode(' ', explode('_', $user->role->name)) }}</h5>
        <p>{{ $user->role->description }}</p>
    </div>
@endsection
