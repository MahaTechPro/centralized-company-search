<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $title ?? 'Centralized Company Search' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
  <nav class="bg-white border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
      <a href="{{ route('search.index') }}" class="text-xl font-semibold flex items-center gap-2">
        <!-- Search Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>
        </svg>
        Centralized Search
      </a>
      <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">
        <!-- Cart Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007 17h12a1 1 0 00.95-.68L21 13M7 13V6h13" />
        </svg>
        <span>Cart</span>
      </a>
    </div>
  </nav>

  <main class="max-w-6xl mx-auto px-4 py-6">
    @if (session('ok'))
      <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 flex items-center gap-2">
        <!-- Success Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        {{ session('ok') }}
      </div>
    @endif
    {{ $slot }}
  </main>

  <footer class="max-w-6xl mx-auto px-4 py-10 text-sm text-gray-500 flex items-center gap-2">
    <!-- Footer Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3-1.343-3-3S10.343 2 12 2s3 1.343 3 3-1.343 3-3 3zm0 4c-4.418 0-8 1.79-8 4v6h16v-6c0-2.21-3.582-4-8-4z"/>
    </svg>
    <p>&copy; {{ date('Y') }} Centralized Company Search</p>
  </footer>
</body>
</html>
