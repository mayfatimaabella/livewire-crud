<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductShow extends Component
{
    public Product $product;
    
    public function mount(Product $product)
    {
        $this->product = $product;
    }
    
    public function render()
    {
        return view('livewire.product-show')->layout('layouts.app');
    }
}