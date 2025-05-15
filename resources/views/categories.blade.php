@extends("layouts.main")
{{-- Extends the main layout to maintain consistent structure and styling across pages --}}

@section("container")
    {{-- Defines the content section for the page --}}
    <h1 class="text-light-text-primary mb-6 text-center text-3xl font-bold">
        Post Categories
    </h1>
    {{-- Displays the page title with styling --}}

    <div class="mx-2 mb-5 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        {{-- Creates a responsive grid layout for categories --}}
        @foreach ($categories as $index => $category)
            {{-- Loops through the categories to display each one --}}
            <a
                href="/posts?category={{ $category->slug }}"
                {{-- Generates a link to filter posts by category --}}
                class="group bg-light-background-secondary hover:bg-light-background-hover block overflow-hidden rounded-lg shadow-lg"
                {{-- Adds styling for the category card --}}
            >
                <div class="relative">
                    {{-- Wraps the image and overlay for positioning --}}
                    <img
                        src="https://picsum.photos/500/500?random={{ $index + 1 }}"
                        alt="{{ $category->name }}"
                        class="h-64 w-full object-cover transition-transform duration-300 group-hover:scale-105"
                    />
                    <div
                        class="bg-light-background-primary/30 absolute inset-0 flex items-center justify-center"
                    >
                        <h5
                            class="text-light-text-secondary px-4 text-center text-2xl font-semibold"
                        >
                            {{ $category->name }}
                        </h5>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
