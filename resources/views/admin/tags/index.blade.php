<x-admin.layout>
    <h1>All Tags</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" tag="alert">
            {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table display" id="dataTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->slug }}</td>
                            <td>{{ $tag->created_at }}</td>
                            <td>{{ $tag->updated_at }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a
                                    @class([
                                        'm-2',
                                        'btn',
                                        'btn-warning' => Auth::user()->can('update', $tag),
                                        'btn-secondary' => Auth::user()->cannot('update', $tag),
                                        'disabled' => Auth::user()->cannot('update', $tag)
                                    ])
                                    href="{{ route("admin.tags.edit", $tag) }}"
                                >
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button
                                    @class([
                                        'm-2',
                                        'btn',
                                        'btn-danger'=> Auth::user()->can('delete', $tag),
                                        'btn-secondary' => Auth::user()->cannot('delete', $tag),
                                        'disabled' => Auth::user()->cannot('delete', $tag)
                                    ])
                                    type="button"
                                    id="showModalButton"
                                    data-bs-toggle="modal"
                                    data-bs-target="#tagDeleteModal"
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
    @can('delete', $tag)
        <div class="modal fade" id="tagDeleteModal" tabindex="-1" tag="dialog" aria-labelledby="tagDeleteModalLabel">
            <div class="modal-dialog" tag="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tagDeleteModalLabel">Do you want to delete this tag ?</h5>
                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Delete" below if you want to delete the tag.</div>
                    <div class="modal-footer">
                        <form method="post" action="{{ route("admin.tags.destroy", $tag) }}"
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
