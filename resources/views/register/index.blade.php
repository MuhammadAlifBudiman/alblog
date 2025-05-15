@extends("layouts.main")
{{-- Extends the main layout to maintain a consistent structure and design across the application. --}}

@section("container")
    {{-- Defines the "container" section to inject content into the main layout. --}}

    <div class="flex justify-center">
        {{-- Centers the registration form horizontally on the page. --}}

        <div class="w-full max-w-lg">
            {{-- Limits the width of the form to ensure it is visually appealing and responsive. --}}

            <main class="mb-4 rounded px-8 pt-6 pb-8 shadow-md">
                {{-- Creates a visually distinct card-like container for the form with padding, shadow, and rounded corners. --}}

                <h1 class="mb-6 text-center text-2xl font-semibold">
                    Registration Form
                </h1>
                {{-- Displays the title of the form prominently at the top. --}}

                <form action="/register" method="post">
                    {{-- Specifies the form's action URL and method for submitting registration data. --}}

                    @csrf
                    {{-- Includes a CSRF token for security to prevent cross-site request forgery attacks. --}}

                    {{-- Name --}}
                    <div class="mb-4">
                        {{-- Creates a container for the "Name" input field with margin for spacing. --}}

                        <label
                            for="name"
                            class="text-light-text-primary mb-2 block text-sm font-bold"
                        >
                            Name
                        </label>
                        {{-- Provides a label for the "Name" input field for accessibility and clarity. --}}

                        <input
                            type="text"
                            name="name"
                            id="name"
                            placeholder="Name"
                            required
                            value="{{ old("name") }}"
                            @class([
                                "focus:shadow-outline text-light-text-primary/70 w-full appearance-none rounded border px-3 py-2 leading-tight shadow focus:outline-none",
                                "border-light-error-border" => $errors->has("name"),
                            ])
                        />
                        {{--
                            Creates a text input for the user's name with validation and styling.
                            The "old" helper retains the previous input value in case of validation errors.
                            The "border-light-error-border" class highlights the field if there are validation errors.
                        --}}

                        @error("name")
                            <p
                                class="text-light-error-text mt-2 text-xs italic"
                            >
                                {{ $message }}
                            </p>
                        @enderror

                        {{-- Displays an error message if validation for the "Name" field fails. --}}
                    </div>

                    {{-- Username --}}
                    <div class="mb-4">
                        {{-- Creates a container for the "Username" input field with margin for spacing. --}}

                        <label
                            for="username"
                            class="text-light-text-primary mb-2 block text-sm font-bold"
                        >
                            Username
                        </label>
                        {{-- Provides a label for the "Username" input field for accessibility and clarity. --}}

                        <input
                            type="text"
                            name="username"
                            id="username"
                            placeholder="Username"
                            required
                            value="{{ old("username") }}"
                            @class([
                                "focus:shadow-outline text-light-text-primary/70 w-full appearance-none rounded border px-3 py-2 leading-tight shadow focus:outline-none",
                                "border-light-error-border" => $errors->has("username"),
                            ])
                        />
                        {{--
                            Creates a text input for the user's username with validation and styling.
                            The "old" helper retains the previous input value in case of validation errors.
                            The "border-light-error-border" class highlights the field if there are validation errors.
                        --}}

                        @error("username")
                            <p
                                class="text-light-error-text mt-2 text-xs italic"
                            >
                                {{ $message }}
                            </p>
                        @enderror

                        {{-- Displays an error message if validation for the "Username" field fails. --}}
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        {{-- Creates a container for the "Email" input field with margin for spacing. --}}

                        <label
                            for="email"
                            class="text-light-text-primary mb-2 block text-sm font-bold"
                        >
                            Email address
                        </label>
                        {{-- Provides a label for the "Email" input field for accessibility and clarity. --}}

                        <input
                            type="email"
                            name="email"
                            id="email"
                            placeholder="name@example.com"
                            required
                            value="{{ old("email") }}"
                            @class([
                                "focus:shadow-outline text-light-text-primary/70 w-full appearance-none rounded border px-3 py-2 leading-tight shadow focus:outline-none",
                                "border-light-error-border" => $errors->has("email"),
                            ])
                        />
                        {{--
                            Creates an email input for the user's email address with validation and styling.
                            The "old" helper retains the previous input value in case of validation errors.
                            The "border-light-error-border" class highlights the field if there are validation errors.
                        --}}

                        @error("email")
                            <p
                                class="text-light-error-text mt-2 text-xs italic"
                            >
                                {{ $message }}
                            </p>
                        @enderror

                        {{-- Displays an error message if validation for the "Email" field fails. --}}
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        {{-- Creates a container for the "Password" input field with margin for spacing. --}}

                        <label
                            for="password"
                            class="text-light-text-primary mb-2 block text-sm font-bold"
                        >
                            Password
                        </label>
                        {{-- Provides a label for the "Password" input field for accessibility and clarity. --}}

                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Password"
                            required
                            @class([
                                "focus:shadow-outline text-light-text-primary/70 w-full appearance-none rounded border px-3 py-2 leading-tight shadow focus:outline-none",
                                "border-light-error-border" => $errors->has("password"),
                            ])
                        />
                        {{--
                            Creates a password input for the user's password with validation and styling.
                            The "border-light-error-border" class highlights the field if there are validation errors.
                        --}}

                        @error("password")
                            <p
                                class="text-light-error-text mt-2 text-xs italic"
                            >
                                {{ $message }}
                            </p>
                        @enderror

                        {{-- Displays an error message if validation for the "Password" field fails. --}}
                    </div>

                    <button
                        type="submit"
                        class="bg-light-background-primary text-light-text-secondary hover:bg-light-background-hover hover:text-light-text-primary w-full cursor-pointer rounded px-4 py-2 font-bold"
                    >
                        Register
                    </button>
                    {{-- Adds a submit button styled with a blue background and hover effect. --}}
                </form>

                <p class="mt-4 text-center text-sm">
                    Already registered?
                    <a
                        href="/login"
                        class="text-light-background-primary hover:underline"
                    >
                        Login
                    </a>
                </p>
                {{-- Provides a link to the login page for users who already have an account. --}}
            </main>
        </div>
    </div>
@endsection

{{-- Ends the "container" section. --}}
