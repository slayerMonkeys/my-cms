<x-admin.layout>
    <h1>All Posts</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table display" id="dataTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td class="d-flex justify-content-center align-items-center">
                                    <a class="m-2 btn btn-primary" href="{{ route("posts.show", $post) }}"><i
                                            class="fas fa-eye"></i></a>
                                    <a
                                        @class([
                                            'm-2',
                                            'btn',
                                            'btn-warning' => Auth::user()->can('update', $post),
                                            'btn-secondary' => Auth::user()->cannot('update', $post),
                                            'disabled' => Auth::user()->cannot('update', $post)
                                        ])
                                        href="{{ route("admin.posts.edit", $post) }}"
                                    >
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button
                                        @class([
                                            'm-2',
                                            'btn',
                                            'btn-danger'=> Auth::user()->can('delete', $post),
                                            'btn-secondary' => Auth::user()->cannot('delete', $post),
                                            'disabled' => Auth::user()->cannot('delete', $post)
                                        ])
                                        type="button"
                                        id="showModalButton"
                                        data-bs-toggle="modal"
                                        data-bs-target="#postDeleteModal"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @can('delete', $post)
        <div class="modal fade" id="postDeleteModal" tabindex="-1" role="dialog" aria-labelledby="postDeleteModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postDeleteModalLabel">Do you want to delete this post ?</h5>
                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Delete" below if you want to delete the post.</div>
                    <div class="modal-footer">
                        <form method="post" action="{{ route("admin.posts.destroy", $post) }}"
                              enctype="multipart/form-data">
                            @method("DELETE")
                            @csrf
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
</x-admin.layout>
