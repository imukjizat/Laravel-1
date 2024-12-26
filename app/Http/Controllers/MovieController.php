<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('genre')->get();
        $genres = Genre::all();
        return view('movies.index', compact('movies', 'genres'));
    }

    public function create()
    {
        $movies = Movie::with('genre')->get();
        $genres = Genre::all();
        return view('movies.index', compact('movies', 'genres'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'genre_id' => 'required|exists:genres,id',
            'available' => 'nullable|boolean',
        ]);

        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $fileName = str_replace(' ', '_', $validatedData['title']) . '.' . $file->getClientOriginalExtension();
            $folder = public_path('images/');
            $file->move($folder, $fileName);
            $validatedData['poster'] = 'images/' . $fileName;
        }


        $validatedData['id'] = (string) Str::uuid();

        Movie::create($validatedData);

        return redirect()->route('movies.index')->with('success', 'Movie created successfully!');
    }



    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('movies.form', compact('movie', 'genres'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'genre_id' => 'required|uuid|exists:genres,id',
        ]);

        $movie->update($request->all());
        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}
