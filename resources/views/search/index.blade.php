@php($title = 'Search')
<x-layouts.app :title="$title">
  <section class="space-y-6">
    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 transition hover:shadow-lg">
      <form action="{{ route('search.index') }}" method="GET" class="flex gap-2 animate-fade-in">
        <input type="text" name="q" value="{{ $q }}" placeholder="Search companies by name..."
               class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
        <button class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow hover:shadow-md transition">
          <i class="fas fa-search mr-1"></i> Search
        </button>
      </form>
      <p class="text-sm text-gray-500 mt-2">Searches both Singapore (SG) and Mexico (MX) databases.</p>
    </div>

    @if (!empty($q))
      <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 animate-slide-up">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
          <i class="fas fa-list text-blue-500"></i>
          Results for: <span class="font-normal">{{ $q }}</span>
        </h2>

        @if (count($results) === 0)
          <div class="text-gray-500 py-6 text-center animate-fade-in">
            <i class="fas fa-search-minus text-3xl mb-2 text-gray-400"></i>
            <p>No results found.</p>
          </div>
        @else
          <ul class="divide-y divide-gray-200">
            @foreach ($results as $r)
              <li class="py-4 flex items-center justify-between hover:bg-gray-50 px-2 rounded-lg transition transform hover:scale-[1.01]">
                <div class="animate-fade-in">
                  <div class="font-medium text-gray-800">{{ $r['name'] }}</div>
                  <div class="text-sm text-gray-500 flex gap-2 mt-1">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full border text-xs 
                      {{ $r['country']==='SG' ? 'border-blue-300 text-blue-600 bg-blue-50' : 'border-amber-300 text-amber-600 bg-amber-50' }}">
                      {{ $r['country'] }}
                    </span>
                    @if(!empty($r['brand_name']))<span>{{ $r['brand_name'] }}</span>@endif
                    @if(!empty($r['address']))<span>• {{ $r['address'] }}</span>@endif
                  </div>
                </div>
                <a href="{{ $r['url'] }}" class="text-blue-600 hover:underline flex items-center gap-1">
                  <i class="fas fa-arrow-right"></i> View
                </a>
              </li>
            @endforeach
          </ul>
        @endif
      </div>
    @endif
  </section>
</x-layouts.app>
