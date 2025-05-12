@extends("dashboard.layouts.main")

@section("container")
    <div
        class="mb-3 flex flex-wrap items-center justify-between border-b pt-3 pb-2"
    >
        <h1 class="text-2xl font-semibold">Welcome back, {{ $user->name }}</h1>
    </div>

    <!-- User Information -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold">Your Information</h2>
        <ul class="list-disc space-y-2 pl-5">
            <li>
                <strong>Email:</strong>
                {{ $user->email }}
            </li>
            <li>
                <strong>Role:</strong>
                {{ $user->is_admin ? "Admin" : "User" }}
            </li>
        </ul>
    </div>

    <!-- Statistics/Analytics -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold">Statistics</h2>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div
                class="rounded bg-gray-100 p-4 shadow transition-shadow hover:shadow-lg"
            >
                <h3 class="text-lg font-medium">Total Posts Created</h3>
                <p class="text-2xl font-bold text-blue-600">
                    {{ $statistics["totalPostsUser"] }}
                </p>
            </div>
            <div
                class="rounded bg-gray-100 p-4 shadow transition-shadow hover:shadow-lg"
            >
                <h3 class="text-lg font-medium">Total Posts Viewed</h3>
                <p class="text-2xl font-bold text-blue-600">
                    {{ $statistics["totalViewsUser"] }}
                </p>
            </div>

            @if ($user->is_admin)
                <div
                    class="rounded bg-gray-100 p-4 shadow transition-shadow hover:shadow-lg"
                >
                    <h3 class="text-lg font-medium">Total Posts</h3>
                    <p class="text-2xl font-bold text-blue-600">
                        {{ $statistics["totalAllPosts"] }}
                    </p>
                </div>
                <div
                    class="rounded bg-gray-100 p-4 shadow transition-shadow hover:shadow-lg"
                >
                    <h3 class="text-lg font-medium">Total Categories</h3>
                    <p class="text-2xl font-bold text-blue-600">
                        {{ $statistics["totalAllCategories"] }}
                    </p>
                </div>
                <div
                    class="rounded bg-gray-100 p-4 shadow transition-shadow hover:shadow-lg"
                >
                    <h3 class="text-lg font-medium">Total Users</h3>
                    <p class="text-2xl font-bold text-blue-600">
                        {{ $statistics["totalAllUsers"] }}
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold">Recent Activity</h2>
        <ul class="list-disc space-y-2 pl-5">
            @foreach ($recentPosts as $post)
                <li>
                    <a
                        href="{{ route("posts.show", $post->id) }}"
                        class="text-blue-500 hover:underline"
                    >
                        {{ $post->title }}
                    </a>
                    <span class="text-sm text-gray-600">
                        - {{ $post->created_at->diffForHumans() }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
