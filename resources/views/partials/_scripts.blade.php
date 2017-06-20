<!-- jQuery 2.2.3 -->
<script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- DataTables -->
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('js/jquery.inputmask.js')}}"></script>
<script src="{{asset('js/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('js/jquery.inputmask.extensions.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('js/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('js/demo.js')}}"></script>
{{-- Parsley js --}}
<script src="{{asset('js/parsley.min.js')}}"></script>
{{-- Sweetalert --}}
<script src="{{asset('js/sweetalert.min.js')}}"></script>
{{-- Clipboard js --}}
<script src="{{asset('js/clipboard.min.js')}}"></script>
<script src="{{asset('js/lightbox.min.js')}}"></script>
<script src="{{asset('js/moment.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>


@yield('scripts')
@yield('js')
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
  </script>
  @if (Session::has('message'))
        <script>
            swal({
                    title:"{{Session::get('message')}}",
                    text:"{{Session::get('text')}}",
                    type:"{{Session::get('type')}}",
                    timer:"{{Session::get('timer')}}"
                });
        </script>
    @endif