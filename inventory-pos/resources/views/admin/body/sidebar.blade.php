    
   <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
          <a href="./index.html" class="brand-link">
            <img src="{{ asset('images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
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
                    <a href="{{ route('product.overview') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Product Overview</p>
                    </a>
                  </li>
                </ul>
              </li>

                      <li class="nav-item">
                        <a href="{{ route('sales.index') }}" class="nav-link">
                          <i class="nav-icon bi bi-cart-check-fill"></i>
                          <p> Sales records</p>
                        </a>
                      </li>
                     

              <li class="nav-item">
                <a href="{{ route('purchases.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-cart-plus-fill"></i>
                  <p>Purchases</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('expenses.index') }}" class="nav-link">
                  <i class="nav-icon bi bi-cash-coin"></i>
                  <p>Expenses</p>
                </a>
              </li>

              @if(auth()->user()->role === 'admin')
                  <li class="nav-item">
                    <a href="{{ route('admin.create-seller') }}" class="nav-link">
                      <i class="nav-icon bi bi-people-fill"></i>
                      <p>Register Seller</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon bi bi-activity"></i>
                      <p> Activities <i class="nav-arrow bi bi-chevron-right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.login-logout-activities') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>login/logout activities</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.product-activities') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>manage product activities</p>
                    </a>
                  </li>
                  </ul>
              @endif

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-graph-up"></i>
                  <p>Balance_sheet</p>
                </a>
              </li>

             

              
            </ul>
          </nav>
        </div>
      </aside>

      

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