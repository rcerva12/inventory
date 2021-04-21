<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.heads')

</head>
<body>
    @include('includes.message')
    <main class="wrapper main">
        @include('includes.sidebar')
        <div id="content">
            @include('includes.navbar')
            @yield('content')
        </div>
    </main>
    {{-- SCRIPTS --}}
    @include('includes.foot')
    @include('includes.scripts')
</body>
</html>
