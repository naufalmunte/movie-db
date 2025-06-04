@extends('layouts.main')

@section('container')
<div class="container mt-5 pb-5">

    <h1>Daftar Movie</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-hover mt-4">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Category</th>
                <th>Year</th>
                <th>Actors</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($movies as $movie)
                <tr>
                    <td>{{ ($movies->currentPage() - 1) * $movies->perPage() + $loop->iteration }}</td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->category->category_name }}</td>
                    <td>{{ $movie->year }}</td>
                    <td>{{ $movie->actors }}</td>
                    <td>
                        <a href="/movie/{{ $movie->id }}/{{ $movie->slug }}" class="btn btn-success btn-sm">Detail</a>

                        @if (auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endif

                         
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada movie.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-end mt-4">
        {{ $movies->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
