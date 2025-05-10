@extends("layouts.main")

@section("container")
    <section class="mb-16 text-center">
        <h1 class="text-5xl font-extrabold tracking-tight text-gray-800">
            Welcome to
            <span
                class="bg-gradient-to-r from-red-500 via-red-600 to-red-700 bg-clip-text text-transparent"
            >
                AlBlog
            </span>
        </h1>
        <p class="mt-2 text-lg text-gray-500">
            Discover the latest and most popular posts curated for you
        </p>
    </section>

    {{-- Newly Added Posts --}}
    <section class="mb-16">
        <h2 class="mb-10 px-4 text-center text-3xl font-bold text-gray-700">
            🆕 Newly Added Posts
        </h2>

        @if ($newlyPosts->count())
            {{-- Featured Post --}}
            <div
                class="mx-auto mb-10 max-w-5xl overflow-hidden rounded-2xl bg-white shadow-xl transition duration-300 hover:shadow-2xl"
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
                            class="text-gray-900 hover:underline"
                        >
                            {{ $newlyPosts[0]->title }}
                        </a>
                    </h3>
                    {{-- Displays the title of the featured post with a link to its details. --}}

                    <p class="mb-2 text-sm text-gray-500">
                        By
                        <a
                            href="/posts?author={{ $newlyPosts[0]->author->username }}"
                            class="text-blue-600 hover:underline"
                        >
                            {{ $newlyPosts[0]->author->name }}
                        </a>
                        in
                        <a
                            href="/posts?category={{ $newlyPosts[0]->category->slug }}"
                            class="text-blue-600 hover:underline"
                        >
                            {{ $newlyPosts[0]->category->name }}
                        </a>
                        • {{ $newlyPosts[0]->created_at->diffForHumans() }}
                    </p>
                    {{-- Displays the author, category, and relative creation time of the featured post. --}}

                    <p class="mb-4 text-gray-700">
                        {{ $newlyPosts[0]->excerpt }}
                    </p>
                    {{-- Displays a short excerpt of the featured post. --}}

                    <a
                        href="/posts/{{ $newlyPosts[0]->slug }}"
                        class="inline-block rounded bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700"
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
                        class="flex flex-col overflow-hidden rounded-2xl bg-white shadow transition hover:shadow-lg"
                    >
                        <div class="relative">
                            <div
                                class="absolute top-0 left-0 z-[1] bg-black/70 px-3 py-1 text-white"
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
                                    class="hover:underline"
                                >
                                    {{ $post->title }}
                                </a>
                            </h5>
                            {{-- Displays the title of the post with a link to its details. --}}

                            <p class="mb-2 text-sm text-gray-500">
                                By
                                <a
                                    href="/posts?author={{ $post->author->username }}"
                                    class="text-blue-600 hover:underline"
                                >
                                    {{ $post->author->name }}
                                </a>
                                • {{ $post->created_at->diffForHumans() }}
                            </p>
                            {{-- Displays the author and relative creation time of the post. --}}

                            <p class="mb-4 flex-grow text-gray-700">
                                {{ $post->excerpt }}
                            </p>
                            {{-- Displays a short excerpt of the post. --}}

                            <button class="mt-auto flex justify-start">
                                <a
                                    href="/posts/{{ $post->slug }}"
                                    class="inline-block rounded bg-blue-600 px-3 py-1 text-white transition hover:bg-blue-700"
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
            <p class="text-center text-lg text-gray-500">No post found.</p>
            {{-- Displays a message if no posts are available. --}}
        @endif
    </section>

    {{-- Popular Posts --}}
    <section>
        <h2
            class="mt-20 mb-10 px-4 text-center text-3xl font-bold text-gray-700"
        >
            🔥 Popular Posts
        </h2>

        @if ($popularPosts->count())
            {{-- Checks if there are any posts to display. --}}

            {{-- Featured Post --}}
            <div
                class="mx-auto mb-10 max-w-5xl overflow-hidden rounded-2xl bg-white shadow-xl transition duration-300 hover:shadow-2xl"
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
                            class="text-gray-900 hover:underline"
                        >
                            {{ $popularPosts[0]->title }}
                        </a>
                    </h3>
                    {{-- Displays the title of the featured post with a link to its details. --}}

                    <p class="mb-2 text-sm text-gray-500">
                        By
                        <a
                            href="/posts?author={{ $popularPosts[0]->author->username }}"
                            class="text-blue-600 hover:underline"
                        >
                            {{ $popularPosts[0]->author->name }}
                        </a>
                        in
                        <a
                            href="/posts?category={{ $popularPosts[0]->category->slug }}"
                            class="text-blue-600 hover:underline"
                        >
                            {{ $popularPosts[0]->category->name }}
                        </a>
                        • {{ $popularPosts[0]->created_at->diffForHumans() }}
                    </p>
                    {{-- Displays the author, category, and relative creation time of the featured post. --}}

                    <p class="mb-4 text-gray-700">
                        {{ $popularPosts[0]->excerpt }}
                    </p>
                    {{-- Displays a short excerpt of the featured post. --}}

                    <a
                        href="/posts/{{ $popularPosts[0]->slug }}"
                        class="inline-block rounded bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700"
                    >
                        Read more
                    </a>
                    {{-- Button linking to the full details of the featured post. --}}
                </div>
            </div>

            {{-- Other Posts Grid --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($popularPosts->skip(1) as $index => $post)
                    <div
                        class="flex flex-col overflow-hidden rounded-2xl bg-white shadow transition hover:shadow-lg"
                    >
                        <div class="relative">
                            <div
                                class="absolute top-0 left-0 z-[1] bg-black/70 px-3 py-1 text-white"
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
                                    class="hover:underline"
                                >
                                    {{ $post->title }}
                                </a>
                            </h5>
                            {{-- Displays the title of the post with a link to its details. --}}

                            <p class="mb-2 text-sm text-gray-500">
                                By
                                <a
                                    href="/posts?author={{ $post->author->username }}"
                                    class="text-blue-600 hover:underline"
                                >
                                    {{ $post->author->name }}
                                </a>
                                • {{ $post->created_at->diffForHumans() }}
                            </p>
                            {{-- Displays the author and relative creation time of the post. --}}

                            <p class="mb-4 flex-grow text-gray-700">
                                {{ $post->excerpt }}
                            </p>
                            {{-- Displays a short excerpt of the post. --}}

                            <button class="mt-auto flex justify-start">
                                <a
                                    href="/posts/{{ $post->slug }}"
                                    class="inline-block rounded bg-blue-600 px-3 py-1 text-white transition hover:bg-blue-700"
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
            <p class="text-center text-lg text-gray-500">No post found.</p>
            {{-- Displays a message if no posts are available. --}}
        @endif
    </section>
@endsection
