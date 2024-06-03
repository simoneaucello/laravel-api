@extends('layouts.admin')

@section('title')
    Aggiungi fumetto
@endsection

@section('content')
    <div class="container my-5">
        <h1 class="text-warning mb-5"> {{ $mod_add_project }} </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ $route }}" method="POST" enctype="multipart/form-data"> @csrf
            @method($method)

            <div class="mb-3 bg-body-tertiary rounded p-2">
                <label for="title" class="form-label">Titolo:</label>
                <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    value=" {{ old('title', $project?->title) }} ">

                @error('title')
                    <small class="text-danger fw-bold">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="mb-3 bg-body-tertiary rounded p-2">
                <label for="description" class="form-label">Descrizione:</label>
                <textarea name="description" type="text" class="form-control @error('description') is-invalid @enderror"
                    id="description" aria-describedby="emailHelp">{{ old('description', $project?->description) }}</textarea>

                @error('description')
                    <small class="text-danger fw-bold">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="mb-3 bg-body-tertiary rounded p-2">
                <label for="type" class="form-label">Tipologie: </label>
                <select name="type_id" class="form-select" aria-label="Default select example">
                    <option value="">Seleziona una tipologia</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if (old('type_id', $project?->type_id) == $type->id) selected @endif>
                            {{ $type->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3 bg-body-tertiary rounded p-2">
                <label for="type" class="form-label">Tecnologie: </label>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($technologies as $technology)
                        <input name="technologies[]" type="checkbox" class="btn-check" id="technology_{{ $technology->id }}"
                            autocomplete="off" value="{{ $technology->id }} @error('technologies[]') is-invalid @enderror"
                            @if (
                                ($errors->any() && in_array($technology->id, old('technologies', []))) ||
                                    (!$errors->any() && $project?->technologies->contains($technology))) checked @endif>
                        <label class="btn btn-outline-primary" for="technology_{{ $technology->id }}">
                            {{ $technology->name }}
                        </label>
                    @endforeach

                    @error('technologies[]')
                        <small class="text-danger fw-bold">
                            {{ $message }}
                        </small>
                    @enderror


                </div>

            </div>

            <div class="mb-3 bg-body-tertiary rounded p-2">
                <label for="image" class="form-label">Immagine:</label>
                <input name="image" type="file" class="form-control @error('image') is-invalid @enderror "
                    id="image" aria-describedby="emailHelp" onchange="showImage(event)">

                <img class="thumb" id="thumb" src="{{ asset('storage/' . $project?->image) }}" alt=""
                    onerror="this.src='/img/no-image.png'">
                <p> {{ $project?->image_original_name }} </p>
                @error('image')
                    <small class="text-danger fw-bold">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            {{-- <div class="mb-3 bg-body-tertiary rounded p-2">
                <label for="price" class="form-label">Linguaggi utilizzati:</label>
                <input name="prog_lang" type="text" class="form-control @error('prog_lang') is-invalid @enderror"
                    id="prog_lang" aria-describedby="emailHelp" value=" {{ old('prog_lang', $project?->prog_lang) }} ">

                @error('prog_lang')
                    <small class="text-danger fw-bold">
                        {{ $message }}
                    </small>
                @enderror
            </div> --}}

            <button type="submit" class="btn bg-success text-white"> {{ $add_mod_btn }} </button>
            <button type="reset" class="btn bg-warning">RESET</button>

        </form>
    </div>

    <script>
        function showImage(event) {
            // console.log(URL.createObjectURL(event.target.files[0]);
            const thumb = document.getElementById('thumb');
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
