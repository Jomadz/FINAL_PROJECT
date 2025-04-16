
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin | Dashboard </title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Admin| Dashboard " />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="C:/Users/u/Downloads/DASH/dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <script
  src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/js/adminlte.min.js"
  crossorigin="anonymous"
></script>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.min.css"
  crossorigin="anonymous"
/>

<!-- Floating Icons CSS -->
<style>
        .floating-icons {
            position: fixed;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            background-color: rgb(252, 252, 252); /* Optional: background for visibility */
            border-radius: 5px;
            padding: 10px;
            z-index: 1000; /* Ensure it is above other elements */
        }

        .floating-icons .icon {
            color: black; /* Change icon color */
            margin: 10px 0;
            text-align: center;
            font-size: 24px; /* Adjust size as needed */
            transition: color 0.3s;
        }

        .floating-icons .icon:hover {
            color:rgb(109, 106, 106); /* Change color on hover */
        }
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

      .btn-danger {
          background-color: #4b4b4b; /* Dark Grey for Delete */
          border-color: #4b4b4b; /* Dark Grey for Delete */
          color: white; /* White text for delete button */
      }
    </style>


  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="" class="nav-link">Home</a></li>
            
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
            <!--end::Navbar Search-->
           
               




           



            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->



            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="{{ $authenticatedUser->profile_image ?? asset ('images/admin.jpeg') }}"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline">{{ $authenticatedUser->name }}</span>
                
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text btn-primary">
                  <img
                    src="{{ $authenticatedUser->profile_image ?? asset('images/admin.jpeg')}}"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                  {{ $authenticatedUser->name }} - {{ $authenticatedUser->role }} 
                  <small>Member since {{ $authenticatedUser->created_at? $authenticatedUser->created_at->format('M Y') : 'N/A' }}</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                
                 <!-- Form for profile image update -->
      <form method="post" action="{{ route('profile.image.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex align-items-center">
          <input type="file" name="profile_image" id="profile_image" accept="image/*" class="form-control me-2">
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
      <form action="{{ route('logout') }}" method="POST" class="mt-2">
        @csrf
        <button type="submit" class="btn btn-default btn-flat float-end">Logout</button>
      </form>
    </li>
    <!--end::Menu Footer-->
  </ul>
</li>
<!--end::User  Menu Dropdown-->
              


                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->

      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('images/AdminLTELogo.png')}}"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Admin </span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item ">
                <a href="{{ route('pos.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-cart"></i>
                  <p>
                    POS
                    
                  </p>
                </a>
                <ul class="nav nav-treeview">
                   
                  
                  
                </ul>
              </li>

            
              
                      <!-- Product Dropdown -->
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-box-seam-fill"></i>
                          <p>
                            Product
                            <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="{{ route('products.create') }}" class="nav-link">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>Manage product</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="nav-icon bi bi-circle"></i>
                              <p>product overview</p>
                            </a>
                          </li>
                        </ul>
                      </li>
              
                      <!-- Sales -->
                     
                  
                      <li class="nav-item">
                        <a href="{{ route('sales.index') }}" class="nav-link">
                          <i class="nav-icon bi bi-cart-check-fill"></i>
                          <p> Sales records</p>
                        </a>
                      </li>
                      

                      <!-- Purchases -->
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-cart-plus-fill"></i>
                          <p>Purchases</p>
                        </a>
                      </li>
              
                      <!-- Expences -->
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-cash-coin"></i>
                          <p>Expenses</p>
                        </a>
                      </li>
              
                      <!-- seller -->

                      @if(auth()->user()->role === 'admin')


                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-people-fill"></i>
                          <p>sellers <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
            <!-- manage Seller -->
            <li class="nav-item">
              <a href="{{ route('admin.create-seller') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Register Seller</p>
              </a>
            </li>
            
            </li>
            <!-- Seller Activities -->
            <li class="nav-item">
              <a href="{{ route('admin.seller-activities') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Seller Activities</p>
              </a>
                      </li>
                     </ul>
                   </li>
                   @endif

                      <!-- Revenue -->
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-graph-up"></i>
                          <p>Revenue</p>
                        </a>
                      </li>
              
                      <!-- Charts -->
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-bar-chart-line-fill"></i>
                          <p>Charts</p>
                        </a>
                      </li>
              
                      
                    </ul>
                    <!--end::Sidebar Menu--> 
                  </nav>
                </div>
                <!--end::Sidebar Wrapper-->
              </aside>
              <!-- Floating Icons -->
<div class="floating-icons">
    <a href="{{ route('pos.index') }}" class="icon">
        <i class="bi bi-cart"></i>
    </a>
    <a href="{{ route('products.create') }}" class="icon">
        <i class="bi bi-box-seam-fill"></i>
    </a>
    <a href="#" class="icon">
        <i class="bi bi-cart-check-fill"></i>
    </a>
    <a href="#" class="icon">
        <i class="bi bi-cart-plus-fill"></i>
    </a>
    <a href="#" class="icon">
        <i class="bi bi-cash-coin"></i>
    </a>
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('admin.create-seller') }}" class="icon">
        <i class="bi bi-people-fill"></i>
    </a>
    @endif
    <a href="#" class="icon">
        <i class="bi bi-graph-up"></i>
    </a>
    <a href="#" class="icon">
        <i class="bi bi-bar-chart-line-fill"></i>
    </a>
    
</div>

              
                   
                </ul>
              </li>
              
                </ul>
              </li>
              
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->










      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard </li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            
              <!-- /.col -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->











      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2024-2025&nbsp;
          <a href=" " class="text-decoration-none"></a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../../dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
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
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>
    <script>
      // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
      // IT'S ALL JUST JUNK FOR DEMO
      // ++++++++++++++++++++++++++++++++++++++++++

      /* apexcharts
       * -------
       * Here we will create a few charts using apexcharts
       */

      //-----------------------
      // - MONTHLY SALES CHART -
      //-----------------------

      
//start of form for seller admin




//end of form for seller admin
  


      //-----------------
      // - END PIE CHART -
      //-----------------
    </script>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.querySelector('.app-sidebar');
            const toggleButton = document.querySelector('[data-lte-toggle="sidebar"]'); // Assuming you have a toggle button

            toggleButton.addEventListener('click', function () {
                sidebar.classList.toggle('closed'); // Add a class to close the sidebar
            });
        });
    </script>
    <!--end::Script-->
  </body>
  <!--end::Body-->

</html>