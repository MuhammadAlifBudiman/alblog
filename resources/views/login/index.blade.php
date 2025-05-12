@extends("layouts.main")
<!-- Extends the main layout to inherit the base structure and styles of the application. -->

@section("container")
    <!-- Defines the content for the "container" section in the main layout. -->

    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <!-- Centers the login form and sets a maximum width for better responsiveness. -->

            @if (session()->has("success"))
                <!-- Checks if there is a "success" message in the session and displays it. -->
                <div
                    class="relative mx-4 mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700"
                    role="alert"
                >
                    {{ session("success") }}
                    <!-- Displays the success message stored in the session. -->
                    <button
                        type="button"
                        class="absolute top-0 right-0 bottom-0 cursor-pointer px-4 py-3"
                        onclick="this.parentElement.remove()"
                        aria-label="Close"
                    >
                        <!-- Adds a close button to dismiss the success alert. -->
                        <svg
                            class="h-6 w-6 fill-current text-green-500"
                            role="button"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <title>Close</title>
                            <path
                                d="M14.348 5.652a1 1 0 00-1.414-1.414L10 7.172 7.066 4.238A1 1 0 105.652 5.652L8.586 8.586 5.652 11.52a1 1 0 101.414 1.414L10 9.828l2.934 2.934a1 1 0 001.414-1.414L11.414 8.586l2.934-2.934z"
                            />
                            <!-- SVG icon for the close button. -->
                        </svg>
                    </button>
                </div>
            @endif

            @if (session()->has("loginError"))
                <!-- Checks if there is a "loginError" message in the session and displays it. -->
                <div
                    class="relative mx-4 mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
                    role="alert"
                >
                    {{ session("loginError") }}
                    <!-- Displays the login error message stored in the session. -->
                    <button
                        type="button"
                        class="absolute top-0 right-0 bottom-0 cursor-pointer px-4 py-3"
                        onclick="this.parentElement.remove()"
                        aria-label="Close"
                    >
                        <!-- Adds a close button to dismiss the error alert. -->
                        <svg
                            class="h-6 w-6 fill-current text-red-500"
                            role="button"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <title>Close</title>
                            <path
                                d="M14.348 5.652a1 1 0 00-1.414-1.414L10 7.172 7.066 4.238A1 1 0 105.652 5.652L8.586 8.586 5.652 11.52a1 1 0 101.414 1.414L10 9.828l2.934 2.934a1 1 0 001.414-1.414L11.414 8.586l2.934-2.934z"
                            />
                            <!-- SVG icon for the close button. -->
                        </svg>
                    </button>
                </div>
            @endif

            <main class="mb-4 rounded bg-white px-8 pt-6 pb-8 shadow-md">
                <!-- Main container for the login form with styling for spacing, background, and shadow. -->
                <h1 class="mb-6 text-center text-2xl font-semibold">
                    Please login
                    <!-- Displays the heading for the login form. -->
                </h1>
                <form action="/login" method="post">
                    @csrf
                    <!-- Adds a CSRF token for security to prevent cross-site request forgery. -->
                    <div class="mb-4">
                        <label
                            class="mb-2 block text-sm font-bold text-gray-700"
                            for="email"
                        >
                            Email address
                            <!-- Label for the email input field. -->
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            @class([
                                "focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none",
                                "border-red-500" => $errors->has("email"),
                            ])
                            placeholder="name@example.com"
                            autofocus
                            required
                            value="{{ old("email") }}"
                        />
                        <!-- Input field for the email address with validation and old value persistence. -->

                        @error("email")
                            <p class="mt-2 text-xs text-red-500 italic">
                                {{ $message }}
                                <!-- Displays validation error message for the email field. -->
                            </p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label
                            class="mb-2 block text-sm font-bold text-gray-700"
                            for="password"
                        >
                            Password
                            <!-- Label for the password input field. -->
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="focus:shadow-outline mb-3 w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                            placeholder="Password"
                            required
                        />
                        <!-- Input field for the password. -->
                    </div>

                    <div class="flex items-center justify-between">
                        <button
                            class="w-full cursor-pointer rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                            type="submit"
                        >
                            Login
                            <!-- Submit button for the login form. -->
                        </button>
                    </div>
                </form>
                <p class="mt-4 text-center text-sm">
                    Not registered?
                    <a href="/register" class="text-blue-500 hover:underline">
                        Register Now!
                        <!-- Link to the registration page for new users. -->
                    </a>
                </p>
            </main>
        </div>
    </div>
@endsection

<!-- Ends the "container" section. -->
