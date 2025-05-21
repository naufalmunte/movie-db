@extends('layouts.main')
@section('title')
@section('navHome', 'active')

@section('container')
<h1>Movie Detail</h1>
<div class="container mt-4">
    <div class="card shadow-sm d-flex flex-row">
        @if (filter_var($movie->cover_image, FILTER_VALIDATE_URL))
                        <img src="{{ $movie->cover_image }}" alt="{{ $movie->title }}" style="width: 250px; height: auto;">
                    @else
                        <img src="{{ asset('storage/' . $movie->cover_image) }}" alt="{{ $movie->title }}" style="width: 250px; height: auto;">
                    @endif
        <div class="card-body d-flex flex-column justify-content-between" style="width: 70%;">
            <h3><strong>Title: </strong>{{ $movie->title }}</h3>
            <p><strong>Synopsis:</strong> {{ $movie->synopsis }}</p>
            <p><strong>Year:</strong> {{ $movie->year }}</p>
            <p><strong>Actors:</strong> {{ $movie->actors }}</p>
            <a href="{{ url()->previous() }}" class="btn btn-success mt-3">Back</a>
        </div>
    </div>
</div>
@endsection