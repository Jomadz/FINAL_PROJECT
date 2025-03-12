@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sellers</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/scripts.js') }}" defer></script>
</head>
<body>
    
    <div class="container">
        <h1>Create a New Seller</h1>

        <form action="{{ route('admin.create-seller') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <div>
                <button type="submit" class="btn">Create Seller</button>
            </div>
        </form>

        <h2>Manage Sellers</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sellers as $seller)
                    <tr>
                        <td>{{ $seller->name }}</td>
                        <td>{{ $seller->email }}</td>
                        <td>
                            <a href="{{ route('admin.update-seller', $seller->id) }}" class="btn">Edit</a>
                            <form action="{{ route('admin.update-seller', $seller->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>

    
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.btn {
    background-color: #5cb85c;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn:hover {
    background-color: #4cae4c;
}

.footer {
    margin-top: 20px;
    text-align: center;
    color: #777;
}
</style>
<script>
    // Function to confirm deletion
function confirmDelete(sellerId) {
    const confirmation = confirm("Are you sure you want to delete this seller?");
    if (confirmation) {
        document.getElementById(`delete-seller-${sellerId}`).submit();
    }
}

// Example function to show edit form
function editSeller(sellerId) {
    // Fetch user details via AJAX or show a modal for editing
    // This is a placeholder for the actual implementation
    alert(`Edit functionality for seller ID: ${sellerId}`);
}
</script>

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
