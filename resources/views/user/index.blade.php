@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('List User') }}
    </h2>
@endsection
<!-- START DATA -->
@extends('layouts.templatecss')
@section('content')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- FORM PENCARIAN -->
        <div class="pb-3">
            <form class="d-flex" action="{{ url('users') }}" method="get">
                <input class="form-control me-1" type="search" name="keywords" value="{{ Request::get('keywords') }}"
                    placeholder="Enter keywords" aria-label="Search">
                <button class="btn btn-secondary" type="submit">Serach</button>
            </form>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-4">Name</th>
                    <th class="col-md-4">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php $i =$data->firstItem()?>
                @foreach ($data as $item)
                <tr>
                    <td><?php echo $i?></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                </tr>
                <?php $i++?>
                @endforeach
            </tbody>
        </table>
    {{ $data->links() }}

    </div>
    <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    </body>
@endsection
