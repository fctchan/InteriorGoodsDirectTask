@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Top 10 Players</h1></div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Place</th>
                                <th scope="col">Player Name</th>
                                <th scope="col">Average Score</th>
                                <th scope="col">Total Wins</th>
                                <th scope="col">Total Losses</th>
                                <th scope="col">Total Matches</th>
                                <th scope="col">Highest Score</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($players as $player)
                                <tr>
                                    <th scope="row">{{ $seq++ }}</th>
                                    <td>{{ $player->username }}</td>
                                    <td>{{ $player->gameDetails->average_score }}</td>
                                    <td>{{ $player->gameDetails->total_win }}</td>
                                    <td>{{ $player->gameDetails->total_loss }}</td>
                                    <td>{{ $player->gameDetails->total_win + $player->gameDetails->total_loss }}</td>
                                    <td>{{ $player->highestScoringGame->score }} </td>
                                    <td><a href="{{ route('users.show', $player->id)}}" class="btn btn-info">Game Record</a></td>
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

