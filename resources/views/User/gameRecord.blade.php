@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Player's Game Record</h1></div>

                <div class="card-body">

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Player Name:') }}</label>

                        <div class="col-md-4">
                            {{ $user->username }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Total Win(s):') }}</label>

                        <div class="col-md-4">
                        {{ $user->gameDetails->total_win }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Total Loss(es):') }}</label>

                        <div class="col-md-4">
                        {{ $user->gameDetails->total_loss }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Average Score:') }}</label>

                        <div class="col-md-4">
                        {{ $user->gameDetails->average_score }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Highest Score:') }}</label>

                        <div class="col-md-6">
                            NB: This functionality is intentionally not refactored due to time.
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
