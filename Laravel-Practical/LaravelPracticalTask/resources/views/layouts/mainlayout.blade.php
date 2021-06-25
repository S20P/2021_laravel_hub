<!DOCTYPE html>

<html lang="en">


<head>

@include('layouts.partials.head')

</head>

<body class="sb-nav-fixed">

  @include('layouts.partials.nav')

  <div id="layoutSidenav">

    @include('layouts.partials.sidebar')

   <div id="layoutSidenav_content">
     <main>
     <div class="container-fluid px-4">
      @yield('content')
      </div>
      </main>
      <!-- content-wrapper ends -->

      @include('layouts.partials.footer')

    </div>
 </div>


@include('layouts.partials.footer-scripts')

</body>

</html>