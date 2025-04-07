<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Admin | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />

    <!-- Third Party Plugins -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    
    <!-- Required Plugin (AdminLTE) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.min.css" crossorigin="anonymous" />
    
    <!-- ApexCharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" crossorigin="anonymous" />

    <!-- Floating Icons CSS -->
    <style>
      

      /* Custom Colors */
      .app-sidebar {
          background-color: #001f3f !important; /* Dark Navy Blue */
      }

      .app-sidebar .nav-link {
          color: white; /* White text for sidebar links */
      }

      .app-sidebar .nav-link:hover {
          background-color: #003366; /* Darker shade on hover */
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
    </style>
</head>

<body>
    <!-- Header Section (Positioned at the top) -->
    @include('admin.body.header')

    <div class="app-wrapper">
        <!-- Main Content Section -->
        <div class="container mt-4">
            <h1>Point of Sale (POS)</h1>

            <!-- POS System Layout: Row with 3 Columns (Cart, Calculator, Actions) -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Left: Cart -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Cart</div>
                            <div class="card-body" id="cart-items">
                                <ul class="list-group" id="cart-list"></ul>
                                <hr>
                                <strong>Total: <span id="cart-total">0 TSH</span></strong>
                            </div>
                        </div>
                    </div>

                    <!-- Middle: Calculator -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Calculator</div>
                            <div class="card-body text-center">
                                <div class="row g-2">
                                    @for($i = 1; $i <= 9; $i++)
                                        <div class="col-4">
                                            <button class="btn btn-success w-100" onclick="addNumber('{{ $i }}')">{{ $i }}</button>
                                        </div>
                                    @endfor
                                    <div class="col-4"><button class="btn btn-success w-100" onclick="addNumber('0')">0</button></div>
                                    <div class="col-4"><button class="btn btn-warning w-100" onclick="clearInput()">C</button></div>
                                    <div class="col-4"><button class="btn btn-danger w-100" onclick="deleteLast()">&#x232B;</button></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Actions -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Actions</div>
                            <div class="card-body d-grid gap-2">
                                <button class="btn btn-primary" onclick="submitSale()">Place Order</button>
                                <button class="btn btn-secondary">Payment</button>
                                <button class="btn btn-info">Discount</button>
                                <button class="btn btn-dark">Print Receipt</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom: Categories and Products -->
                <div class="container mt-4">
    <h2>Categories</h2>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-3 mb-3">
            <div class="card category-card" style="cursor: pointer;" onclick="fetchProducts({{ $category->id }})">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $category->name }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h2>Products</h2>
    <div id="product-container" class="row">
    
        <!-- Products will be displayed here -->
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Section (Positioned at the bottom) -->
        @include('admin.body.footer')
    </div>

    <!-- Include your scripts here -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/js/adminlte.min.js" crossorigin="anonymous"></script>


    <style>
   .category-card {
        transition: background-color 0.3s ease;
        height: 150px; /* Set a fixed height for the cards */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        cursor: pointer;
    }

    .category-card:hover {
        background-color:rgb(179, 179, 179); /* Change to your desired hover color */
    }

    .category-card.active {
        background-color:rgb(4, 22, 42); /* Change to your desired active color */
        color: white; /* Change text color for better contrast */
    }

    .product-card {
        transition: background-color 0.3s ease;
        height: 150px; /* Set a fixed height for the cards */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .product-card:hover {
        background-color: #f0f0f0; /* Change to your desired hover color */
    }

    .product-card.active {
        background-color:rgb(4, 22, 42); /* Change to your desired active color */
        color: white; /* Change text color for better contrast */
    }
</style>
    <script>
    function fetchProducts(categoryId) {
        fetch(`/pos/category/${categoryId}/products`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('product-container').innerHTML = html;
        })
        .catch(error => console.error('Error fetching products:', error));
}
            
    
    // Optional: Add click event to product cards to change color
    document.addEventListener('click', function(event) {
        if (event.target.closest('.product-card')) {
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => card.classList.remove('active')); // Remove active class from all
            event.target.closest('.product-card').classList.add('active'); // Add active class to clicked card
        }
    });
    document.querySelectorAll('.category-card').forEach(card => {
    card.classList.remove('active');
});
event.target.closest('.category-card').classList.add('active');


</script>



    <script>
        let currentInput = '';
        let cart = [];
        let total = 0;

        function addNumber(num) {
            currentInput += num;
            console.log("Current Input: ", currentInput);
        }

        function clearInput() {
            currentInput = '';
            console.log("Input Cleared");
        }

        function deleteLast() {
            currentInput = currentInput.slice(0, -1);
            console.log("Last digit deleted");
        }

        function submitSale() {
            // Logic to submit the sale
            alert("Sale submitted! Total: " + total + " TSH");
            // Reset cart and total after submission
            cart = [];
            total = 0;
            document.getElementById('cart-list').innerHTML = '';
            document.getElementById('cart-total').innerText = '0 TSH';
        }

        function addToCart(productId, productName, productPrice) {
            cart.push({ id: productId, name: productName, price: productPrice });
            total += productPrice;
            document.getElementById('cart-list').innerHTML += `<li class="list-group-item">${productName} - ${productPrice} TSH</li>`;
            document.getElementById('cart-total').innerText = `${total} TSH`;
            console.log("Product added to cart: ", productName);
        }

        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.querySelector('.app-sidebar');
            const toggleButton = document.querySelector('[data-lte-toggle="sidebar"]');

            toggleButton.addEventListener('click', function () {
                sidebar.classList.toggle('closed');
            });
        });
    </script>
</body>
</html>