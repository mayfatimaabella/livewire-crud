<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

class ProductEdit extends Component
{
    use WithFileUploads;
    
    public Product $product;
    
    #[Validate('required|string|max:50')]
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
    
    public function mount(Product $product)
    {
        $this->product = $product;
        $this->code = $product->code;
        $this->name = $product->name;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->description = $product->description;
    }
    
    public function rules()
    {
        return [
            'code' => 'required|string|max:50|unique:products,code,' . $this->product->id,
            'name' => 'required|string|max:250',
            'quantity' => 'required|integer|min:1|max:10000',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
    
    public function update()
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
            // Delete old image if it exists
            if ($this->product->image_path && Storage::disk('public')->exists($this->product->image_path)) {
                Storage::disk('public')->delete($this->product->image_path);
            }
            
            $path = $this->image->store('products', 'public');
            $data['image_path'] = $path;
        }
        
        $this->product->update($data);
        
        session()->flash('success', 'Product updated successfully.');
        
        return redirect()->route('products.index');
    }
    
    public function render()
    {
        return view('livewire.product-edit')->layout('layouts.app');
    }
}