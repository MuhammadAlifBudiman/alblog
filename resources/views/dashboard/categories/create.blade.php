@extends("dashboard.layouts.main")

@section("container")
    <div class="mx-auto max-w-3xl">
        <h1 class="mb-6 text-2xl font-semibold text-gray-800">
            Create New Category
        </h1>

        <form method="post" action="/dashboard/categories" class="space-y-6">
            @csrf

            <div>
                <label
                    for="name"
                    class="block text-sm font-medium text-gray-700"
                >
                    Category Name
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old("name") }}"
                    required
                    @class([
                        "mt-1 block w-full rounded-md border px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500",
                        "border-gray-300" => ! $errors->has("name"),
                        "border-red-500" => $errors->has("name"),
                    ])
                />
                @error("name")
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label
                    for="slug"
                    class="block text-sm font-medium text-gray-700"
                >
                    Slug
                </label>
                <input
                    type="text"
                    name="slug"
                    id="slug"
                    value="{{ old("slug") }}"
                    required
                    @class([
                        "mt-1 block w-full rounded-md border px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500",
                        "border-gray-300" => ! $errors->has("slug"),
                        "border-red-500" => $errors->has("slug"),
                    ])
                />
                @error("slug")
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="inline-flex cursor-pointer items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
            >
                Create Category
            </button>
        </form>
    </div>

    <script>
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function () {
            fetch('/dashboard/categories/checkSlug?name=' + name.value)
                .then((response) => response.json())
                .then((data) => (slug.value = data.slug));
        });
    </script>
@endsection
