@extends('layouts.app')

@section('title', 'Movies List')

@section('content')

<section class="container my-24 mx-auto">
    <div class="flex justify-between px-20">
        <!-- Filter Categories -->
        <div class="flex items-center justify-center py-4 md:py-8 gap-4 flex-wrap">
            <a href="{{ route('movies.index') }}" 
               class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-bold text-base rounded-full px-6 py-3 shadow-lg hover:scale-105 hover:from-indigo-500 hover:to-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300 active:scale-95 transition transform">
               All categories
            </a>
            @foreach ($genres as $genre)
                <a href="{{ route('movies.index', ['genre' => $genre->id]) }}" 
                   class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-bold text-base rounded-full px-6 py-3 shadow-lg hover:scale-105 hover:from-indigo-500 hover:to-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300 active:scale-95 transition transform">
                   {{ $genre->name }}
                </a>
            @endforeach
        </div>
        
        <!-- Add Film Button -->
        <div class="flex items-center justify-center py-4 md:py-8 flex-wrap gap-4">
          <button
            class="text-white hover:text-white border border-blue-600 bg-blue-700 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center"
            onclick="openModalCreate()">
            Add Movie
          </button>
        </div>
    </div>

    <!-- Movie Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4 md:px-8 lg:px-16">
        @forelse ($movies as $movie)
        <div class="relative group rounded-lg shadow-md overflow-hidden bg-gradient-to-b from-gray-50 to-gray-100 text-black dark:from-gray-700 dark:to-gray-800 dark:text-white transition transform hover:scale-105 hover:shadow-xl">

                    <!-- Movie Poster -->
                    <div class="relative overflow-hidden rounded-lg aspect-[2/3] bg-gray-200">
                        <img 
                            class="object-cover w-full h-full"
                            src="{{ $movie->poster }}" 
                            alt="{{ $movie->title }}" 
                        >
                
                    <!-- Action Buttons -->
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                   
                    <!-- View Detail -->
                    <button 
                       class="mx-2 p-2"
                       onclick="openModalDetail({{ $movie }})">
                       <i class="fa-solid fa-circle-info fa-xl text-white hover:text-slate-300"></i>
                    </button>

                    <!-- Edit -->
                    <button 
                        class="mx-2 p-2"
                        onclick="openModalEdit('{{ $movie->id }}', '{{ $movie->title }}', '{{ $movie->synopsis }}', '{{ $movie->poster }}', '{{ $movie->year }}', '{{ $movie->genre_id }}', '{{ $movie->available }}')">
                        <i class="fa-solid fa-pen fa-lg text-blue-500 hover:text-blue-600"></i>
                    </button>
                                
                    <!-- Delete -->
                    <form method="POST" action="{{ route('movies.destroy', $movie->id) }}" class="inline-block delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" 
                                class="mx-2 p-2 delete-button"
                                data-movie-title="{{ $movie->title }}">
                            <i class="fa-regular fa-trash-can fa-lg text-red-500 hover:text-red-600"></i>                               
                        </button>
                    </form>                    
                </div>
            </div>
    
            <!-- Year and Genre -->
            <div class="absolute top-0 left-0 flex justify-between w-full p-2">

                <!-- Year -->
                <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white px-3 py-1 rounded-br-full text-sm font-semibold shadow-md flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                    </svg>
                    {{ $movie->year }}
                </div>

                <!-- Genre -->
                <div class="bg-gradient-to-r from-green-500 via-teal-500 to-cyan-500 text-white px-3 py-1 rounded-bl-full text-sm font-semibold shadow-md flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                    {{ $movie->genre->name }}
                </div>
            </div>
    
            <!-- Movie Details -->
            <div class="p-4">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-white line-clamp-1">
                    {{ $movie->title }}
                </h5>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                    {{ Str::limit($movie->synopsis, 100) }}
                </p>
            </div>
        </div>
        @empty
        <div class="flex items-center justify-center h-96 text-center text-white">
            <div>
                <h1 class="text-xl font-bold">No movies found</h1>
                <p>We couldn't find any movies that matched your search.</p>
                <button
                    class="mt-4 px-5 py-2 text-white bg-blue-500 rounded-lg shadow-lg hover:bg-blue-600 transition">
                    Add a movie
                </button>
            </div>
        </div>
        @endforelse
    </div>

</section>

