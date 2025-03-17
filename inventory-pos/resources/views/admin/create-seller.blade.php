<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Seller</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(255, 255, 255);
            margin: 0;
            padding: 0;
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

        .btn-primary {
            background-color: #001f3f; /* Dark Navy */
            border-color: #001f3f; /* Dark Navy */
            color: white; /* White text for button */
        }

        .btn-primary:hover {
            background-color: #001a33; /* Darker Navy for hover */
            border-color: #001a33; /* Darker Navy for hover */
        }

        .btn-danger {
            background-color: #4b4b4b; /* Dark Grey */
            border-color: #4b4b4b; /* Dark Grey */
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
        <h1>Create a New Seller</h1>

        <form action="{{ route('admin.store-seller') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required class="form-control">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control">
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Create Seller</button>
                <a href="{{ route('admin.sellers') }}" class="btn btn-danger">Cancel</a>
                <a href="{{ route('admin.all-sellers') }}" class="btn btn-secondary float-right ">All sellers</a>
            </div>
        </form>

        
    </div>
</body>
</html>