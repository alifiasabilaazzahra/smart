<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
