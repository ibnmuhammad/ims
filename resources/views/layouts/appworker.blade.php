<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('inc.head')
<body>
    <div id="app">
        
        @include('inc.workernav')
        @include('inc.workersidebar')

        <main class="py-0">
            @include('sweetalert::alert')
            @yield('content')
            @include('inc.footer')
        </main>
    </div>
    @include('inc.query')
</body>
</html>
