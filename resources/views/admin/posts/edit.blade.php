<x-admin.layout>
    <h1>Edit a post</h1>

    <form class="d-flex flex-column" method="post" action="{{ route("posts.update", $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <x-admin.forms.input id="title" label="Title" type="text" placeholder="Enter title">
            {{ $post->title }}
        </x-admin.forms.input>
        <div>
            <img src="{{ $post->post_image }}" width="100px" alt="post_image_{{ $post->id }}"/>
        </div>
        <x-admin.forms.input id="post_image" label="Image" type="file" />
        <x-admin.forms.input id="body" label="Content" type="textarea" cols="30" rows="10">{{ $post->body }}</x-admin.forms.input>
        <button class="btn btn-primary align-self-end" type="submit">Update</button>
    </form>
</x-admin.layout>
