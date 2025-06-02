<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Categories;

class MovieController extends Controller
{
   public function index()
    {
        $movies = Movie::select('id','title', 'synopsis', 'cover_image','year','slug')->paginate(6);
        return view('movie.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('movie.form_movie');
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:movies,slug',
            'synopsis' => 'nullable|string',
            'category_id' => 'required|integer',
            'year' => 'required|integer',
            'actors' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
        }

        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id) {
        $movies = Movie::findOrFail($id);
        return view('movie.show', compact('movies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.edit_movie', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:movies,slug,' . $id,
            'synopsis' => 'nullable|string',
            'category_id' => 'required|integer',
            'year' => 'required|integer',
            'actors' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->title = $request->title;
        $movie->slug = $request->slug;
        $movie->synopsis = $request->synopsis;
        $movie->category_id = $request->category_id;
        $movie->year = $request->year;
        $movie->actors = $request->actors;

        if ($request->hasFile('cover_image')) {
            if ($movie->cover_image && \Storage::exists('public/' . $movie->cover_image)) {
                \Storage::delete('public/' . $movie->cover_image);
            }

            $path = $request->file('cover_image')->store('covers', 'public');
            $movie->cover_image = $path;
        }

        $movie->save();

        return redirect()->route('admin.movies.list')->with('success', 'Movie updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        // Hapus file cover image jika ada
        if ($movie->cover_image && \Storage::exists('public/' . $movie->cover_image)) {
            \Storage::delete('public/' . $movie->cover_image);
        }

        // Hapus data movie dari database
        $movie->delete();

        return redirect()->route('admin.movies.list')->with('success', 'Movie deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Query pencarian berdasarkan title
        $movies = Movie::where('title', 'LIKE', "%{$query}%")->paginate(6);

        return view('movie.index', compact('movies'));
    }

   public function detail_movie($id,$slug) {
        $movie = Movie::find($id);
        // dd($movie);
        return view('movie.detail_movie', compact('movie'));
    }

    // di MovieController.php
    public function showMovies()
    {
        $movies = Movie::with('category')->paginate(10);
        $categories = Categories::all();
        return view('admin.list_movie', compact('movies', 'categories'));
    }

}
