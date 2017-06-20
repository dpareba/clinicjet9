@extends('layouts.master')
@section('title')
| Create New Consult
@stop
@section('pageheading')
Create New Consult		
@stop
@section('subpageheading')
Add Consultation for Patient Visit
@stop
@section('content')
<style>
	#report-images{
		width: 10px;
		height: 10px;
		border: 1px solid black;
		margin-bottom: 2px;
	}
</style>

<div class="row">
	<div class="col-md-12">
		<!-- Widget: user widget style 1 -->
		<div class="box box-widget widget-user-2">
			<!-- Add the bg color to the header using any of the bg-* classes -->
			<div class="widget-user-header bg-primary">
				<div class="widget-user-image">
					<img class="img-circle" src="/avatar/docs/default.jpg" alt="User Avatar">
				</div>
				<!-- /.widget-user-image -->
				<h3 class="widget-user-username">{{$patient->name}}</h3>
				<h5 class="widget-user-desc"><span class="badge bg-gray">Created On: {{$patient->created_at->format('D, d F Y')}}</span> | <span class="badge bg-gray">Created By: DR. {{$user->name}}</span></h5>
				
			</div>
		</div>
		<!-- /.widget-user -->
		<h2 class="page-header"><small class="text-red">Known Allergies : {{$patient->allergies}}</small></h2>
	</div>
</div>
{{-- .row --}}
@if (count($patient->visits) != 0)
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">New Consultation</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>{{-- .box-header --}}
			<div class="box-body">
				<form action="{{route('visits.storelocal')}}" method="POST">
					{{csrf_field()}}
					<input type="hidden" name="patient_id" value="{{$patient->id}}">
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<div class="form-group {{ $errors->has('chiefcomplaints')?'has-error':''}}">
								<label class="control-label" for="chiefcomplaints">Chief Complaints</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
									<textarea  autofocus=""  name="chiefcomplaints" id="chiefcomplaints" class="form-control" cols="30" rows="5" style="resize: none;">{{old('chiefcomplaints')}}</textarea>
								</div>
								<span class="help-block">{{$errors->first('chiefcomplaints')}}</span>
							</div>
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="form-group {{ $errors->has('examinationfindings')?'has-error':''}}">
								<label class="control-label" for="examinationfindings">Examination Findings</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
									<textarea   name="examinationfindings" id="examinationfindings" class="form-control" cols="30" rows="5" style="resize: none;">{{old('examinationfindings')}}</textarea>
								</div>
								<span class="help-block">{{$errors->first('examinationfindings')}}</span>
							</div>
						</div>
					</div>
					<!-- /.row -->
					<div class="row">
						<div class="col-md-6 col-xs-12">
							<div class="form-group {{ $errors->has('patienthistory')?'has-error':''}}">
								<label class="control-label" for="patienthistory">History</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
									<textarea   name="patienthistory" id="patienthistory" class="form-control" cols="30" rows="5" style="resize: none;">{{old('patienthistory')}}</textarea>
								</div>
								<span class="help-block">{{$errors->first('patienthistory')}}</span>
							</div>
						</div>
						<div class="col-md-6 col-xs-12">
							<div class="form-group {{ $errors->has('diagnosis')?'has-error':''}}">
								<label class="control-label" for="diagnosis">Diagnosis</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
									<textarea   name="diagnosis" id="diagnosis" class="form-control" cols="30" rows="5" style="resize: none;">{{old('diagnosis')}}</textarea>
								</div>
								<span class="help-block">{{$errors->first('diagnosis')}}</span>
							</div>
						</div>
					</div>
					{{-- .row --}}	
					<div class="row">
						<div class="col-md-12 col-xs-12">
							<div class="form-group {{ $errors->has('advise')?'has-error':''}}">
								<label class="control-label" for="advise">Advise</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
									<textarea   name="advise" id="advise" class="form-control" cols="30" rows="3" style="resize: none;">{{old('advise')}}</textarea>
								</div>
								<span class="help-block">{{$errors->first('advise')}}</span>
							</div>
						</div>
					</div>
					{{-- .row --}}				
				</div>{{-- .box-body --}}
				<div class="box-footer clearfix">
					<div class="row">
						<div class="col-md-6">
							<button type="submit"  class="btn btn-success btn-block">Save Consultation</button>
						</div>
						<div class="col-md-6">
							<a href="{{route('patients.show',$patient->id)}}" class="btn btn-danger btn-block">Cancel</a>
						</div>
					</div>
				</div>
				<!-- /.box-footer -->
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-solid box-primary">
			<div class="box-header">
				@if (Auth::user()->isRemoteDoc)
				<h3 class="box-title">Patient Visit History (Kenya Time)</h3>
				@else
				<h3 class="box-title">Patient Visit History (Indian Time)</h3>
				@endif
			</div>{{-- .box-header --}}
			<div class="box-body">
				<div class="box-group" id="accordion">
					<?php $count=1; ?>
					@foreach ($patient->visits as $visit)
					<div class="panel box {{$visit->user->isRemoteDoc?'box-primary':'box-warning'}}">
						<div class="box-header with-border">
							<h4 class="box-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$count}}">
									@if (Auth::user()->isRemoteDoc)
									{{$visit->created_at->timezone('Africa/Nairobi')->toDayDateTimeString()}}
									@else
									{{$visit->created_at->timezone('Asia/Kolkata')->toDayDateTimeString()}}
									@endif
								</a>
							</h4>
						</div>{{-- .box-header --}}
						<div id="collapse{{$count}}" class="panel-collapse collapse">
							
						</div>
					</div>.{{-- panel --}}
					<?php $count++; ?>
					@endforeach
				</div>
			</div>{{-- .box-body --}}
		</div>{{-- .box --}}
	</div>
</div>
@else
<div class="row">
	<div class="col-md-12 ">
		<div class="box box-default">
			<div class="box-header with-border">
				<i class="fa fa-exclamation-circle"></i>
				<h3 class="box-title">No Patient visits found</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="callout callout-info">
					<h4>No Patient Visits Found!!</h4>

					<p>Primary Consultation data for this patient has not been entered!!</p>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
	</div>
</div>
@endif
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<a href="{{route('patients.show',$patient->id)}}" class="btn btn-primary btn-block"><< Back</a>
	</div>
</div>
@stop