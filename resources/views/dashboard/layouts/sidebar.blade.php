<nav
    id="sidebarMenu"
    x-cloak
    class="fixed inset-y-0 left-0 z-40 mt-10 w-64 transform bg-gray-100 transition-transform duration-200 ease-in-out md:relative md:mt-0 md:block md:translate-x-0"
    :class="{ '-translate-x-full': !sidebarOpen }"
>
    <!-- The navigation sidebar is defined here. It uses Alpine.js for dynamic behavior (e.g., toggling visibility with `sidebarOpen`). -->
    <div class="sticky top-0 pt-4">
        <!-- Ensures the sidebar content remains visible when scrolling. -->
        <ul class="space-y-1 px-4">
            <!-- Defines a list of navigation links with spacing and padding. -->
            <li>
                <a
                    href="/dashboard"
                    class="{{ Request::is("dashboard") ? "bg-gray-300 font-semibold" : "" }} block rounded px-3 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200"
                >
                    <!-- Highlights the "Dashboard" link if the current route matches "dashboard". -->
                    <span
                        data-feather="home"
                        class="mr-2 inline-block h-4 w-4 align-middle"
                    ></span>
                    <!-- Adds a home icon using Feather icons. -->
                    Dashboard
                </a>
            </li>
            <li>
                <a
                    href="/dashboard/posts"
                    class="{{ Request::is("dashboard/posts*") ? "bg-gray-300 font-semibold" : "" }} block rounded px-3 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200"
                >
                    <!-- Highlights the "My Posts" link if the current route matches "dashboard/posts". -->
                    <span
                        data-feather="file-text"
                        class="mr-2 inline-block h-4 w-4 align-middle"
                    ></span>
                    <!-- Adds a file-text icon using Feather icons. -->
                    My Posts
                </a>
            </li>
            <li class="md:hidden">
                <form action="/logout" method="POST">
                    @csrf
                    <!-- Adds CSRF protection to the logout form for security. -->
                    <button
                        type="submit"
                        class="flex cursor-pointer items-center rounded px-3 py-2 text-sm font-medium text-gray-800"
                    >
                        <!-- Defines a logout button with styling and an SVG icon. -->
                        <svg
                            class="mr-3 h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7"
                            />
                        </svg>
                        Logout
                    </button>
                </form>
            </li>
        </ul>

        @can("admin")
            <!-- Checks if the user has the "admin" permission to display admin-specific links. -->
            <h6
                class="mt-6 px-4 text-xs font-semibold tracking-wider text-gray-500 uppercase"
            >
                Administrator
            </h6>
            <!-- Adds a heading for the admin section. -->
            <ul class="mt-1 space-y-1 px-4">
                <!-- Defines a list of admin-specific navigation links. -->
                <li>
                    <a
                        href="/dashboard/categories"
                        class="{{ Request::is("dashboard/categories*") ? "bg-gray-300 font-semibold" : "" }} block rounded px-3 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200"
                    >
                        <!-- Highlights the "Post Categories" link if the current route matches "dashboard/categories". -->
                        <span
                            data-feather="grid"
                            class="mr-2 inline-block h-4 w-4 align-middle"
                        ></span>
                        <!-- Adds a grid icon using Feather icons. -->
                        Post Categories
                    </a>
                </li>
            </ul>
        @endcan
    </div>
</nav>
