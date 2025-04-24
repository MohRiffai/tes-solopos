@extends('layouts.articlecss')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Article') }}
    </h2>
@endsection

@section('content')
    <a href="{{ url('articles') }}" class="my-3 btn btn-secondary"><< Back</a>

    <div class="col-lg-8">
        {{-- Trix Editor --}}
        <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
        <style>
            trix-toolbar [data-trix-button-group="file-tools"] {
                display: none;
            }
        </style>

        <form action="{{ url('articles/' . $article->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" id="title" value="{{ old('title', $article->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="col-form-label">Content</label>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="content" type="hidden" name="content" value="{{ old('content', $article->content) }}">
                    <trix-editor input="content"></trix-editor>
                </div>

                <div class="mb-3 row">
                    <label for="published_at" class="col-sm-2 col-form-label">Publish Date</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="published_at" id="published_at"
                               class="form-control @error('published_at') is-invalid @enderror"
                               value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="save" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name="submit">Update Article</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
