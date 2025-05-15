<!DOCTYPE html>
<html lang="en" hidden>
    <!-- Declares the document type as HTML5 and sets the language to English -->
    <head>
        <meta charset="utf-8" />
        <!-- Specifies the character encoding for the document -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Ensures proper rendering and touch zooming on mobile devices -->
        <title>AlBlog | Dashboard</title>
        <!-- Sets the title of the page -->
        <link href="{{ mix("css/app.css") }}" rel="stylesheet" />
        <!-- Links the main CSS file for styling the dashboard -->
        <!-- Links the main JavaScript file for application functionality -->
        <script src="{{ mix("js/app.js") }}" defer></script>
    </head>

    <body
        x-data="{ sidebarOpen: false }"
        class="bg-light-background-secondary/50 font-primary"
    >
        <!-- Initializes Alpine.js state for managing the sidebar's open/close state -->
        @include("dashboard.layouts.header")
        <!-- Includes the header layout for the dashboard -->

        <div class="flex min-h-screen">
            <!-- Creates a flex container for the sidebar and main content -->
            @include("dashboard.layouts.sidebar")
            <!-- Includes the sidebar layout for navigation -->

            <main class="flex-1 p-4">
                @yield("container")
                <!-- Placeholder for the main content of the page -->
            </main>
        </div>
    </body>
</html>
