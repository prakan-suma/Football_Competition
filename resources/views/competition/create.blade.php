@extends('layout')
@section('content')
    <div class="d-flex align-items-center justify-content-center vh-100">
        <form class="col-4" action="{{ url('/competitions') }}" method="post">
            @csrf

            {{-- error  --}}
            @if ($errors->any())
                <div class="alert alert-warning">
                    {{ $errors->first() }}
                </div>
            @endif

            <h3>Create</h3>
            <p>New Competitions.</p>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" name="slug">
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Max teams</label>
                <input type="number" class="form-control" name="max_teams">
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Group count</label>
                <input type="number" class="form-control" name="group_count">
            </div>

            <div class="mb-3">
                <label for="" class="form-lable mb-3">Allowed countries</label>
                @foreach ($countries as $c)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="allowed_countries[]" value="{{ $c->id }}">
                        <label for="" class="form-check-label">{{ $c->id . '). ' . $c->name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary w-100">Create</button>

        </form>
    </div>
@endsection
