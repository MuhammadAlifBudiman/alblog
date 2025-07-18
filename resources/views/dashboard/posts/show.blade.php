@extends("dashboard.layouts.main")

@section("container")
    <div class="my-6">
        <h3 class="text-light-text-primary mb-4 text-2xl font-semibold">
            {{ $post->title }}
        </h3>

        <div class="mb-6 flex flex-wrap gap-2">
            <a
                href="/dashboard/posts"
                class="bg-light-success-background text-light-success-text hover:bg-light-success-border hover:text-light-text-secondary inline-flex items-center gap-1 rounded px-3 py-1.5"
            >
                <span data-feather="arrow-left" class="h-4 w-4"></span>
                Back to all my posts
            </a>
            <a
                href="/dashboard/posts/{{ $post->slug }}/edit"
                class="bg-light-background-hover text-light-text-primary hover:bg-light-background-primary hover:text-light-text-secondary inline-flex items-center gap-1 rounded px-3 py-1.5"
            >
                <span data-feather="edit" class="h-4 w-4"></span>
                Edit post
            </a>
            <form
                action="/dashboard/posts/{{ $post->slug }}"
                method="post"
                onsubmit="return confirm('Are you sure to delete this post?')"
            >
                @method("delete")
                @csrf
                <button
                    class="bg-light-error-background text-light-error-text hover:bg-light-error-border hover:text-light-text-secondary inline-flex cursor-pointer items-center gap-1 rounded px-3 py-1.5"
                >
                    <span data-feather="trash-2" class="h-4 w-4"></span>
                    Delete Post
                </button>
            </form>
        </div>

        @if ($post->image)
            <img
                src="{{ Storage::url($post->image) }}"
                class="mt-3 max-h-[350px] w-full rounded object-cover"
                alt="{{ $post->image }}"
            />
        @else
            <img
                src="https://picsum.photos/1200/400"
                class="mt-3 w-full rounded object-cover"
                alt=""
            />
        @endif

        <article class="prose text-light-text-primary mt-6 max-w-none">
            {!! $post->body !!}
        </article>
    </div>
@endsection