{{-- Create Modal --}}
<div id="createMovieModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-3xl p-6 relative max-h-[90vh] overflow-y-auto">
        <button class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-3xl" onclick="closeModalCreate()">
            &times;
        </button>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Create Movie</h2>
        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                    placeholder="Enter movie title"
                    required
                />
            </div>

            <!-- Synopsis -->
            <div class="mb-4">
                <label for="synopsis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Synopsis</label>
                <textarea
                    name="synopsis"
                    id="synopsis"
                    rows="4"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                    placeholder="Write a brief synopsis"
                    required
                ></textarea>
            </div>

            <!-- Poster -->
            <div class="mb-4">
                <label for="poster" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Poster</label>
                <input
                    type="file"
                    name="poster"
                    id="poster"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 py-2 px-4"
                    onchange="previewImage(event)"
                />
                <div id="posterPreview" class="mt-2 hidden">
                    <img src="" alt="Poster Preview" class="max-h-40 rounded-lg shadow-md">
                </div>
            </div>

            <!-- Year -->
            <div class="mb-4">
                <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year</label>
                <input
                    type="number"
                    name="year"
                    id="year"
                    class="mt-1 block w-24 rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                    min="1960"
                    max="{{ date('Y') }}"
                    required
                    placeholder="Year"
                />
            </div>

            <!-- Genre -->
            <div class="mb-4">
                <label for="genre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Genre</label>
                <select
                    name="genre_id"
                    id="genre"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                >
                    <option value="">-- Select Genre --</option>
                    @forelse ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @empty
                        <option value="">No genres available</option>
                    @endforelse
                </select>
            </div>

            <!-- Available -->
            <div class="mb-4 flex items-center">
                <input
                    type="checkbox"
                    name="available"
                    id="available"
                    class="h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700 dark:bg-gray-700 focus:ring-blue-500"
                    value="1"
                    checked
                    required
                />
                <label for="available" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Available</label>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button type="button" class="mr-4 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600" onclick="closeModalCreate()">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>


{{-- Edit Modal --}}
<div id="editMovieModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-3xl p-6 relative max-h-[90vh] overflow-y-auto">
        <button class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-3xl" onclick="closeModalEdit()">
            &times;
        </button>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Edit Movie</h2>
        <form id="editMovieForm" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label for="editTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                <input
                    type="text"
                    name="title"
                    id="editTitle"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                    placeholder="Enter movie title"
                    required
                />
            </div>

            <!-- Synopsis -->
            <div class="mb-4">
                <label for="editSynopsis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Synopsis</label>
                <textarea
                    name="synopsis"
                    id="editSynopsis"
                    rows="4"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                    placeholder="Write a brief synopsis"
                    required
                ></textarea>
            </div>

            <!-- Poster -->
            <div class="mb-4">
                <label for="editPoster" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Poster</label>
                <input
                    type="file"
                    name="poster"
                    id="editPoster"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 py-2 px-4"
                    onchange="previewEditImage(event)"
                />
                <div id="editPosterPreview" class="mt-2">
                    <img src="" alt="Poster Preview" class="max-h-40 rounded-lg shadow-md">
                </div>
            </div>

            <!-- Year -->
            <div class="mb-4">
                <label for="editYear" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year</label>
                <input
                    type="number"
                    name="year"
                    id="editYear"
                    class="mt-1 block w-24 rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                    min="1960"
                    max="{{ date('Y') }}"
                    required
                    placeholder="Year"
                />
            </div>

            <!-- Genre -->
            <div class="mb-4">
                <label for="editGenre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Genre</label>
                <select
                    name="genre_id"
                    id="editGenre"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                >
                    <option value="">-- Select Genre --</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Available -->
            <div class="mb-4 flex items-center">
                <input
                    type="checkbox"
                    name="available"
                    id="editAvailable"
                    class="h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700 dark:bg-gray-700 focus:ring-blue-500"
                    value="1"
                />
                <label for="editAvailable" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Available</label>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button type="button" class="mr-4 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600" onclick="closeModalEdit()">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

{{-- Detail Modal --}}
<div id="detailMovieModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-3xl p-6 relative max-h-[90vh] overflow-y-auto">
        <button class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-3xl" onclick="closeModalDetail()">
            &times;
        </button>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Movie Detail</h2>
        <form class="mt-4">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="detailTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                <input
                    type="text"
                    id="detailTitle"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                    disabled
                    readonly
                />
            </div>

            <!-- Synopsis -->
            <div class="mb-4">
                <label for="detailSynopsis" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Synopsis</label>
                <textarea
                    id="detailSynopsis"
                    rows="4"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                    disabled
                    readonly
                ></textarea>
            </div>
            
            <!-- Poster -->
            <div class="mb-4">
                <label for="detailPoster" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Poster</label>
                <img id="detailPoster" class="max-w-full max-h-40 rounded-lg shadow-md object-contain" src="" alt="Poster Preview">
            </div>

            
            <!-- Year -->
            <div class="mb-4">
                <label for="detailYear" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year</label>
                <input
                    type="text"
                    id="detailYear"
                    class="mt-1 block w-24 rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                    disabled
                    readonly
                />
            </div>

            <!-- Genre -->
            <div class="mb-4">
                <label for="detailGenre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Genre</label>
                <input
                    type="text"
                    id="detailGenre"
                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500 py-2 px-4"
                    disabled
                    readonly
                />
            </div>

            <!-- Available -->
            <div class="mb-4 flex items-center">
                <input
                    type="checkbox"
                    id="detailAvailable"
                    class="h-4 w-4 text-blue-600 border-gray-300 dark:border-gray-700 dark:bg-gray-700"
                    disabled
                    readonly
                />
                <label for="detailAvailable" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Available</label>
            </div>

            <!-- Close Button -->
            <div class="mt-6 flex justify-end">
                <button type="button" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600" onclick="closeModalDetail()">Close</button>
            </div>
            
        </form>
    </div>
</div>

@endsection
