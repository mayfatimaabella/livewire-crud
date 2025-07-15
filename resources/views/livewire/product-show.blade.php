<div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">Product Information</div>
                    <div class="float-end">
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-md-4 col-form-label text-md-end text-start"><strong>Code:</strong></label>
                        <div class="col-md-6" style="line-height:35px;"> 
                            {{ $product->code }}
                        </div>
                    </div>
                    
                    <div class="row">
                        <label class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-md-6" style="line-height:35px;">
                            {{ $product->name }}
                        </div>
                    </div>
                    
                    <div class="row">
                        <label class="col-md-4 col-form-label text-md-end text-start"><strong>Quantity:</strong></label>
                        <div class="col-md-6" style="line-height:35px;">
                            {{ $product->quantity }}
                        </div>
                    </div>
                    
                    <div class="row">
                        <label class="col-md-4 col-form-label text-md-end text-start"><strong>Price:</strong></label>
                        <div class="col-md-6" style="line-height:35px;">
                            ${{ number_format($product->price, 2) }}
                        </div>
                    </div>
                    
                    <div class="row">
                        <label class="col-md-4 col-form-label text-md-end text-start"><strong>Description:</strong></label>
                        <div class="col-md-6" style="line-height:35px;">
                            {{ $product->description ?: 'No description' }}
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-md-4 col-form-label text-md-end"><strong>Image:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" 
                                     alt="{{ $product->name }}" 
                                     style="max-width:200px; height:auto;" 
                                     class="img-thumbnail">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>