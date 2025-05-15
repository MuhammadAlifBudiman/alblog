<nav
    id="sidebarMenu"
    x-cloak
    class="bg-light-background-secondary font-secondary fixed inset-y-0 left-0 z-40 mt-10 w-64 transform transition-transform duration-200 ease-in-out md:relative md:mt-0 md:block md:translate-x-0"
    :class="{ '-translate-x-full': !sidebarOpen }"
>
    <div class="sticky top-0 pt-4">
        <ul class="space-y-1 px-4">
            <li>
                <a
                    href="/dashboard"
                    class="{{ Request::is("dashboard") ? "bg-light-background-hover font-semibold" : "" }} text-light-text-primary hover:bg-light-background-hover block rounded px-3 py-2 text-sm font-medium"
                >
                    <span
                        data-feather="home"
                        class="mr-2 inline-block h-4 w-4 align-middle"
                    ></span>
                    Dashboard
                </a>
            </li>
            <li>
                <a
                    href="/dashboard/posts"
                    class="{{ Request::is("dashboard/posts*") ? "bg-light-background-hover font-semibold" : "" }} text-light-text-primary hover:bg-light-background-hover block rounded px-3 py-2 text-sm font-medium"
                >
                    <span
                        data-feather="file-text"
                        class="mr-2 inline-block h-4 w-4 align-middle"
                    ></span>
                    My Posts
                </a>
            </li>
            <li class="md:hidden">
                <form action="/logout" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="text-light-text-primary flex cursor-pointer items-center rounded px-3 py-2 text-sm font-medium"
                    >
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
            <h6
                class="text-light-text-primary mt-6 px-4 text-xs font-semibold tracking-wider uppercase"
            >
                Administrator
            </h6>
            <ul class="mt-1 space-y-1 px-4">
                <li>
                    <a
                        href="/dashboard/categories"
                        class="{{ Request::is("dashboard/categories*") ? "bg-light-background-hover font-semibold" : "" }} text-light-text-primary hover:bg-light-background-hover block rounded px-3 py-2 text-sm font-medium"
                    >
                        <span
                            data-feather="grid"
                            class="mr-2 inline-block h-4 w-4 align-middle"
                        ></span>
                        Post Categories
                    </a>
                </li>
            </ul>
        @endcan
    </div>
</nav>
