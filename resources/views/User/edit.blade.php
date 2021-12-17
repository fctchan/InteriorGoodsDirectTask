@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success" role="alert">
                    Player updated!
                </div>
            </div>
        </div>
    @endif

    @if ($errors->any())
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Edit Player</h1></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('User.update', [$user[0]->uid]) }}">
                        @csrf
                        @method('put')

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Player Name') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ $user[0]->username }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>

                            <div class="col-md-6">
                                <input id="telephone" type="number" class="form-control" name="telephone" value="{{ old('telephone', $user[0]->tel) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user[0]->email) }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                                <a href="{{ route('User.index')}}" class="btn btn-secondary">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
