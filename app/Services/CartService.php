<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $key = 'cart.items';

    public function items(): array
    {
        return Session::get($this->key, []);
    }

    public function add(array $data): void
    {
        $items = $this->items();
        // unique key: country|slug|report_id|timestamp
        $key = $data['country'].'|'.$data['company_slug'].'|'.$data['report_id'].'|'.uniqid();
        $items[$key] = [
            'key' => $key,
            'company_name' => $data['company_name'],
            'company_slug' => $data['company_slug'],
            'country' => $data['country'],
            'report_id' => (int)$data['report_id'],
            'report_name' => $data['report_name'],
            'price' => (float)$data['price'],
        ];
        Session::put($this->key, $items);
    }

    public function remove(string $key): void
    {
        $items = $this->items();
        if (isset($items[$key])) {
            unset($items[$key]);
            Session::put($this->key, $items);
        }
    }

    public function clear(): void
    {
        Session::forget($this->key);
    }

    public function total(): float
    {
        return array_reduce($this->items(), function($carry, $item){
            return $carry + (float)$item['price'];
        }, 0.0);
    }
}
