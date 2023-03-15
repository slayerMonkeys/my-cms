<x-admin.layout>
    <x-slot name="styles">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    </x-slot>
    <h1>Edit a post</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="d-flex flex-column" method="post" action="{{ route("admin.posts.update", $post) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <x-admin.forms.input id="title" label="Title" type="text" placeholder="Enter title">
            {{ $post->title }}
        </x-admin.forms.input>
        <div>
            <img src="{{ $post->post_image }}" width="100px" alt="post_image_{{ $post->id }}"/>
        </div>
        <x-admin.forms.input id="post_image" label="Image" type="file"/>
        <x-admin.forms.input id="body" label="Content" type="textarea" cols="30"
                             rows="10">{{ $post->body }}</x-admin.forms.input>
        <label for="tags">Select the tags for the post</label>
        <select size="10" name="tags" id="tags" multiple="multiple">
            @foreach($tags as $tag)
                <option
                    {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected':'' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary align-self-end mt-2" type="submit">Update</button>
    </form>

    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#tags').select2();
            });
        </script>
    </x-slot>
</x-admin.layout>
