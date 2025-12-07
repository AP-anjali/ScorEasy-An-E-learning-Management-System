<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Dashboard</title>
    @yield("style")
    <link rel="stylesheet" href="{{ asset('cssfiles/faculty_dashboard.css') }}">
    <link rel="icon" href="{{ asset('img/sidebar_logo-removebg.png') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>

    @include('faculty_dashboard_sidebar_layout')

    @include('faculty_dashboard_uppar-menu_layout')

    @yield('body')

    <script src="{{ asset('js/faculty_dashboard.js') }}"></script>
    
</body>
</html>