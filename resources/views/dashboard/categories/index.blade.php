@extends("dashboard.layouts.main")

@section("container")
    <div
        class="mb-3 flex flex-wrap items-center justify-between border-b pt-3 pb-2"
    >
        <h1 class="text-light-text-primary text-2xl font-semibold">
            Post categories
        </h1>
    </div>

    <a
        href="/dashboard/categories/create"
        class="btn btn-primary bg-light-background-primary text-light-text-secondary hover:bg-light-background-hover hover:text-light-text-primary mb-3 inline-flex items-center rounded px-4 py-2"
    >
        <span data-feather="plus"></span>
        Create new category
    </a>

    @if (session()->has("success"))
        <div
            class="alert alert-success bg-light-success-background text-light-success-text mb-3 max-w-xl rounded p-4"
            role="alert"
        >
            {{ session("success") }}
        </div>
    @endif

    <div class="max-w-xl overflow-x-auto">
        <table
            class="border-light-border-primary min-w-full table-auto border-collapse border"
        >
            <thead class="text-light-text-primary">
                <tr class="bg-light-background-secondary">
                    <th
                        class="border-light-border-primary w-auto border px-4 py-2"
                    >
                        No.
                    </th>
                    <th
                        class="border-light-border-primary w-full border px-4 py-2"
                    >
                        Nama Kategori
                    </th>
                    <th
                        class="border-light-border-primary w-auto border px-4 py-2"
                    >
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="hover:bg-light-background-hover">
                        <td
                            class="border-light-border-primary border px-4 py-2"
                        >
                            {{ $loop->iteration }}
                        </td>
                        <td
                            class="border-light-border-primary border px-4 py-2"
                        >
                            {{ $category->name }}
                        </td>
                        <td
                            class="border-light-border-primary border px-4 py-2"
                        >
                            <div class="flex space-x-2">
                                <a
                                    href="/dashboard/categories/{{ $category->slug }}/edit"
                                    class="text-light-text-primary inline-flex items-center justify-center hover:underline"
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
                                        onclick="return confirm('Are you sure to delete this category?')"
                                        class="text-light-error-text inline-flex cursor-pointer items-center border-0 bg-transparent hover:underline"
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
