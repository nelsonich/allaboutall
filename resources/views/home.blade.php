@extends('layouts.appDashboard')
@section('title', 'Панель приборов')

@section('content')
    <div class="card-body">
        <div class="home">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            <div>
                <h2>Информация об аккаунте</h2>
                <h5 style="text-transform: capitalize">{{ implode(' ', explode('_', $user->role->name)) }}</h5>
                <p>{{ $user->role->description }}</p>
            </div>


            <div>
                <h2>Это страницы на котором вы будете работать</h2>

                <ol>
                    @forelse($permissions as $key => $permission)
                        @if($permission['actions']['is_view'])
                            <li>
                                <a href="{{ url('dashboard/' . $permission->slug . '?key=' . $permission->slug) }}">
                                    <span class="listName">{{ $permission->name }}</span>
                                </a>
                            </li>
                        @endif
                    @empty
                        Empty!
                    @endforelse
                </ol>    
            </div>
        </div>
    </div>
@endsection
