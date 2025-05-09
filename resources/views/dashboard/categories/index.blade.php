@extends("dashboard.layouts.main")

@section("container")
    <div
        class="mb-3 flex flex-wrap items-center justify-between border-b pt-3 pb-2"
    >
        <h1 class="text-2xl font-semibold">Post categories</h1>
    </div>

    <a
        href="/dashboard/categories/create"
        class="btn btn-primary mb-3 inline-flex items-center rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
    >
        <span data-feather="plus"></span>
        Create new category
    </a>

    @if (session()->has("success"))
        <div
            class="alert alert-success mb-3 max-w-xl rounded bg-green-100 p-4 text-green-800"
            role="alert"
        >
            {{ session("success") }}
        </div>
    @endif

    <div class="max-w-xl overflow-x-auto">
        <table
            class="min-w-full table-auto border-collapse border border-gray-300"
        >
            <thead>
                <tr class="bg-gray-200">
                    <th class="w-auto border border-gray-300 px-4 py-2">No.</th>
                    <th class="w-full border border-gray-300 px-4 py-2">
                        Nama Kategori
                    </th>
                    <th class="w-auto border border-gray-300 px-4 py-2">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $category->name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <div class="flex space-x-2">
                                <a
                                    href="/dashboard/categories/{{ $category->slug }}"
                                    class="inline-flex items-center justify-center text-blue-500 hover:underline"
                                >
                                    <span data-feather="eye"></span>
                                </a>
                                <a
                                    href="/dashboard/categories/{{ $category->slug }}/edit"
                                    class="inline-flex items-center justify-center text-yellow-500 hover:underline"
                                >
                                    <span data-feather="edit"></span>
                                </a>
                                <form
                                    action="/dashboard/categories/{{ $category->slug }}"
                                    method="post"
                                    class="inline"
                                >
                                    @method("delete")
                                    @csrf
                                    <button
                                        onclick="return confirm('Are you sure to delete this post?')"
                                        class="inline-flex cursor-pointer items-center border-0 bg-transparent text-red-500 hover:underline"
                                    >
                                        <span data-feather="trash-2"></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
