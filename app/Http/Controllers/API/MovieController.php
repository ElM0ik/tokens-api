<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        return response()->json(Movie::with('characters')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'classification' => 'required|string|max:100',
            'release_date'   => 'required|date',
            'review'         => 'required|string',
            'season'         => 'nullable|integer|min:1',
        ]);

        $movie = Movie::create($validated);

        return response()->json($movie, 201);
    }

    public function show(Movie $movie)
    {
        return response()->json($movie->load('characters'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'name'           => 'sometimes|string|max:255',
            'classification' => 'sometimes|string|max:100',
            'release_date'   => 'sometimes|date',
            'review'         => 'sometimes|string',
            'season'         => 'nullable|integer|min:1',
        ]);

        $movie->update($validated);

        return response()->json($movie);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json(['message' => 'Película eliminada correctamente.']);
    }
}
