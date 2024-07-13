<style>
    .active {
        color: blueviolet;
    }
</style>

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Lekad Siduri Decor</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Lekad Siduri Decor</a>
        </div>
       
        <ul class="sidebar-menu">
          @if (auth()->user()->role == 'admin')
          <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a class="nav-link"
                href="/admin/dashboard"><i class="fas fa-th"></i> <span>Dashboard</span></a>
        </li>
          @endif
            <li class="menu-header">Management</li>
            
           @if (auth()->user()->role == 'admin')
           <li class="{{ request()->is('admin/customer') ? 'active' : '' }}">
            <a class="nav-link"
                href="/admin/customer"><i class="fas fa-th"></i> <span>Daftar Penyewa</span></a>
        </li>

        <li class="nav-item dropdown">
            <a href="#"
                class="nav-link has-dropdown"
                data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Management Order</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->is('admin/order/waiting') ? 'active' : '' }}">
                    <a class="nav-link"
                        href="/admin/order/waiting"><i class="fas fa-th"></i> <span>Order Terpending</span></a>
                </li>
                <li class="{{ request()->is('admin/order/paid') ? 'active' : '' }}">
                    <a class="nav-link"
                        href="/admin/order/paid"><i class="fas fa-th"></i> <span>Order Lunas</span></a>
                </li>
                <li class="{{ request()->is('admin/order/expired') ? 'active' : '' }}">
                    <a class="nav-link"
                        href="/admin/order/expired"><i class="fas fa-th"></i> <span>Order Expired</span></a>
                </li>
               
            </ul>
        </li>
           @endif
          
         

            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Management Booking</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('admin/order/waiting') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="/booking/active"><i class="fas fa-th"></i> <span>Booking Aktif</span></a>
                    </li>
                    <li class="{{ request()->is('admin/order/paid') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="/booking/unactive"><i class="fas fa-th"></i> <span>Booking Selesai</span></a>
                    </li>
                  
                   
                </ul>
            </li>

            <li class="{{ request()->is('admin/books') ? 'active' : '' }}">
                <a class="nav-link"
                    href="/package"><i class="fas fa-th"></i> <span>Paket Management</span></a>
            </li>
            <li class="{{ request()->is('admin/affiliate') ? 'active' : '' }}">
                <a class="nav-link"
                    href="/decoration"><i class="fas fa-th"></i> <span>Dekorasi Management</span></a>
            </li>
            
            
        </ul>

        
    </aside>
</div>
