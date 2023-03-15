<x-admin.layout>
    <h1>Create Tag</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="d-flex flex-column" method="post" action="{{ route("admin.tags.store") }}"
          enctype="multipart/form-data">
        @csrf
        <x-admin.forms.input id="name" label="Name" type="text"
                             placeholder="Name">{{ old("name") }}</x-admin.forms.input>
        <button class="btn btn-primary align-self-end" type="submit">Submit</button>
    </form>
</x-admin.layout>
