<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')

</head>
<body>
    @include('includes.message')
    <main class="valign-wrapper mains">
        @yield('content')
    </main>
    {{-- <div class="container">
        @yield('content')
    </div> --}}
    @include('includes.foot')

    {{-- SCRIPTS --}}
    @include('includes.scripts')
</body>
</html>
