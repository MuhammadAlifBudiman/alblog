<!DOCTYPE html>
<html lang="en">
    <!-- Declares the document type as HTML5 and sets the language to English -->
    <head>
        <meta charset="utf-8" />
        <!-- Specifies the character encoding for the document -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Ensures proper rendering and touch zooming on mobile devices -->
        <title>AlBlog | Dashboard</title>
        <!-- Sets the title of the page -->

        <link href="{{ asset("css/app.css") }}" rel="stylesheet" />
        <!-- Links the main CSS file for styling the dashboard -->
        <link
            rel="stylesheet"
            type="text/css"
            href="https://unpkg.com/trix@2.0.8/dist/trix.css"
        />
        <!-- Includes the Trix editor's CSS for rich text editing -->
    </head>
    <style>
        trix-toolbar [data-trix-button-group='file-tools'] {
            display: none;
        }
        /* Hides the file upload button in the Trix editor toolbar */

        [x-cloak] {
            display: none;
        }
        /* Utility class to hide elements until Alpine.js initializes */
    </style>
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"
    ></script>
    <!-- Includes the jQuery library for DOM manipulation and AJAX -->

    <body x-data="{ sidebarOpen: false }">
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

        <script
            defer
            src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
        ></script>
        <!-- Includes Alpine.js for reactive UI components -->
        <script
            src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
            integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE"
            crossorigin="anonymous"
        ></script>
        <!-- Includes Feather icons for scalable vector icons -->
        <script>
            feather.replace();
        </script>
        <!-- Replaces placeholder elements with Feather icons -->
        <script
            type="text/javascript"
            src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"
        ></script>
        <!-- Includes the Trix editor's JavaScript for rich text editing -->
    </body>
</html>
