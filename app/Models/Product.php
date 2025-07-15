<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code',
        'name',
        'quantity',
        'price',
        'description',
        'image_path'
    ];
    
    /**
     * Get the URL for the product image
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image_path) {
            return Storage::url($this->image_path);
        }
        
        return null;
    }
    
    /**
     * Check if the product has an image
     */
    public function hasImage(): bool
    {
        return !empty($this->image_path) && Storage::disk('public')->exists($this->image_path);
    }
}
