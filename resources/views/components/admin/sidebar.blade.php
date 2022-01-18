<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-text mx-3">MY CMS</div>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <x-navigations.link icon="fas fa-fw fa-tachometer-alt" title="Dashboard" route="admin.index"/>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Blog
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <x-navigations.menu title="Posts" icon="fas fa-fw fa-cog">
        <h6 class="collapse-header">manage post:</h6>
        <a class="collapse-item" href="{{ route("posts.create") }}">Create a Post</a>
        <a class="collapse-item" href="{{ route("posts.index") }}">View All Posts</a>
    </x-navigations.menu>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>