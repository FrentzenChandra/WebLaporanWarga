<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin Lapor Pak</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ request()->is('admin.dashboard') ? 'acitive' : ''}} ">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item {{ request()->is('admin/Resident') ? 'active' : ''}}">
    <a class="nav-link" href="{{route('admin.Resident.index')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Data Masyarakat</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item {{ request()->is('admin/Category') ? 'active' : ''}}">
    <a class="nav-link" href="{{route('admin.Category.index')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Data Kategori</span>
    </a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item {{ request()->is('admin/Report') ? 'active' : ''}}">
    <a class="nav-link" href="{{route('admin.Report.index')}}">
        <i class="fas fa-fw fa-table"></i>
        <span>Data Laporan</span>
    </a>
</li>


</ul>
