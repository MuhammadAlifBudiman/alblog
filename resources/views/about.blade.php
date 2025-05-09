@extends("layouts.main")

@section("container")
    <div class="text-center">
        <h1 class="mb-4 text-3xl font-bold">Halaman About</h1>
        <h3 class="text-xl font-semibold">{{ $name }}</h3>
        <p class="text-gray-600">{{ $email }}</p>
        <img
            src="{{ asset("img/" . $image) }}"
            alt="{{ $name }}"
            class="mx-auto mt-4 h-48 w-48 rounded-full border-2 border-gray-300 object-cover object-top"
        />
    </div>
@endsection
