@extends("dashboard.layouts.main")

@section("container")
    <div
        class="mb-6 flex flex-wrap items-center justify-between border-b pt-6 pb-4"
    >
        <h1 class="text-light-text-primary text-2xl font-semibold">
            Edit Post
        </h1>
    </div>

    <div class="max-w-3xl">
        <form
            method="POST"
            action="/dashboard/posts/{{ $post->slug }}"
            enctype="multipart/form-data"
            class="space-y-6"
        >
            @method("put")
            @csrf

            {{-- Title --}}
            <div>
                <label
                    for="title"
                    class="text-light-text-primary mb-1 block font-medium"
                >
                    Title
                </label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old("title", $post->title) }}"
                    required
                    autofocus
                    @class([
                        "focus:shadow-outline block w-full rounded border px-3 py-2 shadow-sm focus:outline-none",
                        "border-light-border-secondary" => ! $errors->has("title"),
                        "border-light-error-border" => $errors->has("title"),
                    ])
                />
                @error("title")
                    <p class="text-light-error-text mt-1 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label
                    for="slug"
                    class="text-light-text-primary mb-1 block font-medium"
                >
                    Slug
                </label>
                <input
                    type="text"
                    name="slug"
                    id="slug"
                    value="{{ old("slug", $post->slug) }}"
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

            {{-- Category --}}
            <div>
                <label
                    for="category_id"
                    class="text-light-text-primary mb-1 block font-medium"
                >
                    Category
                </label>
                <select
                    name="category_id"
                    id="category_id"
                    required
                    @class([
                        "focus:shadow-outline block w-full rounded border px-3 py-2 shadow-sm focus:outline-none",
                        "border-light-border-secondary" => ! $errors->has("category_id"),
                        "border-light-error-border" => $errors->has("category_id"),
                    ])
                >
                    <option value="">--Pilih Kategori--</option>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old("category_id", $post->category_id) == $category->id ? "selected" : "" }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error("category_id")
                    <p class="text-light-error-text mt-1 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Image --}}
            <div>
                <label
                    for="image"
                    class="text-light-text-primary mb-1 block font-medium"
                >
                    {{-- Image --}}
                    Post Image
                </label>
                <input
                    type="hidden"
                    name="oldImage"
                    value="{{ $post->image }}"
                />

                @if ($post->image)
                    <img
                        src="{{ Storage::url($post->image) }}"
                        class="img-priview mb-3 block max-h-64 rounded border"
                    />
                @else
                    <img
                        class="img-priview mb-3 hidden max-h-64 rounded border"
                    />
                @endif

                <input
                    type="file"
                    name="image"
                    id="image"
                    onchange="priviewImage()"
                    @class([
                        "file:bg-light-background-primary file:text-light-text-secondary hover:file:bg-light-background-hover hover:file:text-light-text-primary block w-full cursor-pointer text-sm file:mr-4 file:rounded file:border-0 file:px-4 file:py-2",
                        "border-light-border-secondary" => ! $errors->has("image"),
                        "border-light-error-border" => $errors->has("image"),
                    ])
                />
                @error("image")
                    <p class="text-light-error-text mt-1 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Body --}}
            <div>
                <label
                    for="body"
                    class="text-light-text-primary mb-1 block font-medium"
                >
                    Body
                </label>
                <input
                    id="body"
                    type="hidden"
                    name="body"
                    value="{{ old("body", $post->body) }}"
                />
                <trix-editor
                    input="body"
                    class="trix-content border-light-border-secondary focus:shadow-outline bg-light-background-secondary text-light-text-primary block rounded border"
                ></trix-editor>
                @error("body")
                    <p class="text-light-error-text mt-1 text-sm">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button
                type="submit"
                class="bg-light-background-primary text-light-text-secondary hover:bg-light-background-hover hover:text-light-text-primary cursor-pointer rounded px-6 py-2 focus:outline-none"
            >
                Update
            </button>
        </form>
    </div>
@endsection
