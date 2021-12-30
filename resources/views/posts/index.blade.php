<x-admin-master>
    <x-slot name="styles">
        <link href="{{ asset("vendor/datatables/dataTables.bootstrap4.min.css") }}" rel="stylesheet">
    </x-slot>
    <h1>All Posts</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Image</th>
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
                                <td><img width="100px" src="{{ $post->post_image }}" alt="post-image-{{ $post->id }}"></td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td class="d-flex justify-content-center align-items-center">
                                    <a class="m-2 btn btn-primary" href="{{ route("post.show", $post) }}"><i class="fas fa-eye"></i></a>
                                    <a class="m-2 btn btn-warning" href="#"><i class="fas fa-pen"></i></a>
                                    <a class="m-2 btn btn-danger" href="#"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset("vendor/datatables/jquery.dataTables.min.js") }}"></script>
        <script src="{{ asset("vendor/datatables/dataTables.bootstrap4.min.js") }}"></script>

        <script src="{{ asset("js/demo/datatables-demo.js") }}"></script>
    </x-slot>
</x-admin-master>
