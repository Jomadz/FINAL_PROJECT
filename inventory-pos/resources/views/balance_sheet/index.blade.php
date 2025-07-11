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
        .brand-text {
    font-family: 'Fredoka', sans-serif;
    font-weight: 600  !important; /* You can adjust: 300 to 700 */
    font-size: 18px;   /* Optional: tweak for logo size */
    color: #ff6f61 !important;      /* Optional: update based on your branding */
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
    <h2 class="display-4 fw-bold kaushan-font text-center animated-color mb-4">Balance Sheet</h2>

    <form method="GET" action="{{ route('balance-sheet.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <label for="date">Filter by Date:</label>
                <input type="date" name="date" id="date" value="{{ request('date') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="month">Filter by Month:</label>
                <input type="month" name="month" id="month" value="{{ request('month') }}" class="form-control">
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" class="btn btn-primary">Apply Filter</button>
                <a href="{{ route('balance-sheet.index') }}" class="btn btn-secondary">Clear</a>
            </div>
        </div>
    </form>

    <div class="card p-4 mb-4">
        <h4>Assets</h4>
        <p>Inventory Value: <strong>{{ number_format($inventoryValue, 2) }} Tsh</strong></p>
        <p>Total Sales: <strong>{{ number_format($totalSales, 2) }} Tsh</strong></p>
        <hr>
        <p><strong>Total Assets: {{ number_format($assets, 2) }} Tsh</strong></p>
    </div>

    <div class="card p-4 mb-4">
        <h4>Liabilities</h4>
        @if(Auth::user()->role === 'admin')
        <p>Total Purchases: <strong>{{ number_format($totalPurchases, 2) }} Tsh</strong></p>
        @endif
        <p>Total Expenses: <strong>{{ number_format($totalExpenses, 2) }} Tsh</strong></p>
        <hr>
        <p><strong>Total Liabilities: {{ number_format($liabilities, 2) }} Tsh</strong></p>
    </div>

    <div class="card p-4">
        <h4>Equity</h4>
        <p><strong>{{ number_format($equity, 2) }} Tsh</strong></p>
    </div>
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