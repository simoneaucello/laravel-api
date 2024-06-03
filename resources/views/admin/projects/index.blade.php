@extends('layouts.admin')

@section('content')
    <div class="container my-5">

        <h1>Elenco Progetti:</h1>

        @if (isset($_GET['toSearch']))
            <h4>Ricerca per: {{ $_GET['toSearch'] }} | Elementi trovati: {{ $count_search }} </h4>
        @endif

        @if (session('delete'))
            <div class="alert alert-success" role="alert">
                {{ session('delete') }}
            </div>
        @endif

        <table class="table crud-table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Immagine</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Tecnologie</th>
                    <th scope="col">Azioni</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td><img class="cover-img" src="{{ asset('storage/' . $project->image) }}  "
                                alt="{{ $project->title }}" onerror="this.src='/img/no-image.png'">
                        </td>
                        <td class="fw-bold">{{ $project->title }}</td>
                        <td class="">{{ $project->type?->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>
                            @forelse ($project->technologies as $technology)
                                <span class=" badge text-bg-warning "> {{ $technology->name }} </span>
                            @empty
                                - no -
                            @endforelse
                        </td>
                        {{-- <td>{{ $project->prog_lang }}</td> --}}
                        <td>
                            <div class="d-flex ">
                                <a href="{{ route('admin.projects.show', $project) }}"
                                    class=" btn bg-success text-white m-1"> <i class="fa-solid fa-circle-info"></i></a>
                                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning m-1"><i
                                        class="fa-solid fa-pencil"></i></a>
                                @include('admin.partials.formdelete')
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
