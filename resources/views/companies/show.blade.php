@php($title = $company['name'].' — '.$company['country'])
<x-layouts.app :title="$title">
  <section class="space-y-6">
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-semibold">{{ $company['name'] }}</h1>
          <div class="text-sm text-gray-600 mt-1 flex gap-2">
            <span class="inline-flex items-center px-2 py-0.5 rounded-full border text-xs {{ $company['country']==='SG' ? 'border-blue-300' : 'border-amber-300' }}">{{ $company['country'] }}</span>
            @if(!empty($company['brand_name']))<span>Brand: {{ $company['brand_name'] }}</span>@endif
            @if(!empty($company['state']))<span>State: {{ $company['state'] }}</span>@endif
          </div>
          @if(!empty($company['address']))
            <div class="text-sm text-gray-500 mt-1">{{ $company['address'] }}</div>
          @endif
        </div>
        <a href="{{ route('cart.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100">View Cart</a>
      </div>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
      <h2 class="text-lg font-semibold mb-3">Available Reports</h2>

      @if (count($reports) === 0)
        <p class="text-gray-500">No reports available.</p>
      @else
        <ul class="divide-y divide-gray-200">
          @foreach ($reports as $rep)
            <li class="py-3 flex items-center justify-between">
              <div>
                <div class="font-medium">{{ $rep['name'] }}</div>
                <div class="text-sm text-gray-500">{{ $rep['info'] }}</div>
                <div class="mt-1 font-semibold">Price: {{ number_format($rep['price'], 2) }}</div>
              </div>
              <form action="{{ route('cart.add') }}" method="POST" class="flex">
                @csrf
                <input type="hidden" name="company_name" value="{{ $company['name'] }}" />
                <input type="hidden" name="company_slug" value="{{ $company['slug'] }}" />
                <input type="hidden" name="country" value="{{ $rep['country'] }}" />
                <input type="hidden" name="report_id" value="{{ $rep['id'] }}" />
                <input type="hidden" name="report_name" value="{{ $rep['name'] }}" />
                <input type="hidden" name="price" value="{{ $rep['price'] }}" />
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Add to Cart</button>
              </form>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </section>
</x-layouts.app>
