<x-admin.layout>
    <h1>All Users</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>name</th>
                        <th>Email</th>
                        <th>Registered date</th>
                        <th>Updated profile date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>{{ $user->updated_at->diffForHumans() }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a class="m-2 btn btn-primary" href="{{ route("admin.users.profile", $user) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a
                                    @class([
                                        'm-2',
                                        'btn',
                                        'btn-warning' => Auth::user()->can('update', $user),
                                        'btn-secondary disabled' => Auth::user()->cannot('update', $user),
                                    ])
                                    href="{{ route("admin.users.edit", $user) }}"
                                >
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button
                                    @class([
                                        'm-2',
                                        'btn',
                                        'btn-danger'=> Auth::user()->can('delete', $user),
                                        'btn-secondary disabled' => Auth::user()->cannot('delete', $user),
                                    ])
                                    type="button"
                                    id="showModalButton"
                                    data-bs-toggle="modal"
                                    data-bs-target="#userDeleteModal"
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
    @can('delete', $user)
        <div class="modal fade" id="userDeleteModal" tabindex="-1" role="dialog" aria-labelledby="userDeleteModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userDeleteModalLabel">Do you want to delete this user ?</h5>
                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Delete" below if you want to delete the user.</div>
                    <div class="modal-footer">
                        <form method="post" action="{{ route("admin.users.destroy", $user) }}"
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
