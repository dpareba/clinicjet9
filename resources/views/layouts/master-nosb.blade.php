<!DOCTYPE html>
<html>
<head>
      @include('partials._head')
</head>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

        @include('partials._navbarleft-nosb')
       @include('partials._navbar-right')
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      @include('partials._pageheader')

      <!-- Main content -->
      <section class="content">
        
        @yield('content')
        
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      @include('partials._footer')
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

    @include('partials._scripts')
</body>
</html>

