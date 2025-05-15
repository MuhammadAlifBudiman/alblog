<header
    class="bg-light-background-primary font-secondary sticky top-0 z-50 flex items-center justify-between p-2 shadow md:flex-nowrap"
>
    <!-- Brand -->
    <a
        href="/"
        class="text-light-text-secondary px-3 text-lg font-semibold md:w-1/4 lg:w-1/5"
    >
        AlBlog
    </a>

    <!-- Sidebar toggle button (only visible on small screens) -->
    <button
        class="text-light-text-secondary hover:text-light-text-primary absolute top-2 right-4 cursor-pointer focus:outline-none md:hidden"
        type="button"
        aria-label="Toggle navigation"
        @click="sidebarOpen = !sidebarOpen"
    >
        <!-- Simple hamburger icon -->
        <svg
            class="h-6 w-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
            />
        </svg>
    </button>

    <!-- Logout button -->
    <div class="ml-auto hidden md:block">
        <form action="/logout" method="POST">
            @csrf
            <button
                type="submit"
                class="bg-light-background-primary text-light-text-secondary hover:bg-light-background-hover hover:text-light-text-primary flex cursor-pointer items-center rounded px-3 py-1 text-sm focus:outline-none"
            >
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
                        d="M17 16l4-4m0 0l-4-4m4 4H7"
                    />
                </svg>
                Logout
            </button>
        </form>
    </div>
</header>
