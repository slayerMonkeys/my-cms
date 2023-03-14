<x-admin.layout>
    <h1>Create</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="d-flex flex-column" method="POST" action="{{ route("admin.roles.store") }}"
          enctype="multipart/form-data">
        @csrf
        <x-admin.forms.input id="name" label="Name" type="text" placeholder="Name" value="{{ old('name') }}"/>
        <h4>Permissions</h4>
        <div class="grid">
            @foreach($permissions as $permission)
                <div class="form-check form-switch g-col-3">
                    <input class="form-check-input" name="permission_{{ $permission->slug }}"
                           value="{{ $permission->id }}" type="checkbox" role="switch"
                           id="{{ $permission->slug }}" {{ old($permission->slug) ? 'checked':'' }}>
                    <label class="form-check-label" for="{{ $permission->slug }}">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>
        <button class="btn btn-primary align-self-end" type="submit">Submit</button>
    </form>
</x-admin.layout>
