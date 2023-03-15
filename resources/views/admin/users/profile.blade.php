<x-admin.layout>
    <h1>Profile</h1>

    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user-profile-picture" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4>{{ $user->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    Personal Information
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Roles</h6>
                        </div>
                        <div class="col-sm-9 text-secondary d-flex flex-column">
                            @foreach($userRoles as $role)
                                <span>{{ $role->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    Latest Posts
                </div>
                <div class="card-body d-flex flex-column">
                    @foreach($latestUserPosts as $post)
                        <a href="{{ route("posts.show", $post) }}">{{ $post->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
