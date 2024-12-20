@extends('layouts.app')

@section('title', 'Movies List')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Movies List</h1>
    <a href="{{ route('movies.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Add Movie
    </a>
</div>
<table class="table-auto w-full bg-white rounded-lg shadow-lg">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Year</th>
            <th class="px-4 py-2">Genre</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movies as $movie)
        <tr class="border-t">
            <td class="px-4 py-2">{{ $movie->title }}</td>
            <td class="px-4 py-2">{{ $movie->year }}</td>
            <td class="px-4 py-2">{{ $movie->genre->name }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('movies.edit', $movie->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
