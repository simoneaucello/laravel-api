@php
    use App\Functions\Helper;
@endphp

@extends('layouts.admin')

@section('title')
    Dettaglio progetto:
@endsection

@section('content')
    <div class="container d-flex my-5 ">






        <div class="mx-3 flex-column d-flex">
            <h1> {{ $project->title }} </h1>
            <div>
                <a href="{{ route('admin.projects.edit', $project) }}" class=" btn bg-warning text-dark m-1"><i
                        class="fa-solid fa-pen"></i></a>
                {{-- DELETE FORM  --}}
                @include('admin.partials.formdelete')
            </div>
        </div>


        <div class="mx-5 mt-0">
            {{-- <h2>{{ $project->title }}</h2> --}}

            @if (count($project->technologies) > 0)
                <p>Tecnologie:
                    <br>
                    @foreach ($project->technologies as $technology)
                        <span class=" badge text-bg-warning "> {{ $technology->name }} </span>
                    @endforeach
                </p>
            @endif

            @if ($project->type)
                <p>Tipologie: <br> <span class="badge text-bg-success"> {{ $project->type->name }} </span> </p>
            @endif


            <p class="mt-3"> <span class="fw-bold"> Descrizione: <br> </span>
                {{ $project->description }} </p>

            {{-- <p class="mt-3 "> Linguaggi utilizzati: <span class="fw-bold"> {{ $project->prog_lang }} </span> </p> --}}

            <img class="img-fluid img-show" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                onerror="this.src='/img/no-image.png'">
        </div>


    </div>
@endsection
