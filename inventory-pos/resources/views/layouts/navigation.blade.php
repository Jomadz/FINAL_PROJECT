
                    <!-- Add dynamic navigation based on role -->
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Admin Dashboard') }}
                        </x-nav-link>
                    @elseif(Auth::user()->role === 'seller')
                        <x-nav-link :href="route('seller.dashboard')" :active="request()->routeIs('seller.dashboard')">
                            {{ __('Seller Dashboard') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                       
              

                            <div class="ml-1">
 
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

           

    

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
               
        
            </div>

           
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<!--begin::Footer-->
<footer>
<p><strong>Copyright © 2024-2025. </strong>All rights reserved.</p>
    <p>Anything you want.</p>
</footer>
<!--end::Footer-->

<!-- Footer CSS -->
<style>
   footer {
    display: flex;
    justify-content: space-between;
    padding: 20px 5px; /* Adjust padding as needed */
    background-color: #f8f9fa; /* Light background color */
    font-family: Arial, sans-serif; /* Change to your preferred font */
}

footer p {
    margin: 0;
    color: #6c757d; /* Gray text color */
}
</style>

