@extends('layouts.templatecss')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('List Posts') }}
    </h2>
@endsection

@section('content')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- FORM PENCARIAN -->
        <div class="pb-3">
            <form class="d-flex" action="{{ url('articles') }}" method="get">
                <input class="form-control me-1" type="search" name="keywords" value="{{ Request::get('keywords') }}"
                    placeholder="Enter keywords" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Search</button>
            </form>
        </div>

        <div class="pb-3">
            <a href='{{ 'articles/create' }}' class="btn btn-primary">+ Add Data</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-3">Title</th>
                    <th class="col-md-2">Published At</th>
                    <th class="col-md-2">Author</th>
                    <th class="col-md-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $articles->firstItem() ?>
                @foreach ($articles as $article)
                    <tr>
                        <td><?php echo $i ?></td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->published_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $article->user->name }}</td>
                        <td>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        {{ $articles->links() }}
    </div>
@endsection
