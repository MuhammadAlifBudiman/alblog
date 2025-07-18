@extends("layouts.main")
{{-- Extends the main layout to maintain a consistent structure across pages. --}}

@section("container")
    {{-- Defines the content section named "container" to be injected into the main layout. --}}

    <h1 class="text-light-text-primary mb-6 text-center text-3xl font-bold">
        {{ $title }}
    </h1>
    {{-- Displays the page title dynamically, styled as a centered, bold, and large heading. --}}

    <div class="mb-6">
        <form action="/posts" class="mx-auto w-full max-w-xl">
            {{-- Creates a search form for filtering posts, styled for a centered and responsive layout. --}}

            @if (request("category"))
                <input
                    type="hidden"
                    name="category"
                    value="{{ request("category") }}"
                />
            @endif

            {{-- Preserves the selected category filter in the form when submitting a new search. --}}

            @if (request("author"))
                <input
                    type="hidden"
                    name="author"
                    value="{{ request("author") }}"
                />
            @endif

            {{-- Preserves the selected author filter in the form when submitting a new search. --}}

            <div class="grid grid-cols-[1fr_auto]">
                <input
                    type="text"
                    name="search"
                    placeholder="Search.."
                    class="border-light-border-primary focus:ring-light-success-border w-full rounded-l-md border p-2 pr-0 focus:ring-1 focus:outline-none"
                    value="{{ request("search") }}"
                />
                {{-- Input field for entering search keywords, styled for usability and accessibility. --}}

                <button
                    type="submit"
                    class="bg-light-success-background text-light-success-text hover:bg-light-success-border hover:text-light-success-background cursor-pointer rounded-r-md px-4 transition"
                >
                    Search
                </button>
                {{-- Submit button for the search form, styled with hover effects. --}}
            </div>
        </form>
    </div>

    @if ($posts->count())
        {{-- Checks if there are any posts to display. --}}

        {{-- Featured Post --}}
        <div
            class="mx-auto mb-6 max-w-4xl overflow-hidden rounded-lg shadow-lg"
        >
            @if ($posts[0]->image)
                <img
                    src="{{ Storage::url($posts[0]->image) }}"
                    class="h-64 w-full object-cover"
                    alt="{{ $posts[0]->category->name }}"
                />
            @else
                <img
                    src="https://picsum.photos/1200/400"
                    class="h-64 w-full object-cover"
                    alt="{{ $posts[0]->category->name }}"
                />
            @endif
            {{-- Displays a featured image for the first post, styled to fit the container. --}}

            <div class="p-6 text-center">
                <h3 class="text-light-text-primary mb-2 text-2xl font-semibold">
                    <a
                        href="/posts/{{ $posts[0]->slug }}"
                        class="hover:underline"
                    >
                        {{ $posts[0]->title }}
                    </a>
                </h3>
                {{-- Displays the title of the featured post with a link to its details. --}}

                <p class="text-light-text-muted mb-2 text-sm">
                    By
                    <a
                        href="/posts?author={{ $posts[0]->author->username }}"
                        class="text-light-background-primary hover:underline"
                    >
                        {{ $posts[0]->author->name }}
                    </a>
                    in
                    <a
                        href="/posts?category={{ $posts[0]->category->slug }}"
                        class="text-light-background-primary hover:underline"
                    >
                        {{ $posts[0]->category->name }}
                    </a>
                    • {{ $posts[0]->created_at->diffForHumans() }}
                </p>
                {{-- Displays the author, category, and relative creation time of the featured post. --}}

                <p class="text-light-text-primary mb-4">
                    {{ $posts[0]->excerpt }}
                </p>
                {{-- Displays a short excerpt of the featured post. --}}

                <a
                    href="/posts/{{ $posts[0]->slug }}"
                    class="bg-light-background-primary hover:bg-light-text-primary text-light-text-secondary inline-block rounded px-4 py-2 transition"
                >
                    Read more
                </a>
                {{-- Button linking to the full details of the featured post. --}}
            </div>
        </div>

        {{-- Other Posts Grid --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts->skip(1) as $index => $post)
                <div class="flex flex-col overflow-hidden rounded-lg shadow">
                    <div class="relative">
                        <div
                            class="text-light-text-secondary bg-light-background-primary/70 absolute top-0 left-0 z-[1] px-3 py-1"
                        >
                            <a
                                href="/posts?category={{ $post->category->slug }}"
                                class="hover:underline"
                            >
                                {{ $post->category->name }}
                            </a>
                        </div>
                        {{-- Displays the category of the post as an overlay on the image. --}}

                        @if ($post->image)
                            <img
                                src="{{ Storage::url($post->image) }}"
                                class="h-48 w-full object-cover"
                                alt="{{ $post->image }}"
                            />
                        @else
                            <img
                                src="https://picsum.photos/500/400?random={{ $index + 1 }}"
                                class="h-48 w-full object-cover"
                                alt="{{ $post->category->name }}"
                            />
                        @endif
                        {{-- Displays a random image for each post, styled to fit the container. --}}
                    </div>

                    <div class="flex flex-1 flex-col p-4">
                        <h5 class="mb-1 text-lg font-semibold">
                            <a
                                href="/posts/{{ $post->slug }}"
                                class="hover:underline"
                            >
                                {{ $post->title }}
                            </a>
                        </h5>
                        {{-- Displays the title of the post with a link to its details. --}}

                        <p class="text-light-text-muted mb-2 text-sm">
                            By
                            <a
                                href="/posts?author={{ $post->author->username }}"
                                class="text-light-background-primary hover:underline"
                            >
                                {{ $post->author->name }}
                            </a>
                            • {{ $post->created_at->diffForHumans() }}
                        </p>
                        {{-- Displays the author and relative creation time of the post. --}}

                        <p class="text-light-text-primary mb-4 flex-grow">
                            {{ $post->excerpt }}
                        </p>
                        {{-- Displays a short excerpt of the post. --}}

                        <button class="mt-auto flex justify-start">
                            <a
                                href="/posts/{{ $post->slug }}"
                                class="bg-light-background-primary hover:bg-light-text-primary text-light-text-secondary inline-block rounded px-4 py-2 transition"
                            >
                                Read more
                            </a>
                        </button>
                        {{-- Button linking to the full details of the post. --}}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-light-text-primary text-center text-lg">
            No post found.
        </p>
        {{-- Displays a message if no posts are available. --}}
    @endif

    <div class="mt-6 mb-6 flex justify-end">
        {{ $posts->links() }}
    </div>
    {{-- Displays pagination links for navigating through the posts. --}}
@endsection

{{-- Ends the "container" section. --}}
