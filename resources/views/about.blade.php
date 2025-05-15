@extends("layouts.main")

@section("container")
    <div class="text-center">
        <h1 class="text-light-text-primary mb-4 text-3xl font-bold">
            Halaman About
        </h1>
        <h3 class="text-light-text-primary/70 text-xl font-semibold">
            {{ $name }}
        </h3>
        <p class="text-light-text-muted">
            {{ $email }}
        </p>
        <img
            src="{{ asset("img/" . $image) }}"
            alt="{{ $name }}"
            class="border-light-border-primary mx-auto mt-4 h-48 w-48 rounded-full border-2 object-cover object-top"
        />
    </div>
@endsection
