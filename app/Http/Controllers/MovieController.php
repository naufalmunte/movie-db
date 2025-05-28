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
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        //
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
}
