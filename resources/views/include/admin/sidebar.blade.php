<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->

    <!-- <div class="sidebar-brand-icon">
         <i class="fab fa-adn"></i>
          <i class="fab fa-adversal"></i>
        </div> -->
    <!--<a class="sidebar-brand d-flex" href="{{url('admin/homes')}}">
        <div class="sidebar-brand-text mx-1">MANDALAY HOMES</div>
      </a>-->
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('admin/homes')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Admin Controls
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-home"></i>
            <span>Home Management</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage your homes</h6>
                <a class="collapse-item" href="{{url('admin/homes')}}"><i class="fas fa-home"></i> View your homes</a>
                <a class="collapse-item" href="{{url('admin/homes/create')}}"><i class="fas fa-plus"></i> Add new home</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Community Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-object-group"></i>
            <span>Community Management</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage your Communities</h6>
                <a class="collapse-item" href="{{url('admin/communities')}}"><i class="fas fa-object-group"></i> View your Communities</a>
                <a class="collapse-item" href="{{url('admin/communities/create')}}"><i class="fas fa-plus"></i> Add new Community</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-users"></i>
            <span>User Management</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage your users easily</h6>
                <a class="collapse-item" href="{{url('admin/users')}}"><i class="fas fa-users"></i> View Current Users</a>
                <a class="collapse-item" href="{{url('admin/users/create')}}"><i class="fas fa-user-plus"></i> Add a new User</a>
                <a class="collapse-item" href="{{url('admin/users/roles')}}"><i class="fas fa-bars"></i> Manage User Role</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFM" aria-expanded="true" aria-controls="collapseFM">
            <i class="fas fa-bed"></i>
            <span>Floorplan Management</span>
        </a>
        <div id="collapseFM" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage your users easily</h6>
                <a class="collapse-item" href="{{url('admin/floor_plans')}}"><i class="fas fa-bed"></i> View Your Saved Floorplans</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->