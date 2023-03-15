<x-admin.layout>
    <h1>Update Tag</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="d-flex flex-column" method="post" action="{{ route("admin.tags.update", $tag) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-admin.forms.input id="name" label="Name" type="text"
                             placeholder="Name">{{ old("name", $tag->name) }}</x-admin.forms.input>
        <button class="btn btn-primary align-self-end" type="submit">Submit</button>
    </form>
</x-admin.layout>
