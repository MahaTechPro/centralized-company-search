@php($title = 'Cart')
<x-layouts.app :title="$title">
  <section class="space-y-6">
    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
      <h1 class="text-2xl font-bold mb-5 flex items-center gap-2 text-gray-800">
        <i class="fas fa-shopping-cart text-blue-600"></i> Your Cart
      </h1>

      @if (count($items) === 0)
        <div class="flex flex-col items-center py-10 text-gray-500">
          <i class="fas fa-box-open text-4xl mb-3"></i>
          <p class="text-lg">Your cart is empty</p>
        </div>
      @else
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm border rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
              <tr>
                <th class="py-3 px-4 text-left">Company</th>
                <th class="py-3 px-4 text-left">Country</th>
                <th class="py-3 px-4 text-left">Report</th>
                <th class="py-3 px-4 text-left">Price</th>
                <th class="py-3 px-4 text-center">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              @foreach ($items as $it)
                <tr class="hover:bg-gray-50 transition">
                  <td class="py-3 px-4 font-medium text-gray-800">{{ $it['company_name'] }}</td>
                  <td class="py-3 px-4">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold 
                      {{ $it['country']==='SG' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700' }}">
                      {{ $it['country'] }}
                    </span>
                  </td>
                  <td class="py-3 px-4">{{ $it['report_name'] }}</td>
                  <td class="py-3 px-4 font-semibold text-gray-900">${{ number_format($it['price'], 2) }}</td>
                  <td class="py-3 px-4 text-center">
                    <form action="{{ route('cart.remove') }}" method="POST">
                      @csrf
                      <input type="hidden" name="key" value="{{ $it['key'] }}"/>
                      <button class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                        <i class="fas fa-trash"></i> Remove
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Cart summary -->
        <div class="mt-6 p-4 bg-gray-50 rounded-xl flex flex-col sm:flex-row items-center justify-between gap-4">
          <div class="text-lg font-semibold text-gray-800">
            <i class="fas fa-coins text-yellow-500"></i>
            Total: <span class="text-blue-600">${{ number_format($total, 2) }}</span>
          </div>
          <div class="flex gap-3">
            <form action="{{ route('cart.clear') }}" method="POST">
              @csrf
              <button class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                <i class="fas fa-trash-alt"></i> Clear Cart
              </button>
            </form>
          </div>
        </div>
      @endif
    </div>
  </section>
</x-layouts.app>
