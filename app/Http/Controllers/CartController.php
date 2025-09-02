<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index(Request $request, CartService $cart)
    {
        return view('cart.index', [
            'items' => $cart->items(),
            'total' => $cart->total(),
        ]);
    }

    public function add(Request $request, CartService $cart)
    {
        $data = $request->validate([
            'company_name' => 'required|string',
            'company_slug' => 'required|string',
            'country' => 'required|in:SG,MX',
            'report_id' => 'required|integer',
            'report_name' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        $cart->add($data);
        return redirect()->route('cart.index')->with('ok', 'Report added to cart.');
    }

    public function remove(Request $request, CartService $cart)
    {
        $request->validate([
            'key' => 'required|string'
        ]);
        $cart->remove($request->get('key'));
        return redirect()->route('cart.index')->with('ok', 'Item removed.');
    }

    public function clear(Request $request, CartService $cart)
    {
        $cart->clear();
        return redirect()->route('cart.index')->with('ok', 'Cart cleared.');
    }
}
