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
                $backgroundImage = asset('storage/' . $product->product_image);
            @endphp
            
            <div class="col-md-3 mb-3">
                <div class="card product-card d-flex flex-column justify-content-between text-center p-2"
                     style="
                        cursor: pointer;
                        height: 120px;
                        position: relative;
                        background-image: url('{{ $backgroundImage }}');
                        background-size: cover;
                        background-position: center;
                        background-repeat: no-repeat;
                        overflow: hidden;
                        color: #000;
                    "
                     onclick='addToCart({{ $jsProduct }})'>
                     
                    <!-- Overlay to fade background -->
                    <div style="
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(255, 255, 255, 0.8);
                        z-index: 1;
                    "></div>

                    <!-- Foreground content -->
                    <div class="position-relative" style="z-index: 2;">

                        <!-- Product Name -->
                        <h6 class="mb-1" style="font-size: 16px; font-weight: bold;">
                            {{ $product->product_name }}
                        </h6>

                        <!-- Centered Image -->
                        @if ($product->product_image)
                            <div class="d-flex justify-content-center align-items-center" style="flex: 1;">
                                <img src="{{ $backgroundImage }}"
                                     alt="{{ $product->product_name }}"
                                     style="max-width: 60%; max-height: 100px; object-fit: contain;">
                            </div>
                        @endif

                        <!-- Price -->
                        <p class="mb-1" style="font-size: 15px; font-weight: bold;">
                            {{ number_format($product->selling_price) }} TSH
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
