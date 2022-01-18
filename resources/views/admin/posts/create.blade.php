<x-admin.layout>
    <h1>Create</h1>

    <form class="d-flex flex-column" method="post" action="{{ route("posts.store") }}" enctype="multipart/form-data">
        @csrf
        <x-admin.forms.input id="title" label="Title" type="text" placeholder="Enter title"/>
        <x-admin.forms.input id="post_image" label="Image" type="file" />
        <x-admin.forms.input id="body" label="Content" type="textarea" cols="30" rows="10"  />
        <button class="btn btn-primary align-self-end" type="submit">Submit</button>
    </form>
</x-admin.layout>
