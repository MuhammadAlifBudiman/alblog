@extends("dashboard.layouts.main")

@section("container")
    <div
        class="mb-6 flex flex-wrap items-center justify-between border-b pt-6 pb-4"
    >
        <h1 class="text-2xl font-semibold text-gray-800">Edit Post</h1>
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
                <label for="title" class="mb-1 block font-medium text-gray-700">
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
                        "block w-full rounded border px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none",
                        "border-gray-300" => ! $errors->has("title"),
                        "border-red-500" => $errors->has("title"),
                    ])
                />
                @error("title")
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="mb-1 block font-medium text-gray-700">
                    Slug
                </label>
                <input
                    type="text"
                    name="slug"
                    id="slug"
                    value="{{ old("slug", $post->slug) }}"
                    required
                    @class([
                        "block w-full rounded border px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none",
                        "border-gray-300" => ! $errors->has("slug"),
                        "border-red-500" => $errors->has("slug"),
                    ])
                />
                @error("slug")
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label
                    for="category_id"
                    class="mb-1 block font-medium text-gray-700"
                >
                    Category
                </label>
                <select
                    name="category_id"
                    id="category_id"
                    required
                    @class([
                        "block w-full rounded border px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:outline-none",
                        "border-gray-300" => ! $errors->has("category_id"),
                        "border-red-500" => $errors->has("category_id"),
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
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div>
                <label for="image" class="mb-1 block font-medium text-gray-700">
                    Post Image
                </label>
                <input
                    type="hidden"
                    name="oldImage"
                    value="{{ $post->image }}"
                />

                @if ($post->image)
                    <img
                        src="{{ Storage::disk("s3")->url($post->image) }}"
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
                        "block w-full cursor-pointer text-sm text-gray-700 file:mr-4 file:rounded file:border-0 file:bg-indigo-600 file:px-4 file:py-2 file:text-white hover:file:bg-indigo-700",
                        "border-gray-300" => ! $errors->has("image"),
                        "border-red-500" => $errors->has("image"),
                    ])
                />
                @error("image")
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Body --}}
            <div>
                <label for="body" class="mb-1 block font-medium text-gray-700">
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
                    class="trix-content rounded border border-gray-300 bg-white focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                ></trix-editor>
                @error("body")
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="cursor-pointer rounded bg-indigo-600 px-6 py-2 text-white hover:bg-indigo-700 focus:ring focus:ring-indigo-300 focus:outline-none"
            >
                Update
            </button>
        </form>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function () {
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
                .then((response) => response.json())
                .then((data) => (slug.value = data.slug));
        });

        document.addEventListener('trix-file-accept', function (e) {
            e.preventDefault();
        });

        function priviewImage() {
            const image = document.querySelector('#image');
            const imgPriview = document.querySelector('.img-priview');

            imgPriview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function (oFREvent) {
                imgPriview.src = oFREvent.target.result;
            };
        }
    </script>
@endsection
