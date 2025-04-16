@if($products->isEmpty()) 
    <p>No products found for this category.</p>
@else
    <div class="row">
        @foreach ($products as $product)
            @php
                $jsProduct = json_encode([
                    'name' => $product->product_name,
                    'product_id' => $product->id,
                    'price' => $product->selling_price,
                    'discount' => $product->discount ?? 0,
                    'tax' => $product->tax_rate ?? 0,
                ]);
            @endphp
            
            <div class="col-md-3 mb-3">
                <div class="card product-card">
                    @if ($product->product_image)
                        <img src="{{ asset('storage/' . $product->product_image) }}" class="card-img-top" alt="{{ $product->product_name }}"style="width: 30%; height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->product_name }}</h5><br>
                      
                        <p class="card-text">Price: {{ number_format($product->selling_price) }} TSH</p>
                        <button class="btn btn-secondary"
                                onclick='addToCart({{ $jsProduct }})'>
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
