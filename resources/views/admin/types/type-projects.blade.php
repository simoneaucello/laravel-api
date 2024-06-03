@php
    use App\Functions\Helper;
@endphp


@extends('layouts.admin')

@section('content')
    {{-- <h1>Elenco tipologie </h1> --}}

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Tipologia</th>
                <th scope="col">Progetti</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td> {{ $type->name }} </td>
                    <td>
                        <ul class="list-group">
                            @foreach ($type->projects as $project)
                                <li class="list-group-item"> <a href=" {{ route('admin.projects.show', $project) }} ">
                                        {{ $project->id }} - {{ $project->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
