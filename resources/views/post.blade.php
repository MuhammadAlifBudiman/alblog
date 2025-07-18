@extends("layouts/main")
<!-- This line extends the "layouts/main" layout, ensuring the page inherits the main layout structure and styles. -->

@section("container")
    <!-- This section defines the content for the "container" section in the main layout. -->

    <div class="container mx-auto px-4">
        <!-- Creates a responsive container with auto margins and padding for consistent spacing. -->

        <div class="mb-10 flex justify-center">
            <!-- Adds a margin at the bottom and centers the content horizontally using flexbox. -->

            <div class="w-full max-w-3xl">
                <!-- Sets the maximum width of the content to 3xl and ensures it takes up the full width of its container. -->

                <h1
                    class="mb-4 text-center text-3xl font-bold text-[var(--color-light-text-primary)]"
                >
                    {{ $post->title }}
                    <!-- Displays the title of the post dynamically, styled as a bold, large, centered heading. -->
                </h1>

                <p
                    class="mb-4 text-center text-[var(--color-light-text-secondary)]"
                >
                    <!-- Adds a paragraph for metadata, styled with theme variables for color and centered alignment. -->

                    By.
                    <a
                        href="/posts?author={{ $post->author->username }}"
                        class="text-[var(--color-light-background-primary)] hover:underline"
                    >
                        {{ $post->author->name }}
                        <!-- Displays the author's name as a clickable link to filter posts by the author. -->
                    </a>
                    in
                    <a
                        href="/posts?category={{ $post->category->slug }}"
                        class="text-[var(--color-light-background-primary)] hover:underline"
                    >
                        {{ $post->category->name }}
                        <!-- Displays the category name as a clickable link to filter posts by the category. -->
                    </a>
                    {{ $post->view_count }} viewed
                </p>

                <img
                    src="{{ $post->image ? Storage::url($post->image) : "https://picsum.photos/1200/400" }}"
                    class="mb-6 h-auto w-full rounded border border-[var(--color-light-border-primary)]"
                    alt="{{ $post->image ? $post->image : $post->category->name }}"
                />
                <!-- Displays the image with a dynamic source and alt text, styled with theme variables for border color. -->

                <article
                    class="prose prose-lg my-6 max-w-none text-[var(--color-light-text-primary)]"
                >
                    {!! $post->body !!}
                    <!-- Renders the post body content as HTML, styled with theme variables for text color. -->
                </article>

                <a
                    href="/posts"
                    class="mt-6 inline-block text-[var(--color-light-background-primary)] hover:underline"
                >
                    ← Back to posts
                    <!-- Provides a link to navigate back to the list of posts, styled with theme variables for text color. -->
                </a>
            </div>
        </div>
    </div>
@endsection

<!-- Ends the "container" section. -->
