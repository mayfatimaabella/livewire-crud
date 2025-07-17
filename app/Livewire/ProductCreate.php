<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class ProductCreate extends Component
{
    use WithFileUploads;
    
    #[Validate('required|string|max:50|unique:products,code')]
    public $code = '';
    
    #[Validate('required|string|max:250')]
    public $name = '';
    
    #[Validate('required|integer|min:1|max:10000')]
    public $quantity = '';
    
    #[Validate('required|numeric|min:0')]
    public $price = '';
    
    #[Validate('nullable|string')]
    public $description = '';
    
    #[Validate('nullable|image|mimes:jpeg,png,jpg,gif|max:2048')]
    public $image;
    
    public function save()
    {
        $this->validate();
        
        $data = [
            'code' => $this->code,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'description' => $this->description,
        ];
        
        if ($this->image) {
            $path = $this->image->store('products', 'public');
            $data['image_path'] = $path;
        }
        
        Product::create($data);
        
        session()->flash('success', 'Product created successfully.');
        
        return redirect()->route('products.index');
    }
    
    public function render()
    {
        return view('livewire.product-create');
    }
}