@extends("layouts.main")

@section("container")
    <section class="mb-16 text-center">
        <h1
            class="text-light-text-primary text-5xl font-extrabold tracking-tight"
        >
            Welcome to
            <span
                class="from-light-error-text via-light-error-border to-light-error-background bg-gradient-to-r bg-clip-text text-transparent"
            >
                AlBlog
            </span>
        </h1>
        <p class="text-light-text-muted mt-2 text-lg">
            Discover the latest and most popular posts curated for you
        </p>
    </section>

    {{-- Newly Added Posts --}}
    <section class="mb-16">
        <h2
            class="text-light-text-primary/80 mb-10 px-4 text-center text-3xl font-bold"
        >
            🆕 Newly Added Posts
        </h2>

        @if ($newlyPosts->count())
            {{-- Featured Post --}}
            <div
                class="bg-light-background-secondary mx-auto mb-10 max-w-5xl overflow-hidden rounded-2xl shadow-xl transition duration-300 hover:shadow-2xl"
            >
                @if ($newlyPosts[0]->image)
                    <img
                        src="{{ Storage::disk("s3")->url($newlyPosts[0]->image) }}"
                        class="h-72 w-full object-cover"
                        alt="{{ $newlyPosts[0]->category->name }}"
                    />
                @else
                    <img
                        src="https://picsum.photos/1200/400"
                        class="h-72 w-full object-cover"
                        alt="{{ $newlyPosts[0]->category->name }}"
                    />
                @endif
                {{-- Displays a featured image for the first post, styled to fit the container. --}}

                <div class="p-6 text-center">
                    <h3 class="mb-2 text-2xl font-semibold">
                        <a
                            href="/posts/{{ $newlyPosts[0]->slug }}"
                            class="text-light-text-primary hover:underline"
                        >
                            {{ $newlyPosts[0]->title }}
                        </a>
                    </h3>
                    {{-- Displays the title of the featured post with a link to its details. --}}

                    <p class="text-light-text-muted mb-2 text-sm">
                        By
                        <a
                            href="/posts?author={{ $newlyPosts[0]->author->username }}"
                            class="text-light-background-primary hover:underline"
                        >
                            {{ $newlyPosts[0]->author->name }}
                        </a>
                        in
                        <a
                            href="/posts?category={{ $newlyPosts[0]->category->slug }}"
                            class="text-light-background-primary hover:underline"
                        >
                            {{ $newlyPosts[0]->category->name }}
                        </a>
                        • {{ $newlyPosts[0]->created_at->diffForHumans() }}
                    </p>
                    {{-- Displays the author, category, and relative creation time of the featured post. --}}

                    <p class="text-light-text-primary mb-4">
                        {{ $newlyPosts[0]->excerpt }}
                    </p>
                    {{-- Displays a short excerpt of the featured post. --}}

                    <a
                        href="/posts/{{ $newlyPosts[0]->slug }}"
                        class="bg-light-background-primary text-light-text-secondary hover:bg-light-text-primary inline-block rounded px-4 py-2 transition"
                    >
                        Read more
                    </a>
                    {{-- Button linking to the full details of the featured post. --}}
                </div>
            </div>

            {{-- Other Posts Grid --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($newlyPosts->skip(1) as $index => $post)
                    <div
                        class="bg-light-background-secondary flex flex-col overflow-hidden rounded-2xl shadow transition hover:shadow-lg"
                    >
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
                                    src="{{ Storage::disk("s3")->url($post->image) }}"
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
                                    class="text-light-text-primary hover:underline"
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
                                    class="bg-light-background-primary text-light-text-secondary hover:bg-light-text-primary inline-block cursor-pointer rounded px-3 py-1 transition"
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
    </section>

    {{-- Popular Posts --}}
    <section>
        <h2
            class="text-light-text-primary/80 mt-20 mb-10 px-4 text-center text-3xl font-bold"
        >
            🔥 Popular Posts
        </h2>

        @if ($popularPosts->count())
            {{-- Checks if there are any posts to display. --}}

            {{-- Featured Post --}}
            <div
                class="bg-light-background-secondary mx-auto mb-10 max-w-5xl overflow-hidden rounded-2xl shadow-xl transition duration-300 hover:shadow-2xl"
            >
                @if ($popularPosts[0]->image)
                    <img
                        src="{{ Storage::disk("s3")->url($popularPosts[0]->image) }}"
                        class="h-64 w-full object-cover"
                        alt="{{ $popularPosts[0]->category->name }}"
                    />
                @else
                    <img
                        src="https://picsum.photos/1200/400"
                        class="h-64 w-full object-cover"
                        alt="{{ $popularPosts[0]->category->name }}"
                    />
                @endif
                {{-- Displays a featured image for the first post, styled to fit the container. --}}

                <div class="p-6 text-center">
                    <h3 class="mb-2 text-2xl font-semibold">
                        <a
                            href="/posts/{{ $popularPosts[0]->slug }}"
                            class="text-light-text-primary hover:underline"
                        >
                            {{ $popularPosts[0]->title }}
                        </a>
                    </h3>
                    {{-- Displays the title of the featured post with a link to its details. --}}

                    <p class="text-light-text-muted mb-2 text-sm">
                        By
                        <a
                            href="/posts?author={{ $popularPosts[0]->author->username }}"
                            class="text-light-background-primary hover:underline"
                        >
                            {{ $popularPosts[0]->author->name }}
                        </a>
                        in
                        <a
                            href="/posts?category={{ $popularPosts[0]->category->slug }}"
                            class="text-light-background-primary hover:underline"
                        >
                            {{ $popularPosts[0]->category->name }}
                        </a>
                        • {{ $popularPosts[0]->created_at->diffForHumans() }}
                    </p>
                    {{-- Displays the author, category, and relative creation time of the featured post. --}}

                    <p class="text-light-text-primary mb-4">
                        {{ $popularPosts[0]->excerpt }}
                    </p>
                    {{-- Displays a short excerpt of the featured post. --}}

                    <a
                        href="/posts/{{ $popularPosts[0]->slug }}"
                        class="bg-light-background-primary text-light-text-secondary hover:bg-light-text-primary inline-block rounded px-4 py-2 transition"
                    >
                        Read more
                    </a>
                    {{-- Button linking to the full details of the featured post. --}}
                </div>
            </div>

            {{-- Other Posts Grid --}}
            <div
                class="mb-5 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3"
            >
                @foreach ($popularPosts->skip(1) as $index => $post)
                    <div
                        class="bg-light-background-secondary flex flex-col overflow-hidden rounded-2xl shadow transition hover:shadow-lg"
                    >
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
                                    src="{{ Storage::disk("s3")->url($post->image) }}"
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
                                    class="text-light-text-primary hover:underline"
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
                                    class="bg-light-background-primary text-light-text-secondary hover:bg-light-text-primary inline-block cursor-pointer rounded px-3 py-1 transition"
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
    </section>
@endsection
