@extends("dashboard.layouts.main")
<!-- Extends the main layout for the dashboard -->

@section("container")
    <!-- Defines the content for the 'container' section in the layout -->
    <div class="mb-6 flex flex-wrap items-center justify-between border-b pb-4">
        <!-- Container for the header section -->
        <h1 class="text-2xl font-semibold text-gray-800">My Posts</h1>
        <!-- Displays the page title -->
        <a
            href="/dashboard/posts/create"
            class="inline-flex items-center rounded bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700"
        >
            <span data-feather="plus" class="mr-2 h-4 w-4"></span>
            Create new post
        </a>
    </div>

    @if (session()->has("success"))
        <!-- Checks if there is a success message in the session -->
        <div class="mb-4 rounded bg-green-100 px-4 py-2 text-green-800">
            <!-- Displays the success message -->
            {{ session("success") }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <!-- Wrapper for the table to enable horizontal scrolling -->
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100 text-left text-gray-700">
                <tr>
                    <th class="px-4 py-2 font-semibold">No.</th>
                    <th class="px-4 py-2 font-semibold">Title</th>
                    <th class="px-4 py-2 font-semibold">Kategori</th>
                    <th class="px-4 py-2 font-semibold">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($posts as $post)
                    <!-- Loops through the posts collection -->
                    <tr>
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $post->title }}</td>
                        <td class="px-4 py-2">{{ $post->category->name }}</td>
                        <td class="space-x-2 px-4 py-2">
                            <a
                                href="/dashboard/posts/{{ $post->slug }}"
                                class="inline-flex items-center rounded bg-blue-100 px-2 py-1 text-blue-600 hover:bg-blue-200"
                            >
                                <span data-feather="eye" class="h-4 w-4"></span>
                            </a>
                            <a
                                href="/dashboard/posts/{{ $post->slug }}/edit"
                                class="inline-flex items-center rounded bg-yellow-100 px-2 py-1 text-yellow-700 hover:bg-yellow-200"
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
                                    class="inline-flex cursor-pointer items-center rounded border-0 bg-red-100 px-2 py-1 text-red-600 hover:bg-red-200"
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
