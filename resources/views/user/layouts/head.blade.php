<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Logo WEB TAB -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/Logo Tanpa Tulisan.png') }}" />

<!-- CSS Bootstrap 4 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Font-awesome -->
<script src="https://kit.fontawesome.com/637575c4e9.js" crossorigin="anonymous"></script>

<!-- My CSS -->
<link rel="stylesheet" href="{{ asset('assets/frontend/css/home-style.css') }}">

@yield('styleHead')
