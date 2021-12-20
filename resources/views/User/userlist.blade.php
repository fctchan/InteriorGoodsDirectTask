@extends('layouts.app')

@section('content')

<div class="container">
    @if(isset($newPlayerName))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">
                    New player "{{ $newPlayerName }}" has been created!
                </div>
            </div>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Players List</h1></div>
                <div class="card-body">
                    <div><a href="{{ route('User.create')}}" class="btn btn-success">{{ __('Create New Player') }}</a></div>
                    <div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Player Name</th>
                                    <th scope="col">Telephone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->uid }}</th>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->tel }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', [$user->uid]) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                        <a href="{{ route('users.show', [$user->uid])}}" class="btn btn-info">Game Record</a>
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
</div>
@endsection
