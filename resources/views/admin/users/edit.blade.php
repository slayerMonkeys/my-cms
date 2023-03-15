<x-admin.layout>
    <h1>Update User</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="d-flex flex-column" method="post" action="{{ route("admin.users.update", $user) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-admin.forms.input id="name" label="Name" type="text"
                             placeholder="Name">{{ old("name", $user->name) }}</x-admin.forms.input>
        <x-admin.forms.input id="email" label="Email" type="email"
                             placeholder="Email">{{ old("email", $user->email) }}</x-admin.forms.input>
        <h4>Roles</h4>
        <div class="grid">
            <div class="form-check form-switch g-col-3">
                <input class="form-check-input" type="checkbox" role="switch" id="user" checked disabled>
                <label class="form-check-label" for="user">User</label>
            </div>
            @foreach($roles as $role)
                <div class="form-check form-switch g-col-3">
                    <input class="form-check-input" name="role_{{ $role->slug }}" value="{{ $role->id }}"
                           type="checkbox" role="switch"
                           id="{{ $role->slug }}" {{ old($role->slug, $user->hasRole($role->slug)) ? 'checked':'' }} >
                    <label class="form-check-label" for="{{ $role->slug }}">{{ $role->name }}</label>
                </div>
            @endforeach
        </div>
        <button class="btn btn-primary align-self-end" type="submit">Submit</button>
    </form>
</x-admin.layout>
