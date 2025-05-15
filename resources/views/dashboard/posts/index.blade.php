@extends("dashboard.layouts.main")
<!-- Extends the main layout for the dashboard -->

@section("container")
    <!-- Defines the content for the 'container' section in the layout -->
    <div class="mb-6 flex flex-wrap items-center justify-between border-b pb-4">
        <!-- Container for the header section -->
        <h1 class="text-light-text-primary text-2xl font-semibold">My Posts</h1>
        <!-- Displays the page title -->
        <a
            href="/dashboard/posts/create"
            class="bg-light-background-primary text-light-text-secondary hover:bg-light-background-hover hover:text-light-text-primary inline-flex items-center rounded px-4 py-2 text-sm font-medium"
        >
            <span data-feather="plus" class="mr-2 h-4 w-4"></span>
            Create new post
        </a>
    </div>

    @if (session()->has("success"))
        <!-- Checks if there is a success message in the session -->
        <div
            class="bg-light-success-background text-light-success-text mb-4 rounded px-4 py-2"
        >
            <!-- Displays the success message -->
            {{ session("success") }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <!-- Wrapper for the table to enable horizontal scrolling -->
        <table
            class="divide-light-border-secondary min-w-full divide-y text-sm"
        >
            <thead
                class="bg-light-background-secondary text-light-text-primary text-left"
            >
                <tr>
                    <th class="px-4 py-2 font-semibold">No.</th>
                    <th class="px-4 py-2 font-semibold">Title</th>
                    <th class="px-4 py-2 font-semibold">Kategori</th>
                    <th class="px-4 py-2 font-semibold">Action</th>
                </tr>
            </thead>
            <tbody class="divide-light-border-secondary divide-y">
                @foreach ($posts as $post)
                    <!-- Loops through the posts collection -->
                    <tr>
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $post->title }}</td>
                        <td class="px-4 py-2">{{ $post->category->name }}</td>
                        <td class="space-x-2 px-4 py-2">
                            <a
                                href="/dashboard/posts/{{ $post->slug }}"
                                class="bg-light-background-hover text-light-text-primary hover:bg-light-background-primary hover:text-light-text-secondary inline-flex items-center rounded px-2 py-1"
                            >
                                <span data-feather="eye" class="h-4 w-4"></span>
                            </a>
                            <a
                                href="/dashboard/posts/{{ $post->slug }}/edit"
                                class="bg-light-background-hover text-light-text-primary hover:bg-light-background-primary hover:text-light-text-secondary inline-flex items-center rounded px-2 py-1"
                            >
                                <span
                                    data-feather="edit"
                                    class="h-4 w-4"
                                ></span>
                            </a>
                            <form
                                action="/dashboard/posts/{{ $post->slug }}"
                                method="post"
                                class="inline"
                                onsubmit="return confirm('Are you sure to delete this post?')"
                            >
                                @method("delete")
                                <!-- Specifies the HTTP method as DELETE -->
                                @csrf
                                <!-- CSRF token for security -->
                                <button
                                    type="submit"
                                    class="bg-light-error-background text-light-error-text hover:bg-light-error-border hover:text-light-text-secondary inline-flex cursor-pointer items-center rounded border-0 px-2 py-1"
                                >
                                    <span
                                        data-feather="trash-2"
                                        class="h-4 w-4"
                                    ></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
