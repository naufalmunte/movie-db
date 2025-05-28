@extends('layouts.main')
@section('title', 'Add New Movie')
@section('navInput', 'active')

@section('container')
<h1>Add New Movie</h1>
 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
 </div>
@endif
<div class="container mt-4 mb-5"> <!-- Menambahkan margin bottom -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="title" class="col-md-2 col-form-label">Title</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="slug" class="col-md-2 col-form-label">Slug</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="slug" name="slug" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="synopsis" class="col-md-2 col-form-label">Synopsis</label>
                    <div class="col-md-10">
                        <textarea class="form-control" id="synopsis" name="synopsis" rows="4"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="category_id" class="col-md-2 col-form-label">Category</label>
                    <div class="col-md-10">
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="" disabled selected>Pilih Category</option>
                            <option value="1">1. Action</option>
                            <option value="2">2. Comedy</option>
                            <option value="3">3. Drama</option>
                            <option value="4">4. Sci-Fi</option>
                            <option value="5">5. Romance</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="year" class="col-md-2 col-form-label">Year</label>
                    <div class="col-md-10">
                        <input type="number" class="form-control" id="year" name="year" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="actors" class="col-md-2 col-form-label">Actors</label>
                    <div class="col-md-10">
                        <textarea class="form-control" id="actors" name="actors" rows="3"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="cover_image" class="col-md-2 col-form-label">Cover Image</label>
                    <div class="col-md-10">
                        <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
            <script>
            document.addEventListener("DOMContentLoaded", function () {
                const titleInput = document.getElementById("title");
                const slugInput = document.getElementById("slug");

                titleInput.addEventListener("input", function () {
                    let slug = titleInput.value.toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9\s-]/g, '')     // Hapus karakter non-alfanumerik kecuali spasi dan -
                        .replace(/\s+/g, '-')              // Ganti spasi dengan -
                        .replace(/-+/g, '-');              // Ganti -- dengan -
                    slugInput.value = slug;
                });
            });
        </script>

        </div>
    </div>
</div>
@endsection
