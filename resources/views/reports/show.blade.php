@extends('layouts.master')
@section('stylesheets')
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
@stop
@section('title')
| View Report
@stop
@section('pageheading')
View Report
@stop
@section('subpageheading')
Add Images to Report
@stop
@section('content')
<style>
	#report-images img{
		width: 100px;
		height: 100px;
		border: 2px solid black;
		margin-bottom: 10px;
	}

	#report-images ul{
		margin: 0;
		padding: 0;
	}
	#report-images li{
		margin: 0;
		padding: 0;
		list-style: none;
		float: left;
		padding-right: 10px;
	}
</style>
<div class="row">
	<div class="col-md-4 col-xs-12">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-user-o"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Patient Name</span>
				<span class="info-box-number">{{$patient->name}}</span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					Patient Code: {{$patient->patientcode}}
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
	</div>{{-- .col-md-3 --}}

	<div class="col-md-8 col-xs-12">
		<div class="info-box bg-aqua">
			<span class="info-box-icon"><i class="fa fa-pencil-square-o "></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Report Name</span>
				<span class="info-box-number">{{$report->name}}</span>

				<div class="progress">
					<div class="progress-bar" style="width: 100%"></div>
				</div>
				<span class="progress-description">
					Report Category: {{$report->cat_name}}
				</span>
			</div>
			<!-- /.info-box-content -->
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div id="report-images">
			<ul>
				@foreach ($report->images as $image)
				<li>
					<a href="{{url($image->file_path)}}" data-lightbox="myreports" >
						<img src="{{url($image->file_path)}}" alt="">
					</a>
					<a href="#">Delete</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<form action="{{route('images.upload')}}" class="dropzone" id="addImages">
			{{csrf_field()}}
			<input type="hidden" name="report_id" value="{{$report->id}}">
			<input type="hidden" name="patient_code" value="{{$patient->patientcode}}">
		</form>
	</div>
</div>
<div>
	<hr>
</div>
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<a href="{{route('reports.create',$report->visit->id)}}" class="btn btn-primary btn-block"> << Done </a>
	</div>
</div>
@stop
@section('scripts')
<script>
	Dropzone.options.addImages = {
		dictDefaultMessage: "Drop or Click here to upload Scanned Report Images - Only jpeg, png and gif images allowed (max size 300 kB)",
		dictInvalidFileType: "Invalid File Type. Only jpeg, png and gif images allowed",
		dictFileTooBig: "Max file size allowed is 500 kB",
			 maxFilesize: 0.5,//MB
			 acceptedFiles: 'image/*',
			 init: function() {
			 	this.on("addedfile", function() {
			 		if (this.files[1]!=null){
			 			this.removeFile(this.files[0]);
			 		}
			 	});
			 },
			 success: function(file,response){
			 	if(file.status == 'success'){
			 		handleDropzoneFileUpload.handleSuccess(response);	
			 	}else{
			 		handleDropzoneFileUpload.handleError(response);
			 	}
			 }
			}
			var baseUrl = "http://localhost:8000";
			var handleDropzoneFileUpload = {
				handleError: function(response){
					console.log(response);
				},
				handleSuccess: function(response){
					var imageList = $('#report-images ul');
					var imageSrc = baseUrl + '/' + response.file_path;
				 // $(imageList).append('<li><a href="' + imageSrc +'"><img src="' + imageSrc +'"></a></li>');
				 $(imageList).append('<li><a href="' + imageSrc + '" data-lightbox="myreports"><img src="' + imageSrc + '"></a><a href="#"> Delete</a></li>');
				}
			}
		</script>
		@stop
