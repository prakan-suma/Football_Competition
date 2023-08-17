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

    <div class="p-1">
        <h3 class="text-center">{{ $competitions->name }}</h3>
        <div class="d-flex w-100 justify-content-center my-3">
            <a href="{{ url("/competitions/$competitions->slug/allocate-teams") }}" class="btn btn-dark">Allocate teams into
                a group </a>

            <a href="{{ url("/competitions/$competitions->slug/rollback-group") }}" class="btn btn-warning mx-3">Rollback groups</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-warning">{{ $errors->first() }}</div>
    @endif

    @foreach ($groupRel as $gr)
        <div class="p-5">

            <h5>{{ 'Group ' . $groupAt++ }}</h5>

            <table class="table mb-5 align-middle table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Team</th>
                    <th>MP</th>
                    <th>W</th>
                    <th>D</th>
                    <th>L</th>
                    <th>GF</th>
                    <th>GA</th>
                    <th>GD</th>
                    <th>Pts</th>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                        $sortGrp = $gr->sortByDesc('Pts');
                    @endphp

                    {{-- Rel  --}}
                    @foreach ($sortGrp as $g)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><img src="{{ url($g->teams->logo) }}" alt="" width="50" height="50"
                                    style="object-fit: contain;"></td>
                            <td>{{ $g->teams->name }}</td>
                            <td>{{ $g->MP }}</td>
                            <td>{{ $g->W }}</td>
                            <td>{{ $g->D }}</td>
                            <td>{{ $g->L }}</td>
                            <td>{{ $g->GF }}</td>
                            <td>{{ $g->GA }}</td>
                            <td>{{ $g->GF - $g->GA }}</td>
                            <td>{{ $g->Pts }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
@endsection
