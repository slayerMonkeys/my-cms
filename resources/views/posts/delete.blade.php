<form method="post" action="{{ route("post.destroy", $post) }}" enctype="multipart/form-data">
    @method("DELETE")
    @csrf
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
    <button class="btn btn-danger" type="submit">Delete</button>
</form>
