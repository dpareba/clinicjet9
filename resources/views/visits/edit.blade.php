@extends('layouts.master')
@section('title')
| Edit Patient Visit
@endsection
@section('pageheading')
Edit Patient Consultation
@endsection
@section('subpageheading')
Edit / Update Patient Consultation
@endsection
@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
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
				<h3 class="widget-user-username">{{$visit->patient->name}}</h3>
				<h5 class="widget-user-desc"><span class="badge bg-gray">Consultation Date: {{$visit->created_at->timezone('Asia/Kolkata')->toDayDateTimeString()}}</span> | <span class="badge bg-gray">Last Updated On: {{$visit->updated_at->timezone('Asia/Kolkata')->toDayDateTimeString()}}</span> | <span class="badge bg-gray">Consultant: DR. {{$visit->user->name}}</span> | @if ($visit->patient->dob != "1900-01-01 00:00:00")
					<span class="badge bg-gray">Patient Age: {{-- {{$patient->dob->diffInYears()}} --}} {{$visit->patient->dob->diff(Carbon::now())->format('%y Years, %m Months and %d Days')}}</span>
					@else
					<span class="badge bg-gray">Patient Age: Date of Birth Not Provided</span>
					@endif </h5>

				</div>
			</div>
			<!-- /.widget-user -->
			<h2 class="page-header"><small class="text-red">Known Allergies : {{$visit->patient->allergies}}</small></h2>
		</div>
	</div>
	{{-- .row --}}
	<div class="row">
		<div class="col-md-12">
			<div class="box box-solid box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Edit Consultation</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form data-parsley-validate action="{{route('visits.update',$visit->id)}}" method="POST">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group {{ $errors->has('chiefcomplaints')?'has-error':''}}">
									<label class="control-label" for="chiefcomplaints">Chief Complaints</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
										<textarea event.preventDefault(); style="text-transform: uppercase;resize:none;" autofocus=""  name="chiefcomplaints" id="chiefcomplaints" class="form-control" cols="30" rows="3" style="resize: none;" placeholder="Chief Complaints" required="">{{$visit->chiefcomplaints}}</textarea>
									</div>
									<span class="help-block">{{$errors->first('chiefcomplaints')}}</span>
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group {{ $errors->has('examinationfindings')?'has-error':''}}">
									<label class="control-label" for="examinationfindings">Examination Findings</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
										<textarea event.preventDefault(); style="text-transform: uppercase;resize: none;"  name="examinationfindings" id="examinationfindings" class="form-control" cols="30" rows="3" style="resize: none;" placeholder="Examination Findings" required="">{{$visit->examinationfindings}}</textarea>
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
										<textarea  event.preventDefault(); style="text-transform: uppercase;resize: none;" name="patienthistory" id="patienthistory" class="form-control" cols="30" rows="3" style="resize: none;" placeholder="Patient History" required="">{{$visit->patienthistory}}</textarea>
									</div>
									<span class="help-block">{{$errors->first('patienthistory')}}</span>
								</div>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="form-group {{ $errors->has('diagnosis')?'has-error':''}}">
									<label class="control-label" for="diagnosis">Diagnosis</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
										<textarea event.preventDefault(); style="text-transform: uppercase; resize: none;"  name="diagnosis" id="diagnosis" class="form-control" cols="30" rows="3" placeholder="Diagnosis" required="">{{$visit->diagnosis}}</textarea>
									</div>
									<span class="help-block">{{$errors->first('diagnosis')}}</span>
								</div>
							</div>
						</div>
						{{-- .row --}}
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group {{ $errors->has('advise')?'has-error':''}}">
									<label class="control-label" for="advise">Advise</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
										<textarea event.preventDefault(); style="text-transform: uppercase;resize: none;" name="advise" id="advise" class="form-control" cols="30" rows="3"  placeholder="Advise" required="">{{$visit->advise}}</textarea>
									</div>
									<span class="help-block">{{$errors->first('advise')}}</span>
								</div>
							</div>

							<div class="col-md-3 col-xs-12">
								<div class="form-group">
									
									@if ($visit->isSOS)
									<label class="control-label" for="followupdate">Follow up Date (mm/dd/yyyy) : SOS</label>
									<div class="checkbox">
										<label>
											<input name="cbox" checked="true" id="cbox" type="checkbox">
											Edit
										</label>
									</div>
									<input type="text" disabled="" name="followupdate" id="followupdate" value="" class="form-control followupdatesos" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
									@else
									<label class="control-label" for="followupdate">Follow up Date (dd/mm/yyyy)</label>
									{{-- {{\Carbon\Carbon::createFromForma$visit->nextvisitt('m/d/Y',)}} --}}
									{{-- {{date("m/d/Y",strtotime($visit->nextvisit))}} --}}
									<div class="checkbox">
										<label>
											<input name="cboxsos" checked="true" id="cbox" type="checkbox">
											Change to SOS
										</label>
									</div>
									<input type="text" id="followupdate" name="followupdate" value="{{date("d/m/Y",strtotime($visit->nextvisit))}}" required="" class="form-control followupdate" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
									@endif
									
									
								</div>
							</div>
							
							

						</div>
						{{-- .row --}}


					</div>
					{{-- .box-body --}}
					<div class="box-footer clearfix">
						<button type="submit" class="btn btn-success pull-right"><i class="fa fa-pencil"></i> Edit & Save Consultation</button>
						<a href="{{route('patients.show',$visit->patient->id)}}" class="btn btn-danger pull-right" style="margin-right: 5px;">
							<i class="fa fa-times"></i> Cancel
						</a>
					</div>
					{{-- .box-footer --}}
				</form>
			</div>
			{{-- .box --}}
		</div>
	</div>
	{{-- .row --}}
	@endsection
	@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#chiefcomplaints').focus();
			$('#cbox').attr('checked',false);
			$('#cbox').change(function(){
				if($('#cbox').is(":checked")){
					$('.followupdatesos').removeAttr("disabled"); 
					$('.followupdatesos').attr("required","required");
				}else{
					$('.followupdatesos').attr("disabled","disabled");
					$('.followupdatesos').removeAttr("required"); 
				}
			});

				//Datemask dd/mm/yyyy
				$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    		//Datemask2 mm/dd/yyyy
    		$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    		//Money Euro
    		$("[data-mask]").inputmask();
    	});
    </script>
    @endsection
