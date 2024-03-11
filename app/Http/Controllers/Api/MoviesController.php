<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::all()->toArray();
        return $movies;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'rating' => 'required',
            'genre' => 'required'
        ]);
        $data = $request->all();
        $movie = Movie::create($data);
        $response = [
            'success' => true,
            'message' => 'Movie created successfully',
            'data' => $movie

        ];
        return response()->json($response);
    }
    public function show($id){
        $movie = Movie::find($id);
        return $movie;
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'rating' => 'required',
            'genre' => 'required'
        ]);
        $movie = Movie::find($id);
        $movie->update($request->all());
        $movie->update([
            'title'=>'updated movie'
        ]);
        $response = [
            'success' => true,
            'message' => 'Movie updated successfully',
            'data' => $movie
        ];
    
    }
}
