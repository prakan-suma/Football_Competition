@extends('layout')
@php
    $groupAt = 1;
@endphp
@section('content')
<div class="d-flex justify-content-between my-5 p-2 bg-secondary">
    <a href="{{ url("/competitions/$competitions->slug") }}" class="btn btn-light">Overviews</a>
    <a href="{{ url("/competitions/$competitions->slug/standing") }}" class="btn btn-light">Standings</a>
    <a href="{{ url("/competitions/$competitions->slug/match") }}" class="btn btn-light">Matchs</a>
    <a href="{{ url("/competitions/$competitions->slug/final") }}" class="btn btn-light">final</a>
</div>

    <div class="d-flex justify-content-between align-content-center p-1">
        <h3>Match</h3>
        <div class="d-flex">
            <a href="{{ url("/competitions/$competitions->slug/create-matches") }}" class="mx-4 btn btn-success">Create
                matches</a>
            <a href="{{ url("/competitions/$competitions->slug/rollback-matches") }}" class="btn btn-danger">Rollback all
                matches</a>
        </div>
    </div>

    {{-- // match  --}}
    @php
        $i = 1;
    @endphp
    @foreach ($matchesGroup as $match)
        <div class="mb-4">
            <h4>Group {{ $i++ }}<h4>

                    @foreach ($match as $m)
                        <div class="row py-3 my-3 text-center align-items-center bg-light">
                            <div class="col"><img src="{{ url($m->teams->logo) }}" alt="" height="50"
                                    width="50" style="object-fit: contain"></div>
                            <div class="col">
                                <p>{{ $m->teams->name }}</p>
                            </div>
                            <div class="col">VS</div>
                            <div class="col">
                                <p>{{ $m->against->name }}</p>
                            </div>
                            <div class="col"><img src="{{ url($m->against->logo) }}" alt="" height="50"
                                    width="50" style="object-fit: contain"></div>
                        </div>
                    @endforeach
        </div>
    @endforeach


    {{-- final --}}
@endsection
