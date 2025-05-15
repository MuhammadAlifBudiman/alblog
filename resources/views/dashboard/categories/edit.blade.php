@extends("dashboard.layouts.main")

@section("container")
    <div class="mx-auto max-w-3xl">
        <h1 class="text-light-text-primary mb-6 text-2xl font-semibold">
            Edit Category
        </h1>

        <form
            method="post"
            action="/dashboard/categories/{{ $category->slug }}"
            class="space-y-6"
        >
            @method("put")
            @csrf

            <div>
                <label
                    for="name"
                    class="text-light-text-primary block text-sm font-medium"
                >
                    Category Name
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old("name", $category->name) }}"
                    required
                    @class([
                        "focus:shadow-outline block w-full rounded border px-3 py-2 shadow-sm focus:outline-none",
                        "border-light-border-secondary" => ! $errors->has("name"),
                        "border-light-error-border" => $errors->has("name"),
                    ])
                />
                @error("name")
                    <p class="text-light-error-text mt-1 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label
                    for="slug"
                    class="text-light-text-primary block text-sm font-medium"
                >
                    Slug
                </label>
                <input
                    type="text"
                    name="slug"
                    id="slug"
                    value="{{ old("slug", $category->slug) }}"
                    required
                    @class([
                        "focus:shadow-outline block w-full rounded border px-3 py-2 shadow-sm focus:outline-none",
                        "border-light-border-secondary" => ! $errors->has("slug"),
                        "border-light-error-border" => $errors->has("slug"),
                    ])
                />
                @error("slug")
                    <p class="text-light-error-text mt-1 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button
                type="submit"
                class="bg-light-background-primary text-light-text-secondary hover:bg-light-background-hover hover:text-light-text-primary cursor-pointer rounded px-6 py-2 focus:outline-none"
            >
                Update Category
            </button>
        </form>
    </div>
@endsection
