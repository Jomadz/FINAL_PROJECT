<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Admin | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta name="keywords" content="bootstrap 5, admin dashboard, charts, calendar, tables" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" onerror="this.onerror=null; this.href='https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;700&display=swap';" />

    <!-- Third Party Plugins -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.min.css" crossorigin="anonymous" />
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
            border-color: #3d3d3
                        /* Darker Grey for hover */
        }

/* Additional styles for table and other elements can be added here */
</style>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">
<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button" aria-label="Toggle Sidebar">
                    <i class="bi bi-list"></i>
                </a>
            </li>

            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button" aria-label="Search">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen" aria-label="Toggle Fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <img src="{{ asset('images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">Admin</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('pos.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-cart"></i>
                        <p>POS</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>Product <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('products.create') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Manage Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Product Overview</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-cart-check-fill"></i>
                        <p>Sales</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-cart-plus-fill"></i>
                        <p>Purchases</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-cash-coin"></i>
                        <p>Expenses</p>
                    </a>
                </li>

                @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Sellers <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.create-seller') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Register Seller</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Seller Activities</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-graph-up"></i>
                        <p>Revenue</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-bar-chart-line-fill"></i>
                        <p>Charts</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-shop"></i>
                        <p>Chain Stores</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<div class="floating-icons">
    <a href="{{ route('pos.index') }}" class="icon" aria-label="POS">
        <i class="bi bi-cart"></i>
    </a>
    <a href="{{ route('products.create') }}" class="icon" aria-label="Add Product">
        <i class="bi bi-box-seam-fill"></i>
    </a>
    <a href="#" class="icon" aria-label="Sales">
        <i class="bi bi-cart-check-fill"></i>
    </a>
    <a href="#" class="icon" aria-label="Purchases">
        <i class="bi bi-cart-plus-fill"></i>
    </a>
    <a href="#" class="icon" aria-label="Expenses">
        <i class="bi bi-cash-coin"></i>
    </a>
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('admin.create-seller') }}" class="icon" aria-label="Register Seller">
        <i class="bi bi-people-fill"></i>
    </a>
    @endif
    <a href="#" class="icon" aria-label="Revenue">
        <i class="bi bi-graph-up"></i>
    </a>
    <a href="#" class="icon" aria-label="Charts">
        <i class="bi bi-bar-chart-line-fill"></i>
    </a>
    <a href="#" class="icon" aria-label="Chain Stores">
        <i class="bi bi-shop"></i>
    </a>
</div>

<main>
    @yield('content') <!-- Dynamic content goes here -->
</main>

<footer class="app-footer">
    <div class="float-end d-none d-sm-inline">Anything you want</div>
    <strong>Copyright &copy; 2024-2025&nbsp;<a href="#" class="text-decoration-none"></a>.</strong> All rights reserved.
</footer>
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