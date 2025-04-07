@if($products->isEmpty())
    <p>No products found for this category.</p>
@else
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-3">
                <div class="card product-card">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->product_name }}</h5> <!-- Directly access product_name -->
                        <p class="card-text">Price: {{ $product->selling_price }} TSH</p> <!-- Directly access selling_price -->
                        <button class="btn btn-primary" onclick="addToCart({{ $product->id }}, '{{ $product->product_name }}', {{ $product->selling_price }})">Add to Cart</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif