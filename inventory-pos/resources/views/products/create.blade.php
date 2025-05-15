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
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- Floating Icons CSS -->
    <style>
      .floating-icons {
          position: fixed;
          top: 50%;
          left: 0;
          transform: translateY(-50%);
          display: flex;
          flex-direction: column;
          background-color: rgb(252, 252, 252);
          border-radius: 5px;
          padding: 10px;
          z-index: 1000;
      }

      .floating-icons .icon {
          color: black;
          margin: 10px 0;
          text-align: center;
          font-size: 24px;
          transition: color 0.3s;
      }

      .floating-icons .icon:hover {
          color: rgb(109, 106, 106);
      }

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
      .kaushan-font {
            font-family: 'Kaushan Script', cursive;
        }
    </style>
  </head>
  
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

   <!--This is the header session-->
@include('admin.body.header')
     

      <!--This is the sidebar session-->
  @include('admin.body.sidebar')



 
@yield('admin')






    

   <!--This is the header session-->
   @include('admin.body.footer')

  <div class="app-content">
        <div class="container-fluid">
          @section('content')
          
          <div class="container">

            <h1 class="display-4 fw-bold kaushan-font text-left animated-color">Add Product </h1>
            @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                  <br>

                  <div>
    <label for="category">Select Category</label>
    <select name="product_category" id="category" class="form-control">
        <option value="">-- Choose Category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

 

    <label for="new_category">Add New Category</label>
    <input type="text" name="new_category" class="form-control" placeholder="Type new category">
</div>

<br>

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
        <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="0" min="0" required>
    </div>
    <div class="form-group">
        <label for="minimum_stock_level">Minimum Stock Level</label>
        <input type="number" class="form-control" id="minimum_stock_level" name="minimum_stock_level" value="0" min="0" required>
    </div>
    <div class="form-group">
        <label for="reorder_quantity">Reorder Quantity</label>
        <input type="number" class="form-control" id="reorder_quantity" name="reorder_quantity" value="0" min="0" required>
    </div>
    <div class="form-group">
        <label for="cost_price">Cost Price</label>
        <input type="number" step="0.01" class="form-control" id="cost_price" name="cost_price" min="0" required>
    </div>
    <div class="form-group">
        <label for="selling_price">Selling Price</label>
        <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" min="0" required>
    </div>
    <div class="form-group">
    <label for="expiry_date">Expiry Date</label>
    <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="" min="" required>
</div>

<script>
    // Set the minimum date to today's date
    document.getElementById('expiry_date').setAttribute('min', new Date().toISOString().split('T')[0]);
</script>

    <div class="form-group">
        <label for="discount">Discount</label>
        <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="0" min="0" required>
    </div>
    <div class="form-group">
        <label for="tax_rate">Tax Rate (%)</label>
        <input type="number" step="0.01" class="form-control" id="tax_rate" name="tax_rate" value="0" min="0" required>
    </div>
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
              <button type="submit" class="btn btn-primary mb-3">Add Product</button>
              
              <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">All Products</a>
            </form>

            
          </div>


  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/js/adminlte.min.js" crossorigin="anonymous"></script>
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function () {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script>
  <script>
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