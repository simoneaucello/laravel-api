@extends('layouts.admin')

@section('content')
    <div class="container my-4">

        <h1 class="fw-bold">DASHBOARD</h1>
        <h2>Sono presenti <span class="text-danger">{{ $project_count }}</span> progetti </h2>

        <div class="mt-5">
            <h3 class="mb-5">Ultimo progetto:</h3>
            <h3 class="text-danger"> {{ $last_project->title }} </h3>
            <div class="">
                <img class="img-fluid img-show" src="{{ asset('storage/' . $last_project->image) }}"
                    alt="{{ $last_project->title }}" onerror="this.src='/img/no-image.png'">
                <p>{{ $last_project->description }} </p>
            </div>
        </div>
    </div>
@endsection
