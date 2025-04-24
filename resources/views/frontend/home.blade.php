@extends('layouts.home')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Berita Terbaru</h2>
    
    @foreach($articles as $article)
        <div class="card mb-3">
            <div class="card-body">
                <h4><a href="{{ route('article.show', $article->id) }}">{{ $article->title }}</a></h4>
                <small class="text-muted">
                    Dipublikasikan pada: {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}
                </small>
                <p class="mt-2">
                    {{ Str::limit(strip_tags($article->content), 150, '...') }}
                </p>
                <a href="{{ route('article.show', $article->id) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
            </div>
        </div>
    @endforeach
    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
    {{ $articles->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
