@extends('layout')
@section('content')
    <div class="p-5">
        <div class="d-flex justify-content-between my-5 p-2 bg-secondary">
            <a href="{{ url("/competitions/$competitions->slug") }}" class="btn btn-light">Overviews</a>
            <a href="{{ url("/competitions/$competitions->slug/standing") }}" class="btn btn-light">Standings</a>
            <a href="{{ url("/competitions/$competitions->slug/match") }}" class="btn btn-light">Matchs</a>
            <a href="{{ url("/competitions/$competitions->slug/final") }}" class="btn btn-light">final</a>
        </div>

        <div class="">
            <h5>{{ $competitions->name }}</h5>
            <p class="">Max teams : {{ $competitions->max_teams }}</p>
            <p class="">Group count : {{ $competitions->group_count }}</p>
            <p class="">Create at : {{ $competitions->created_at }}</p>
            <ul>
                <h6>Allowed countries</h6>
                @foreach ($competitions->allowed as $a)
                    <li>{{ $a->countries->name }}</li>
                @endforeach
            </ul>

            <h5>Teams</h5>
            <table class="table">
                <thead class="table-dark">
                    <th>No.</th>
                    <th>logo</th>
                    <th>Code</th>
                    <th>Team</th>
                </thead>
                <tbody>
                    @foreach ($competitions->teams as $c)
                        <tr>
                            <td>{{ $c->team->id}}</td>
                            <td> <img src="{{url($c->team->logo)}}" alt="" width="100" height="100" style="object-fit:contain" > </td>
                            <td>{{ $c->team->code }}</td>
                            <td>{{ $c->team->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>




    </div>
@endsection
