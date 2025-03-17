
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-control {
            border-radius: 0.25rem;
        }

        .btn-primary {
            background-color: #001f3f; /* Dark Navy for Add Product */
            border-color: #001f3f; /* Dark Navy for Add Product */
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

        .table {
            margin-top: 20px;
            border-radius: 0.25rem;
            overflow: hidden;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mt-5">Existing Products</h2>
        
        <!-- Add Product Button -->
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_sku }}</td>
                        <td>
                            <!-- Edit Action -->
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            
                            <!-- Delete Action -->
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>