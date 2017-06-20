@extends('layouts.master')
@section('stylesheets')
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
@stop
@section('title')
| Create New Report
@stop
@section('pageheading')
Create New Report
@stop
@section('subpageheading')
Enter New Report Details
@stop

@section('content')
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border text-center">
				<h3 class="box-title">Create New Investigation</h3><br><b class="text-green">{{$patient->name}} ({{$patient->patientcode}})</b>
			</div>
			<!-- /.box-header -->

			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<form action="{{route('reports.store')}}" method="POST">
							{{csrf_field()}}
							<input type="hidden" name="id" value="{{$visit->id}}">
							<div class="row">
								<div class="col-md-4 col-xs-12">
									<div class="form-group {{ $errors->has('name')?'has-error':''}}">

										<label class="control-label" for="name">Enter Investigation Name</label>
										<input  autofocus="" type="text" class="form-control" id="name" name="name" placeholder="Enter Investigation Name" value="{{old('name')}}">
										<span class="help-block">{{$errors->first('name')}}</span>

										
									</div>
								</div>

								<div class="col-md-4 col-xs-12">
									<div class="form-group {{ $errors->has('report_date')?'has-error':''}}">

										<label class="control-label" for="report_date">Date of Investigation (mm/dd/yyyy)</label>
										<input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask name="report_date" id="report_date" value="{{old('report_date')}}">
										<span class="help-block">{{$errors->first('report_date')}}</span>
									</div>
								</div>

								<div class="col-md-4 col-xs-12">
									<div class="form-group {{ $errors->has('cat_name')?'has-error':''}}">
										<label class="control-label" for="cat_name">Select Investigation Category</label> 
										<select name="cat_name" id="cat_name" class="form-control">
											<option value="" selected="selected"></option>
											@foreach ($categories as $category)
											<option value="{{$category->cat_name}}">{{$category->cat_name}}</option>
											@endforeach
										</select>
										@if ($errors->has('cat_name'))
										<span class="help-block">
											{{ $errors->first('cat_name') }}
										</span>
										@endif
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4 col-md-offset-4">
									<button type="submit" class="btn btn-success btn-block ">Create New Report</button>
								</div>
							</div>
							<br>
						</form>
					</div>
				</div>
				@if ($reports->count()>0)
				<table class="table table-bordered text-center">
					<thead style="background-color: #C0C0C0;"> 
						<th>Investigation Name</th>
						<th>Investigation Category</th>
						<th>Date of Investigation</th>
						<th>Add/View Investigation Image</th>
						<th>Delete</th>
					</thead>
					<tbody>
						@foreach ($reports as $report)
						<tr>
							<td>{{$report->name}}
								<span class="label label-primary pull-right">
									{{$report->images()->count()}}
								</span>
							</td>
							<td>{{$report->cat_name}}</td>
							<td>
								{{$report->report_date}}
							</td>
							<td><form  action="{{route('reports.show')}}" method="POST">
								{{csrf_field()}}
								<input type="hidden" name="reportid" value="{{$report->id}}">
								<button type="submit" class="btn btn-sm btn-default">View/Add Image</button>
							</form>
							{{-- <a href="{{route('reports.show',$report->id)}}">View/Add Images</a> --}}
						</td>
						<td>
							<form id="report-del" action="{{route('reports.destroy',$report->id)}}" method="POST">
								{{csrf_field()}}
								{{method_field('delete')}}
								{{-- <input type="hidden" name="_method" value="delete"> --}}
								<a href="" class="btn btn-xs btn-danger" onclick="event.preventDefault(); confirmDelete();"><i class="fa fa-trash-o"></i></a>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endif
			<br>
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<a href="{{route('patients.index')}}" class="btn btn-primary btn-block"> << Done </a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@stop

@section('scripts')
<script>
	$(function () {
	//Datemask dd/mm/yyyy
	$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();
});
	function confirmDelete(){
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this report!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel plx!",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
			if(isConfirm){
				swal({
					title:"Deleted!!",
					text:"Report has been deleted successfully!!",
					type:"success",
					timer:"1000",
					showConfirmButton: false
				},function(){
					document.getElementById('report-del').submit();
				});

			}else{
				swal("Cancelled", "Your report remains safe :)", "error");
			}
		});
	}
</script>
@stop