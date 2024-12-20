@extends('layouts.app')

@section('title', isset($movie) ? 'Edit Movie' : 'Add Movie')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ isset($movie) ? 'Edit Movie' : 'Add Movie' }}</h1>
<form action="{{ isset($movie) ? route('movies.update', $movie->id) : route('movies.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
    @csrf
    @if(isset($movie))
    @method('PUT')
    @endif
    <div class="mb-4">
        <label for="title" class="block text-gray-700 font-bold">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $movie->title ?? '') }}" class="w-full border-gray-300 rounded-lg shadow-sm">
    </div>
    <div class="mb-4">
        <label for="year" class="block text-gray-700 font-bold">Year</label>
        <input type="number" name="year" id="year" value="{{ old('year', $movie->year ?? '') }}" class="w-full border-gray-300 rounded-lg shadow-sm">
    </div>
    <div class="mb-4">
        <label for="genre_id" class="block text-gray-700 font-bold">Genre</label>
        <select name="genre_id" id="genre_id" class="w-full border-gray-300 rounded-lg shadow-sm">
            @foreach($genres as $genre)
            <option value="{{ $genre->id }}" {{ isset($movie) && $movie->genre_id == $genre->id ? 'selected' : '' }}>
                {{ $genre->name }}
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ isset($movie) ? 'Update' : 'Save' }}
    </button>
</form>
@endsection
