<x-admin-master>
    <h1>Edit a post</h1>

    <form class="d-flex flex-column" method="post" action="{{ route("posts.update", $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <x-forms.input id="title" label="Title" type="text" placeholder="Enter title">
            {{ $post->title }}
        </x-forms.input>
        <div>
            <img src="{{ $post->post_image }}" width="100px" alt="post_image_{{ $post->id }}"/>
        </div>
        <x-forms.input id="post_image" label="Image" type="file" />
        <x-forms.input id="body" label="Content" type="textarea" cols="30" rows="10">{{ $post->body }}</x-forms.input>
        <button class="btn btn-primary align-self-end" type="submit">Update</button>
    </form>
</x-admin-master>
