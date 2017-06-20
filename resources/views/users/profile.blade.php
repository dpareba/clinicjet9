@extends('layouts.master')
@section('title')
	| Profile
@stop
@section('stylesheets')
	<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
@stop
@section('pageheading')
	Profile
@stop
@section('subpageheading')
	Change/Edit your Profile
@stop
@section('content')
	      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Dr. {{Auth::user()->name}}'s Profile</h3>
            </div>
            <div class="box-body">
            	<label for="exampleInputEmail1">Change Profile Image</label>
            	<form action="/profile" class="dropzone" id="my-awesome-dropzone">
	           		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        	</form>
            </div>
	            
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                
                  <form action="/profile" class="dropzone" id="my-awesome-dropzone">
	           		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	        	      </form>
                </div>
              <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->
          
@stop
@section('scripts')
	<script>
  $(document).ajaxStart(function() { Pace.restart(); });
//         Dropzone.options.myAwesomeDropzone = {
//   maxFiles: 1,
//   accept: function(file, done) {
//     console.log("uploaded");
//     done();
//   },
//   init: function() {
//     this.on("maxfilesexceeded", function(file){
//         alert("No more files please!");
//     });
//   }
// };
Dropzone.options.myAwesomeDropzone = {
    dictDefaultMessage: "Drop or Click here to upload a new Profile Picture - Only jpeg, png and gif images allowed (max size 300 kB)",
    dictInvalidFileType: "Invalid File Type. Only jpeg, png and gif images allowed",
    dictFileTooBig: "Max file size allowed is 300 kB",
    maxFilesize: 0.3,//MB
    acceptedFiles: "image/jpeg,image/png,image/gif",
  accept: function(file, done) {
    console.log("uploaded");
    done();
  },
  init: function() {
    this.on("addedfile", function() {
      if (this.files[1]!=null){
        this.removeFile(this.files[0]);
      }
    });
  }
};
    </script>
    
   

    <script type="text/javascript">
// This example uses jQuery so it creates the Dropzone, only when the DOM has
// loaded.

// Disabling autoDiscover, otherwise Dropzone will try to attach twice.
Dropzone.autoDiscover = false;
// or disable for specific dropzone:
// Dropzone.options.myDropzone = false;

$(function() {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners
  var myDropzone = new Dropzone(".dropzone");

  myDropzone.on("queuecomplete", function(file, res) {
      if (myDropzone.files[0].status != Dropzone.SUCCESS ) {
          // alert('yea baby');
      } else {
          //alert('cry baby');
          window.location = "/profile";
      }
  });
});
</script>
@stop