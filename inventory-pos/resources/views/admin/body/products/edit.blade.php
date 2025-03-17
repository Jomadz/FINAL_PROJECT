<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-control {
            border-radius: 0.25rem;
        }

        .btn-primary {
            background-color: #001f3f; /* Dark Navy for Save */
            border-color: #001f3f; /* Dark Navy for Save */
            color: white; /* White text for button */
        }

        .btn-primary:hover {
            background-color: #001a33; /* Darker Navy for hover */
            border-color: #001a33; /* Darker Navy for hover */
        }

        .btn-danger {
            background-color: #4b4b4b; /* Dark Grey for Delete */
            border-color: #4b4b4b; /* Dark Grey for Delete */
            color: white; /* White text for delete button */
        }

        .btn-danger:hover {
            background-color: #3d3d3d; /* Darker Grey for hover */
            border-color: #3d3d3d; /* Darker Grey for hover */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Product</h1>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT method for updating -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="product_description">Product Description</label>
                        <textarea class="form-control" id="product_description" name="product_description" rows="3">{{ $product->product_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" class="form-control" id="product_image" name="product_image">
                    </div>
                    <div class="form-group">
                        <label for="product_category">Product Category</label>
                        <input type="text" class="form-control" id="product_category" name="product_category" value="{{ $product->product_category }}">
                    </div>
                    <div class="form-group">
                        <label for="product_brand">Product Brand</label>
                        <input type="text" class="form-control" id="product_brand" name="product_brand" value="{{ $product->product_brand }}">
                    </div>
                    <div class="form-group">
                        <label for="product_sku">Product SKU</label>
                        <input type="text" class="form-control" id="product_sku" name="product_sku" value="{{ $product->product_sku }}" required>
                    </div>
                    <div class="form-group">
                        <label for="barcode">Barcode</label>
                        <input type="text" class="form-control" id="barcode" name="barcode" value="{{ $product->barcode }}">
                    </div>
                    <div class="form-group">
                        <label for="unit_of_measure">Unit of Measure</label>
                        <input type="text" class="form-control" id="unit_of_measure" name="unit_of_measure" value="{{ $product->unit_of_measure }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stock_quantity">Stock Quantity</label>
                        <input type="number" class="form-control" id="stock_quantity
                                                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ $product->stock_quantity }}" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="minimum_stock_level">Minimum Stock Level</label>
                        <input type="number" class="form-control" id="minimum_stock_level" name="minimum_stock_level" value="{{ $product->minimum_stock_level }}" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="reorder_quantity">Reorder Quantity</label>
                        <input type="number" class="form-control" id="reorder_quantity" name="reorder_quantity" value="{{ $product->reorder_quantity }}" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="cost_price">Cost Price</label>
                        <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price" value="{{ $product->cost_price }}" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="selling_price">Selling Price</label>
                        <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" value="{{ $product->selling_price }}" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="{{ $product->discount }}" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="tax_rate">Tax Rate (%)</label>
                        <input type="number" step="0.01" class="form-control" id="tax_rate" name="tax_rate" value="{{ $product->tax_rate }}" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="product_status">Product Status</label>
                        <select class="form-control" id="product_status" name="product_status">
                            <option value="active" {{ $product->product_status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="discontinued" {{ $product->product_status == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                            <option value="out_of_stock" {{ $product->product_status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
        </form>
    </div>
</body>
</html>