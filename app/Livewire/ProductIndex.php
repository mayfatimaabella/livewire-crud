<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class ProductIndex extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public function delete($productId)
    {
        $product = Product::findOrFail($productId);
        
        // Delete associated image file
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }
        
        $product->delete();
        
        session()->flash('success', 'Product deleted successfully.');
    }
    
    public function render()
    {
        return view('livewire.product-index', [
            'products' => Product::latest()->paginate(4)
        ])->layout('layouts.app');
    }
}