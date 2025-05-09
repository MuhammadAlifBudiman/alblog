<nav
    class="bg-light-background-primary mx-auto grid grid-cols-[1fr_3fr] items-center justify-items-end px-4 py-3 text-white md:justify-items-normal"
>
    <!-- The main navigation container with styling for layout, colors, and responsiveness -->
    <div class="text-lg text-[1.3em] font-bold">
        <a href="/"><h1>AlBlog</h1></a>
        <!-- Logo or title of the website linking to the homepage -->
    </div>

    {{-- Hamburger Button --}}
    <div
        class="hamburger relative z-[2] flex h-[20px] flex-col justify-between md:hidden"
    >
        <!-- Hamburger button for mobile view, hidden on larger screens -->
        <input
            type="checkbox"
            class="peer absolute top-[-4px] left-[-6px] z-[999] h-[28px] w-[40px] cursor-pointer opacity-0"
        />
        <!-- Checkbox to toggle the hamburger menu -->
        <span
            class="block h-[3px] w-[28px] origin-[0_0] rounded-[3px] bg-white transition-all duration-500 peer-checked:-translate-x-[1px] peer-checked:-translate-y-[1px] peer-checked:rotate-45"
        ></span>
        <!-- Top bar of the hamburger icon with animation for open/close -->
        <span
            class="block h-[3px] w-[28px] rounded-[3px] bg-white transition-all duration-500 peer-checked:scale-0 peer-checked:opacity-0"
        ></span>
        <!-- Middle bar of the hamburger icon, hidden when menu is open -->
        <span
            class="block h-[3px] w-[28px] origin-[0_100%] rounded-[3px] bg-white transition-all duration-500 peer-checked:-translate-x-[1px] peer-checked:translate-y-0 peer-checked:-rotate-45"
        ></span>
        <!-- Bottom bar of the hamburger icon with animation for open/close -->
    </div>

    {{-- Hamburger Menu --}}
    <ul
        class="md:tranfrom-none bg-light-background-primary absolute top-0 right-0 z-[1] flex h-screen w-full -translate-y-full transform flex-col items-center justify-evenly opacity-0 transition-all duration-1000 ease-in-out md:static md:grid md:h-auto md:w-auto md:-translate-y-0 md:transform-none md:grid-cols-[repeat(auto-fit,minmax(0,auto))] md:items-center md:gap-[5px] md:bg-transparent md:opacity-100 md:transition-none"
    >
        <!-- The navigation menu, styled for both mobile and desktop views -->
        <li class="w-fit">
            <a
                href="/"
                class="{{ Request::path() === "/" ? "font-semibold underline" : "" }}"
            >
                Home
            </a>
            <!-- Link to the homepage with conditional styling for active state -->
        </li>
        <li class="w-fit">
            <a
                href="/about"
                class="{{ Request::is("about") ? "font-semibold underline" : "" }} md:block"
            >
                About
            </a>
            <!-- Link to the About page with conditional styling for active state -->
        </li>
        <li class="w-fit">
            <a
                href="/posts"
                class="{{ Request::is("posts*") ? "font-semibold underline" : "" }}"
            >
                Blog
            </a>
            <!-- Link to the Blog page with conditional styling for active state -->
        </li>
        <li class="w-fit">
            <a
                href="/categories"
                class="{{ Request::is("categories") ? "font-semibold underline" : "" }}"
            >
                Categories
            </a>
            <!-- Link to the Categories page with conditional styling for active state -->
        </li>
        @auth
            <!-- Authenticated user-specific menu items -->
            <li
                class="relative hidden w-fit md:inline-block"
                x-data="{ dropdownOpen: false }"
            >
                <!-- Dropdown menu for desktop view -->
                <button
                    @click="dropdownOpen = !dropdownOpen"
                    class="flex cursor-pointer items-center gap-1 px-2 py-2"
                >
                    Welcome back, {{ auth()->user()->name }}
                    <!-- Greeting message with the authenticated user's name -->
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                    <!-- Downward arrow icon for dropdown -->
                </button>
                <ul
                    x-show="dropdownOpen"
                    @click.away="dropdownOpen = false"
                    x-transition:enter="transition duration-200 ease-out"
                    x-transition:enter-start="scale-95 opacity-0"
                    x-transition:enter-end="scale-100 opacity-100"
                    x-transition:leave="transition duration-150 ease-in"
                    x-transition:leave-start="scale-100 opacity-100"
                    x-transition:leave-end="scale-95 opacity-0"
                    class="absolute right-0 z-50 mt-2 w-48 rounded bg-white text-black shadow-md"
                    style="display: none"
                    {{-- This is to prevent the dropdown from showing before Alpine.js initializes --}}
                >
                    <!-- Dropdown menu items -->
                    <li>
                        <a
                            href="/dashboard"
                            class="flex items-center px-2 py-2 hover:bg-gray-100"
                        >
                            <!-- Link to the user's dashboard -->
                            <svg
                                class="mr-1 h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 12h18M3 6h18M3 18h18"
                                />
                            </svg>
                            My Dashboard
                        </a>
                    </li>
                    <li><hr class="my-1 border-t border-gray-300" /></li>
                    <!-- Divider between dropdown items -->
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="block w-full cursor-pointer px-2 py-2 text-left hover:bg-gray-100"
                            >
                                <!-- Logout button -->
                                <svg
                                    class="mr-1 inline-block h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5m0 14a9 9 0 100-18 9 9 0 000 18z"
                                    />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>

            <!-- Mobile Auth Items -->
            <li class="md:hidden">
                <a
                    href="/dashboard"
                    class="flex items-center justify-center px-2 py-2"
                >
                    <!-- Link to the user's dashboard for mobile view -->
                    <svg
                        class="mr-1 h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 12h18M3 6h18M3 18h18"
                        />
                    </svg>
                    My Dashboard
                </a>
            </li>
            <li class="md:hidden">
                <form action="/logout" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="block w-full cursor-pointer px-2 py-2 text-left"
                    >
                        <!-- Logout button for mobile view -->
                        <svg
                            class="mr-1 inline-block h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5m0 14a9 9 0 100-18 9 9 0 000 18z"
                            />
                        </svg>
                        Logout
                    </button>
                </form>
            </li>
        @else
            <!-- Guest user-specific menu items -->
            <li class="w-fit">
                <a
                    href="/login"
                    class="{{ Request::is("login") ? "font-semibold underline" : "" }} flex items-center"
                >
                    <!-- Link to the login page -->
                    <svg
                        class="mr-1 h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 12h14m-7-7l7 7-7 7"
                        />
                    </svg>
                    Login
                </a>
            </li>
        @endauth
    </ul>
</nav>
