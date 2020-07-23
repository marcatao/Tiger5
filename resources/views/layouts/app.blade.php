<!DOCTYPE html>
<html>

@include('layouts.head')

<body>
    <div id="app">
        @yield('content')
    </div>
@include('layouts.scripts') 

@yield('scripts')

</body>
</html>
