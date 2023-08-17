@extends('layout')
@section('content')
    <div class="p-5">
        <div class="d-flex justify-content-between my-5 p-2 bg-secondary">
            <a href="{{ url("/competitions/$competitions->slug") }}" class="btn btn-light">Overviews</a>
            <a href="{{ url("/competitions/$competitions->slug/standing") }}" class="btn btn-light">Standings</a>
            <a href="{{ url("/competitions/$competitions->slug/match") }}" class="btn btn-light">Matchs</a>
            <a href="{{ url("/competitions/$competitions->slug/final") }}" class="btn btn-light">final</a>
        </div>







    </div>
@endsection
