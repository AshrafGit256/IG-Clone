<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Hide elements with x-cloak (for Alpine.js if applicable) -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Vite Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="drawer lg:drawer-open">
        <!-- Drawer toggle for mobile -->
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle">

        <div class="drawer-content  items-center justify-center">
            <!-- Page content button for toggling drawer on mobile -->
            <!-- <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">
                Open drawer
            </label> -->

            <!-- Slot for page content -->
            {{ $slot }}
        </div>

        <!-- Sidebar Drawer Content -->
        <div class="drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>

            @include('layouts.sidebar')
        </div>
    </div>

    @livewire('wire-elements-modal')
</body>
</html>
