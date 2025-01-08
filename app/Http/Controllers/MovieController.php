<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $genreId = $request->get('genre');

        $genres = Genre::all();

        $movies = Movie::with('genre')
            ->when($genreId, function ($query, $genreId) {
                return $query->where('genre_id', $genreId);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('movies.index', compact('movies', 'genres', 'genreId'));
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
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
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
        return response()->json(['movie' => $movie->load('genre'), 'genres' => $genres]);
    }

    public function update(Request $request, Movie $movie)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
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

        $movie->update($validatedData);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully!');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}
