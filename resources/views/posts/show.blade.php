<x-layout>
    <!-- Title -->
    <h1 class="mt-4">{{ $post->title }}</h1>

    <!-- Author -->
    <p class="lead">
        by {{ $post->user->name }}
    </p>

    <p class="text-secondary">
        Topics:
        @foreach($post->tags as $tag)
            <span class="badge rounded-pill badge-outline-secondary">{{ $tag->name }}</span>
        @endforeach
    </p>

    <hr>
    <!-- Date/Time -->
    <p>Posted on {{ $post->created_at->diffForHumans() }}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{ $post->post_image }}" alt="">

    <hr>

    <!-- Content -->
    <p>{{ $post->body }}</p>
</x-layout>
