@extends('layouts.frontend')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <article>
                <h1 class="mb-3">{{ $article->title }}</h1>
                <p class="text-muted">
                    By <strong>{{ $article->user->name ?? 'Unknown Author' }}</strong> | 
                    Published on {{ \Carbon\Carbon::parse($article->published_at)->translatedFormat('d F Y, H:i') }}
                </p>
                <div class="mt-4">
                    {!! $article->content !!}
                </div>
            </article>
            <div class="mt-5">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">← Back to Articles</a>
            </div>
        </div>
    </div>
</div>
@endsection
