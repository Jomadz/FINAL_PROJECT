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



<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">📊 Product Overview Dashboard</h1>
    <form method="GET" action="{{ route('product.overview') }}" class="mb-6 flex flex-wrap gap-4 items-end">
    <div>
        <label for="start_date" class="block font-medium">Start Date</label>
        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="border p-2 rounded">
    </div>
    <div>
        <label for="end_date" class="block font-medium">End Date</label>
        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="border p-2 rounded">
    </div>
    <div>
    <label for="category" class="block font-medium">Category</label>
<select name="category" id="category" class="border p-2 rounded">
    <option value="">All Categories</option>
    @foreach ($categories as $id => $name)
        <option value="{{ $id }}" @selected($id == request('category'))>{{ $name }}</option>
    @endforeach
</select>

    </div>
    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
    </div>
</form>

    {{-- Top 3 Most Sold Products --}}
    <div class="mb-10">
        <h2 class="text-xl font-semibold mb-2">Top 3 Most Sold Products</h2>
        <div id="topProductsChart"></div>
    </div>

    {{-- Least Sold Products (Pie) --}}
    <div class="mb-10">
        <h2 class="text-xl font-semibold mb-2">Least Sold Products</h2>
        <div id="leastProductsChart"></div>
    </div>

    {{-- Sales Trends Over Time --}}
    <div class="mb-10">
        <h2 class="text-xl font-semibold mb-2">Sales Trends Over Time</h2>
        <div id="salesTrendsChart"></div>
    </div>

    {{-- Stock Levels by Category --}}
    <div class="mb-10">
        <h2 class="text-xl font-semibold mb-2">Stock Levels by Category</h2>
        <div id="stockByCategoryChart"></div>
    </div>

    {{-- Reorder Points Table --}}
    <div class="mb-10">
        <h2 class="text-xl font-semibold mb-2">Reorder Points</h2>
        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Product</th>
                    <th class="border p-2">Stock Level</th>
                    <th class="border p-2">Reorder Point</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reorderData as $product)
                    <tr>
                    <td class="border p-2">{{ $product->product_name }}</td>
                     <td class="border p-2">{{ $product->stock_quantity}}</td>
                     <td class="border p-2">{{ $product->minimum_stock_level}}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Expiring Products Table --}}
<div class="mb-10">
    <h2 class="text-xl font-semibold mb-2 text-red-600">⚠️ Products Expiring Within a Month</h2>
    @if($expiringProducts->isEmpty())
        <p class="text-gray-500">No products expiring within the next 30 days.</p>
    @else
        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-red-100">
                    <th class="border p-2">Product Name</th>
                    <th class="border p-2">Category</th>
                    <th class="border p-2">Expiry Date</th>
                    <th class="border p-2">Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expiringProducts as $product)
                    <tr class="bg-white">
                        <td class="border p-2">{{ $product->product_name }}</td>
                        <td class="border p-2">{{ $product->category->name }}</td>
                        <td class="border p-2 text-red-500 font-semibold">{{ \Carbon\Carbon::parse($product->expiry_date)->format('Y-m-d') }}</td>
                        <td class="border p-2">{{ $product->stock_quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

    {{-- Sales by Category --}}
    <div class="mb-10">
        <h2 class="text-xl font-semibold mb-2">Sales by Category</h2>
        <div id="salesByCategoryChart"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Top 3 Most Sold Products
    var topProductsChart = new ApexCharts(document.querySelector("#topProductsChart"), {
        chart: { type: 'bar', 
            height: 250,
        width: '50%' 
        },
        series: [{
            name: 'Units Sold',
            data: @json($topProducts->pluck('total_sold'))
        }],
        xaxis: {
            categories: @json($topProducts->pluck('product_name'))
        }
    });
    topProductsChart.render();

    // Least Sold Products
    var leastProductsChart = new ApexCharts(document.querySelector("#leastProductsChart"), {
        chart: { type: 'bar', 
            height: 250, 
        width: '50%' 
        },
        series: [{
        name: 'Units Sold',
        data: @json($leastProducts->pluck('total_sold'))
    }],
    xaxis: {
        categories: @json($leastProducts->pluck('product_name'))
    }
    });
    leastProductsChart.render();

    // Sales Trends Line Chart
    var salesTrendsChart = new ApexCharts(document.querySelector("#salesTrendsChart"), {
        chart: { type: 'line', 
             height: 250, 
        width: '50%'
        },
        series: [{
            name: 'Sales',
            data: @json($salesTrends->pluck('total_sales'))
        }],
        xaxis: {
            categories: @json($salesTrends->pluck('date'))
        }
    });
    salesTrendsChart.render();

    // Stock Levels by Category (Stacked Bar)
    var stockByCategoryData = @json($stockByCategory);
    var stockCategories = Object.keys(stockByCategoryData);
    var stockSeries = stockCategories.map(category => {
        return {
            name: category,
            data: stockByCategoryData[category].map(item => item.stock_quantity)
        }
    });
    var stockNames = stockCategories.flatMap(category =>
        stockByCategoryData[category].map(item => item.product_name)
    );

    var stockChart = new ApexCharts(document.querySelector("#stockByCategoryChart"), {
        chart: { type: 'bar',  
            height: 250, 
            width: '50%',
            stacked: true },
        series: stockSeries,
        xaxis: { categories: stockNames }
    });
    stockChart.render();

    // Sales by Category
    var salesByCategoryChart = new ApexCharts(document.querySelector("#salesByCategoryChart"), {
        chart: { type: 'bar',
             height: 250, 
        width: '50%'
         },
        series: [{
            name: 'Sales',
            data: @json($salesByCategory->pluck('total_sales'))
        }],
        xaxis: {
            categories: @json($salesByCategory->pluck('category_name'))
        }
    });
    salesByCategoryChart.render();
</script>

<!-- Scripts -->

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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