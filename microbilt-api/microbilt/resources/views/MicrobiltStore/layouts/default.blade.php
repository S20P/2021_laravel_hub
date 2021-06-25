
<!doctype html>
<html>
<head>
    @include('MicrobiltStore.includes.head')
</head>
<body>
<div class="container">

    <header class="row">
        @include('MicrobiltStore.includes.header')
    </header>

    <div id="main">
            @yield('content')
    </div>

    <footer class="row">
        @include('MicrobiltStore.includes.footer')
    </footer>
    @include('MicrobiltStore.includes.footerScripts')
</div>
</body>
</html>