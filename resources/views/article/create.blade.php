@extends('layouts.articlecss')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create New Article') }}
    </h2>
@endsection

@section('content')
    <a href="{{ url('articles') }}" class="my-3 btn btn-secondary"><< Back</a>
    <div class="col-lg-8">
        <head>
            {{-- Trix Editor --}}
            <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
            <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

            {{-- Nonaktifkan upload di Trix --}}
            <style>
                trix-toolbar [data-trix-button-group="file-tools"] {
                    display: none;
                }
            </style>
        </head>

        <form action="{{ url('articles') }}" method="POST">
            @csrf
            <div class="my-3 p-3 bg-body rounded shadow-sm">

                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
            <label for="published_at" class="col-sm-2 col-form-label">Publish Date</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="published_at" id="published_at"
                    class="form-control @error('published_at') is-invalid @enderror"
                    value="{{ old('published_at', \Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}">
                @error('published_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
             </div>


                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                    <trix-editor input="content"></trix-editor>
                </div>

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="mb-3 row">
                <div class="col-sm-12 text-end">
                    <button type="submit" class="btn btn-primary" name="submit">Create Post</button>
                </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endsection
