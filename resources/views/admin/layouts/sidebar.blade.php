<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('main') }}">
        {{-- <div class="sidebar-brand-icon rotate-n-15"> --}}
        {{-- <img src="{{ asset('assets/image 5.png') }}}" alt="" srcset=""> --}}
        {{-- </div> --}}
        <div class="sidebar-brand-text mx-3">RENATA <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master User
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.role.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Role</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>User</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Data Perusahaan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.company.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Perusahaan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Lowongan
    </div>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.kategori_lowongan.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Kategori</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.lowongan.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Lowongan</span></a>
    </li>
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Lamaran
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.lamaran.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Lamaran</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        E-Learning
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.kategori_elearning.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Kategori E-Learn</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.elearning.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>E-Learn</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
