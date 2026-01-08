<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @hasSection('title')
            @yield('title') | Baliedu Tours and Travel
        @else
            Baliedu Tours and Travel
        @endif
    </title>

    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Custom Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        darkGreen: '#2D7737',
                        lightGreen: '#D0E497',
                        paleGreen: '#C7DA7C',
                        red: '#E21B2C',
                        darkGrey: '#3A3A3A',
                        mediumGrey: '#828282',
                        lightGrey: '#F2F2F2',
                        softGrey: '#FAFAFA',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-poppins">

    <!-- ===== PAGE CONTENT ===== -->
    @yield('content')

    <!-- JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
</body>

</html>
