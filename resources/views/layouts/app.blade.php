<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $title ?? 'Centralized Company Search' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BHi1n6jI+9T9a7jQwS0s5l5c5wK5wTt8r3V1W0UjC4jFjVfZaxX1hvfVhZxF4oHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-50 text-gray-900">

  <nav class="bg-white border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
      <a href="{{ route('search.index') }}" class="text-xl font-semibold flex items-center gap-2">
        <i class="fa-solid fa-magnifying-glass text-blue-600"></i>
        Centralized Search
      </a>
      <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">
        <i class="fa-solid fa-cart-shopping text-gray-600"></i>
        <span>Cart</span>
      </a>
    </div>
  </nav>

  <main class="max-w-6xl mx-auto px-4 py-6">
    @if (session('ok'))
      <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 flex items-center gap-2">
        <i class="fa-solid fa-circle-check text-green-600"></i>
        {{ session('ok') }}
      </div>
    @endif
    {{ $slot }}
  </main>

  <footer class="max-w-6xl mx-auto px-4 py-10 text-sm text-gray-500 flex items-center gap-2">
    <i class="fa-solid fa-building text-gray-500"></i>
    <p>&copy; {{ date('Y') }} Centralized Company Search</p>
  </footer>

</body>

</html>
