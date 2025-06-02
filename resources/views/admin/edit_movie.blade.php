@extends('layouts.main')
@section('title', 'Edit Movie')
@section('navInput', 'active')

@section('container')
<h1>Edit Movie</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container mt-4 mb-5">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="title" class="col-md-2 col-form-label">Title</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $movie->title) }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="slug" class="col-md-2 col-form-label">Slug</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $movie->slug) }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="synopsis" class="col-md-2 col-form-label">Synopsis</label>
                    <div class="col-md-10">
                        <textarea class="form-control" id="synopsis" name="synopsis" rows="4">{{ old('synopsis', $movie->synopsis) }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="category_id" class="col-md-2 col-form-label">Category</label>
                    <div class="col-md-10">
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="" disabled>Pilih Category</option>
                            <option value="1" {{ $movie->category_id == 1 ? 'selected' : '' }}>1. Action</option>
                            <option value="2" {{ $movie->category_id == 2 ? 'selected' : '' }}>2. Comedy</option>
                            <option value="3" {{ $movie->category_id == 3 ? 'selected' : '' }}>3. Drama</option>
                            <option value="4" {{ $movie->category_id == 4 ? 'selected' : '' }}>4. Sci-Fi</option>
                            <option value="5" {{ $movie->category_id == 5 ? 'selected' : '' }}>5. Romance</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="year" class="col-md-2 col-form-label">Year</label>
                    <div class="col-md-10">
                        <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $movie->year) }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="actors" class="col-md-2 col-form-label">Actors</label>
                    <div class="col-md-10">
                        <textarea class="form-control" id="actors" name="actors" rows="3">{{ old('actors', $movie->actors) }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                <label class="col-md-2 col-form-label">Old Cover</label>
                <div class="col-md-10">
                    @if ($movie->cover_image)
                        @php
                            $isUrl = filter_var($movie->cover_image, FILTER_VALIDATE_URL);
                            $coverSrc = $isUrl ? $movie->cover_image : asset('storage/' . $movie->cover_image);
                        @endphp
                        <img src="{{ $coverSrc }}" alt="Old Cover" style="max-height: 200px;" class="img-thumbnail mb-2">
                    @else
                        <p class="text-muted">No cover image uploaded.</p>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label for="cover_image" class="col-md-2 col-form-label">New Cover Image</label>
                <div class="col-md-10">
                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*">
                    <small class="text-muted">Leave blank if you don't want to change the cover image.</small>
                </div>
            </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a href="{{ route('admin.movies.list') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                const titleInput = document.getElementById("title");
                const slugInput = document.getElementById("slug");

                titleInput.addEventListener("input", function () {
                    let slug = titleInput.value.toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                    slugInput.value = slug;
                });
            });
            </script>
        </div>
    </div>
</div>
@endsection
