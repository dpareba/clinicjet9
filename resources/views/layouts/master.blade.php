<!DOCTYPE html>
<html>
<head>
      @include('partials._head')
</head>

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

      @include('partials._navbarleft-sb')

      @include('partials._navbar-right')
          
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  @include('partials._sidebar-left')

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('partials._pageheader')

    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    @include('partials._footer')
  </footer>

  
</div>
<!-- ./wrapper -->

    @include('partials._scripts')
</body>
</html>
