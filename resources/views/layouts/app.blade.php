<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="https://logosandtypes.com/wp-content/uploads/2021/02/force.svg" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Flick Tales</title>
  <script>
    tailwind.config = {
        darkMode: 'class',
    }
  </script>
  <script>
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
 </script>
</head>
<body class="bg-white dark:bg-gray-900">

<header>
  @include('layouts.header')
</header>


<main class="min-h-screen flex flex-col items-start mx-auto">
    @yield('content')
</main>

<footer class="bg-white dark:bg-gray-900 w-full border-t border-gray-200 dark:border-gray-600">
  @include('layouts.footer')
</footer>

</body>

<script>
function openModalCreate() {
    const modal = document.getElementById('createMovieModal');
    document.body.classList.add('overflow-hidden');
    modal.classList.remove('hidden', 'opacity-0', 'scale-95');
    modal.classList.add('opacity-100', 'scale-100');
}

function closeModalCreate() {
    const modal = document.getElementById('createMovieModal');
    document.body.classList.remove('overflow-hidden');
    modal.classList.remove('opacity-100', 'scale-100');
    modal.classList.add('opacity-0', 'scale-95');
    setTimeout(() => modal.classList.add('hidden'), 300);
}
</script>

<script>
    function openModalEdit(movieId) {
    fetch(`/movies/${movieId}/edit`)
        .then(response => response.json())
        .then(data => {
            const form = document.getElementById('editMovieForm');
            form.action = `/movies/${movieId}`;

            document.getElementById('editTitle').value = data.movie.title;
            document.getElementById('editSynopsis').value = data.movie.synopsis;
            document.getElementById('editYear').value = data.movie.year;
            document.getElementById('editGenre').value = data.movie.genre_id;
            document.getElementById('editAvailable').checked = data.movie.available;

            const posterPreview = document.getElementById('editPosterPreview').querySelector('img');
            posterPreview.src = data.movie.poster ? `/${data.movie.poster}` : '';
            posterPreview.parentNode.classList.toggle('hidden', !data.movie.poster);

            document.body.classList.add('overflow-hidden');
            document.getElementById('editMovieModal').classList.remove('hidden');
        });
}

function closeModalEdit() {
    const modal = document.getElementById('editMovieModal');
    document.body.classList.remove('overflow-hidden');
    modal.classList.add('hidden');
}
</script>

<script>
    function previewEditImage(event) {
    const preview = document.getElementById('editPosterPreview');
    const img = preview.querySelector('img');

    if (event.target.files && event.target.files[0]) {
        img.src = URL.createObjectURL(event.target.files[0]);
        preview.classList.remove('hidden');
    } else {
        img.src = '';
        preview.classList.add('hidden');
    }
}

</script>

<script>
  function previewImage(event) {
    const preview = document.getElementById('posterPreview');
    const img = preview.querySelector('img');
    img.src = URL.createObjectURL(event.target.files[0]);
    preview.classList.remove('hidden');
    setTimeout(() => img.classList.remove('opacity-0'), 10);
      
      if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function (e) {
              previewImage.src = e.target.result;
              previewContainer.classList.remove('hidden');
          };
          reader.readAsDataURL(input.files[0]);
      } else {
          previewImage.src = "";
          previewContainer.classList.add('hidden');
      }
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 1200,
                showConfirmButton: false,
                willClose: () => {
                    closeModalCreate();
                    closeModalEdit();
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        @endif

        document.querySelectorAll('.delete-button').forEach(function (button) {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form'); 
                const movieTitle = this.dataset.movieTitle; 

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete "${movieTitle}". This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); 
                    }
                });
            });
        });
    });
</script>

<script>
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

    var themeToggleBtn = document.getElementById('theme-toggle');

    themeToggleBtn.addEventListener('click', function() {

        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }

        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
        
    });
</script>


<script>
function openModalDetail(movie) {
    const modal = document.getElementById('detailMovieModal');
    const title = document.getElementById('detailTitle');
    const synopsis = document.getElementById('detailSynopsis');
    const poster = document.getElementById('detailPoster');
    const year = document.getElementById('detailYear');
    const genre = document.getElementById('detailGenre');
    const available = document.getElementById('detailAvailable');

    title.value = movie.title;
    synopsis.value = movie.synopsis;
    poster.src = movie.poster ? `/${movie.poster}` : '';
    year.value = movie.year;
    genre.value = movie.genre.name;
    available.checked = movie.available;

    document.body.classList.add('overflow-hidden');
    modal.classList.remove('hidden', 'opacity-0', 'scale-95');
    modal.classList.add('opacity-100', 'scale-100');
}

function closeModalDetail() {
    const modal = document.getElementById('detailMovieModal');
    document.body.classList.remove('overflow-hidden');
    modal.classList.remove('opacity-100', 'scale-100');
    modal.classList.add('opacity-0', 'scale-95');
    setTimeout(() => modal.classList.add('hidden'), 300);
}

</script>


</html>