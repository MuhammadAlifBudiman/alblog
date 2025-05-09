@extends("dashboard.layouts.main")

@section("container")
    <div
        class="mb-3 flex flex-wrap items-center justify-between border-b pt-3 pb-2"
    >
        <h1 class="text-2xl font-semibold">
            Welcome back, {{ auth()->user()->name }}
        </h1>
    </div>
@endsection
