<!DOCTYPE html>
<html lang="en" hidden>
    <head>
        <!-- Specifies the character encoding for the document to ensure proper rendering of text -->
        <meta charset="utf-8" />
        <!-- Ensures proper rendering and touch zooming on mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Sets the title of the page dynamically based on the $title variable -->
        <title>AlBlog | {{ $title }}</title>

        <!-- Links the main CSS file for styling the application -->
        <link href="{{ mix("css/app.css") }}" rel="stylesheet" />

        <!-- Links the main JavaScript file for application functionality -->
        <script src="{{ mix("js/app.js") }}" defer></script>
    </head>

    <body class="bg-light-background-secondary/50 font-primary">
        <!-- Includes the navigation bar from the partials.navbar file -->
        @include("partials.navbar")

        <!-- Main container for the page content-->
        <div class="flex justify-center">
            <div class="container mt-4 px-2">
                <!-- Placeholder for specific page content to be injected -->
                @yield("container")
            </div>
        </div>
    </body>
</html>
