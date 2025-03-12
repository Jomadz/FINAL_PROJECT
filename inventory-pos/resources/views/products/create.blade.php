@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="container">
    <h1 class="my-4">Add New Product</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="product_description">Product Description</label>
                    <textarea class="form-control" id="product_description" name="product_description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="product_image">Product Image</label>
                    <input type="file" class="form-control" id="product_image" name="product_image">
                </div>
                <div class="form-group">
                    <label for="product_category">Product Category</label>
                    <input type="text" class="form-control" id="product_category" name="product_category">
                </div>
                <div class="form-group">
                    <label for="product_brand">Product Brand</label>
                    <input type="text" class="form-control" id="product_brand" name="product_brand">
                </div>
                <div class="form-group">
                    <label for="product_sku">Product SKU</label>
                    <input type="text" class="form-control" id="product_sku" name="product_sku" required>
                </div>
                <div class="form-group">
                    <label for="barcode">Barcode</label>
                    <input type="text" class="form-control" id="barcode" name="barcode">
                </div>
                <div class="form-group">
                    <label for="unit_of_measure">Unit of Measure</label>
                    <input type="text" class="form-control" id="unit_of_measure" name="unit_of_measure">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="stock_quantity">Stock Quantity</label>
                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="0">
                </div>
                <div class="form-group">
                    <label for="minimum_stock_level">Minimum Stock Level</label>
                    <input type="number" class="form-control" id="minimum_stock_level" name="minimum_stock_level" value="0">
                </div>
                <div class="form-group">
                    <label for="reorder_quantity">Reorder Quantity</label>
                    <input type="number" class="form-control" id="reorder_quantity" name="reorder_quantity" value="0">
                </div>
                <div class="form-group">
                    <label for="cost_price">Cost Price</label>
                    <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price">
                </div>
                <div class="form-group">
                    <label for="selling_price">Selling Price</label>
                    <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price">
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="0">
                </div>
                <div class="form-group">
                    <label for="tax_rate">Tax Rate</label>
                    <input type="number" step="0.01" class="form-control" id="tax_rate" name="tax_rate" value="0">
                </div>
                <div class="form-group">
                    <label for="product_status">Product Status</label>
                    <select class="form-control" id="product_status" name="product_status">
                        <option value="active">Active</option>
                        <option value="discontinued">Discontinued</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>

    <h2 class="mt-5">Existing Products</h2>
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

@section('styles')
<style>
    /* Custom styles for the form and table */
    .form-control {
        border-radius: 0.25rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
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
