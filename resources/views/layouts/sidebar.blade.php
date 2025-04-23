<div class="sidebar" style="background-color: #001f3f; height: 100vh;">
    <!-- Logo & Title -->
    <div class="text-center py-3">
        <img src="{{ asset('image/cinema_logo.jpg') }}" alt="Logo" class="rounded-circle mb-2" width="60">
        <h5 class="text-white">Titan Cinema</h5>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="background-color: transparent;">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                    <i class="fa fa-th-large" aria-hidden="true"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            
            <li class="nav-header text-white">Data Pengguna</li>
            <li class="nav-item">
                <a href="{{ url('/level') }}" class="nav-link {{ $activeMenu == 'level' ? 'active' : '' }}">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    <p>Level User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/user') }}" class="nav-link {{ $activeMenu == 'user' ? 'active' : '' }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <p>Data User</p>
                </a>
            </li>
            
            <li class="nav-header text-white">Data Film</li>
            <li class="nav-item">
                <a href="{{ url('/kategori') }}" class="nav-link {{ $activeMenu == 'kategori' ? 'active' : '' }}">
                    <i class="fa fa-film"></i>
                    <p>Kategori Film</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/film') }}" class="nav-link {{ $activeMenu == 'film' ? 'active' : '' }}">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <p>Data Film</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
