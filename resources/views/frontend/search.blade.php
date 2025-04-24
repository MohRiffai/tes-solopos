@extends('layouts.frontend')

@section('content')
<div class="container mt-5 pt-4">
    <h2>Hasil Pencarian untuk: <em>{{ $keyword }}</em></h2>
    <hr>

    @if($home->count())
        <div class="row">
            @foreach($home as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">
                                {{ $item->getExcerpt() }}
                            </p>
                            <a href="{{ route('articles.show', $item->id) }}" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $home->links() }}
        </div>
    @else
        <p class="text-muted">Tidak ditemukan artikel yang cocok dengan pencarian Anda.</p>
    @endif
</div>
@endsection
