<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="https://logosandtypes.com/wp-content/uploads/2021/02/force.svg" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Flick Tales</title>
</head>
<body class="bg-white dark:bg-gray-900">

<header>
  @include('layouts.header')
</header>


<main class="min-h-screen mx-auto mt-8">
    @yield('content')
</main>

<footer class="bg-white dark:bg-gray-900 w-full border-t border-gray-200 dark:border-gray-600">
  @include('layouts.footer')
</footer>

</body>

<script>
function openModal() {
    const modal = document.getElementById('createMovieModal');
    document.body.classList.add('overflow-hidden');
    modal.classList.remove('hidden', 'opacity-0', 'scale-95');
    modal.classList.add('opacity-100', 'scale-100');
}

function closeModal() {
    const modal = document.getElementById('createMovieModal');
    document.body.classList.remove('overflow-hidden');
    modal.classList.remove('opacity-100', 'scale-100');
    modal.classList.add('opacity-0', 'scale-95');
    setTimeout(() => modal.classList.add('hidden'), 300);
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
              timer: 1000,
                showConfirmButton: false,
                willClose: () => {
                    closeModal();
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
  });
</script>



</html>