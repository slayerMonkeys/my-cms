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
    @can("viewAny", \App\Models\Post::class)
        <x-navigations.menu title="Posts" icon="fas fa-fw fa-cog">
            <h6 class="collapse-header">manage posts:</h6>
            @can("create", \App\Models\Post::class)
                <a class="collapse-item" href="{{ route("admin.posts.create") }}">Create a Post</a>
            @endcan
            <a class="collapse-item" href="{{ route("admin.posts.index") }}">View All Posts</a>
        </x-navigations.menu>
    @endcan

    @can("viewAny", \App\Models\Tag::class)
        <x-navigations.menu title="Tags" icon="fas fa-tag">
            <h6 class="collapse-header">manage tags:</h6>
            @can("create", \App\Models\Tag::class)
                <a class="collapse-item" href="{{ route("admin.tags.create") }}">Create a Tag</a>
            @endcan
            <a class="collapse-item" href="{{ route("admin.tags.index") }}">View All Tags</a>
        </x-navigations.menu>
    @endcan

    @can("viewAny", App\Models\User::class)
        <!-- Divider -->
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Administration
        </div>

        <x-navigations.menu title="Users" icon="fas fa-users" :is-active="request()->is('admin/users*')">
            <h6 class="collapse-header">manage users:</h6>
            @can("create", App\Models\User::class)
                <a class="collapse-item" href="{{ route("admin.users.create") }}">Create a User</a>
            @endcan
            <a class="collapse-item" href="{{ route("admin.users.index") }}">View All Users</a>
        </x-navigations.menu>
        @can("viewAny", App\Models\Role::class)
            <x-navigations.menu title="Roles" icon="fas fa-user-shield" :is-active="request()->is('admin/roles*')">
                <h6 class="collapse-header">manage roles:</h6>
                @can("create", App\Models\Role::class)
                    <a class="collapse-item" href="{{ route("admin.roles.create") }}">Create a Role</a>
                @endcan
                <a class="collapse-item" href="{{ route("admin.roles.index") }}">View All Roles</a>
            </x-navigations.menu>
        @endcan
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
