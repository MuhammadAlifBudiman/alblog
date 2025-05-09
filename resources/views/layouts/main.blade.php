<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Specifies the character encoding for the document to ensure proper rendering of text -->
        <meta charset="utf-8" />
        <!-- Ensures proper rendering and touch zooming on mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Links the main CSS file for styling the application -->
        <link href="{{ asset("css/app.css") }}" rel="stylesheet" />

        <!-- Sets the title of the page dynamically based on the $title variable -->
        <title>AlBlog | {{ $title }}</title>
    </head>

    <body>
        <!-- Includes the navigation bar from the partials.navbar file -->
        @include("partials.navbar")

        <!-- Main container for the page content-->
        <div class="flex justify-center">
            <div class="container mt-4 px-2">
                <!-- Placeholder for specific page content to be injected -->
                @yield("container")
            </div>
        </div>

        <!-- Loads Alpine.js for reactive and declarative UI components -->
        <script
            defer
            src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
        ></script>
        <!-- Links the main JavaScript file for application functionality -->
        <script src="{{ asset("js/app.js") }}"></script>
    </body>
</html>
