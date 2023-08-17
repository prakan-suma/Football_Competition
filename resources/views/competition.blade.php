@extends('layout')

@section('content')
    <section class="py-5">
        <div class="d-flex justify-content-between mb-5">
            <h3>Competition Management</h3>
            <a href="{{ url('/competitions/create') }}" class="btn btn-dark">
                New Competition
            </a>
        </div>



            @foreach ($competitions as $c)
                <div class="card mb-3">
                    <div class="card-header">{{ $c->name }}</div>
                    <div class="card-body">
                        <p class="card-text">Max teams</p>
                        <p class="card-text">{{$c->max_teams}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Allowed countries</li>
                        @foreach ($c->allowed as $ct)
                            <li class="list-group-item">{{ '-' . $ct->countries->name }}</li>
                        @endforeach
                    </ul>
                    <div class="card-body">
                        <a href="{{url("/competitions/$c->slug")}}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            @endforeach


        </div>
    </section>
@endsection
