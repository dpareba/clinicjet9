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
@section('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
				<h3 class="widget-user-username">{{$patient->name}} {{$patient->midname}} {{$patient->surname}}</h3>
				<h5 class="widget-user-desc"><span class="badge bg-gray">Created On: {{$patient->created_at->format('D, d F Y')}}</span> | <span class="badge bg-gray">Created By: DR. {{$user->name}}</span> | 
					@if ($patient->isapproxage)
					<span class="badge bg-gray">Approximate Patient Age: {{$patient->approxage}} Years</span>
					@else
					@if ($patient->dob != "1900-01-01 00:00:00")
					<span class="badge bg-gray">Patient Age: {{$patient->dob->diff(Carbon::now())->format('%y Years, %m Months and %d Days')}}</span>
					@else
					<span class="badge bg-maroon">Patient Age: Date of Birth Not Provided</span>
					@endif 
					@endif
				{{-- @if ($patient->dob != "1900-01-01 00:00:00")
					<span class="badge bg-gray">Patient Age: {{$patient->dob->diff(Carbon::now())->format('%y Years, %m Months and %d Days')}}</span>
					@else
					<span class="badge bg-gray">Patient Age: Date of Birth Not Provided</span>
					@endif --}} </h5>

				</div>
			</div>
			<!-- /.widget-user -->
			<h2 class="page-header"><small class="text-red">Known Allergies : {{$patient->allergies}}</small></h2>
		</div>
	</div>
	{{-- .row --}}
	{{-- @if (count($errors)>0)
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger">
				<b>Errors</b><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>
						{{$error}}
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	@endif --}}
	{{-- @if (count($patient->visits) != 0) --}}
	<div class="row">
		<div class="col-md-12">
			<div class="box box-solid box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">New Consultation</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<form data-parsley-validate id="consult" action="{{route('visits.storelocal')}}" method="POST" data-toggle="validator">
						{{csrf_field()}}
						<input type="hidden" name="patient_id" value="{{$patient->id}}">
						
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div class="form-group {{ $errors->has('chiefcomplaints')?'has-error':''}}">
									<label class="control-label" for="chiefcomplaints">Chief Complaints</label>
									<div class="pull-right box-tools">
										{{-- <a href="" type="button" id="ccadd" style="color: gray;" data-toggle="modal" da><i class="fa fa-plus"></i></a> --}}
										<a type="button" id="addcc" href="" style="color: gray;" data-toggle="modal" data-target="#ccModal">
											<i class="fa fa-plus"></i></a>
										</div>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
											<textarea event.preventDefault(); style="resize:none;text-transform: uppercase;" autofocus=""  name="chiefcomplaints" id="chiefcomplaints" class="form-control" cols="30" rows="3"  placeholder="Chief Complaints" required="">{{old('chiefcomplaints')}}</textarea>
										</div>
										<span class="help-block">{{$errors->first('chiefcomplaints')}}</span>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group {{ $errors->has('examinationfindings')?'has-error':''}}">
										<label class="control-label" for="examinationfindings">Examination Findings</label>
										<div class="pull-right box-tools">
										{{-- <a href="" type="button" id="ccadd" style="color: gray;" data-toggle="modal" da><i class="fa fa-plus"></i></a> --}}
										<a type="button" id="addef" href="" style="color: gray;" data-toggle="modal" data-target="#efModal">
											<i class="fa fa-plus"></i></a>
										</div>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
											<textarea event.preventDefault(); style="text-transform: uppercase;resize: none;"  name="examinationfindings" id="examinationfindings" class="form-control" cols="30" rows="3" style="resize: none;" placeholder="Examination Findings" required="">{{old('examinationfindings')}}</textarea>
										</div>
										<span class="help-block">{{$errors->first('examinationfindings')}}</span>
									</div>
								</div>
							</div>
							<!-- /.row -->
							<div class="row">
								<div class="col-md-6 col-xs-12">
									<div class="form-group {{ $errors->has('patienthistory')?'has-error':''}}">
										<label class="control-label" for="patienthistory">History of Presenting Complaints</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
											<textarea  event.preventDefault(); style="text-transform: uppercase;resize: none;" name="patienthistory" id="patienthistory" class="form-control" cols="30" rows="3" style="resize: none;" placeholder="Patient History" required="">{{old('patienthistory')}}</textarea>
										</div>
										<span class="help-block">{{$errors->first('patienthistory')}}</span>
									</div>
								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group {{ $errors->has('diagnosis')?'has-error':''}}">
										<label class="control-label" for="diagnosis">Diagnosis</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
											<textarea event.preventDefault(); style="text-transform: uppercase; resize: none;"  name="diagnosis" id="diagnosis" class="form-control" cols="30" rows="3" placeholder="Diagnosis" required="">{{old('diagnosis')}}</textarea>
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
											<textarea event.preventDefault(); style="text-transform: uppercase;resize: none;" name="advise" id="advise" class="form-control" cols="30" rows="3"  placeholder="Advise" required="">{{old('advise')}}</textarea>
										</div>
										<span class="help-block">{{$errors->first('advise')}}</span>
									</div>
								</div>

								<div class="col-md-2 col-xs-12">
									<div class="form-group {{ $errors->has('followuptype')?'has-error':''}}">
										<label class="control-label" for="followuptype">Follow up</label>
										<select name="followuptype" id="followuptype" class="js-example-basic-single form-control">
											<option value="SOS">SOS</option>
											<option value="Days" >Days</option>
											<option value="Months" >Months</option>
										</select>
										<span class="help-block">{{$errors->first('followuptype')}}</span>
									</div>
								</div>
								<div class="col-md-1 col-xs-12">
									<div class="form-group  {{ $errors->has('numdays')?'has-error':''}}">
										<label class="control-label" id="numdayslabel" for="numdays"></label>
										<select name="numdays" id="numdays" class="js-example-basic-single form-control">
											{{-- appending values between 1 and 31 using jquery --}}
										</select>
										<span class="help-block">{{$errors->first('numdays')}}</span>
									</div>
								</div>
								<div class="col-md-3 col-xs-12">
									<div class="form-group ">
										<label class="control-label" id="nextvisitlabel" for="nextvisit">Follow up on(dd/mm/yyyy)</label>
										<input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="nextvisit" id="nextvisit">
									</div>
								</div>

							</div>
							{{-- .row --}}
							<hr>

							<div class="row">
								<div class="col-md-6 col-xs-12">
									<div class="form-group {{ $errors->has('pathology')?'has-error':''}}">
										<label class="control-label" for="pathology">Recommended Clinical Follow up</label>
										<div class="pull-right box-tools">
											<a type="button" id="addpath" class="btn btn btn-sm" style="color: gray;" data-toggle="modal" data-target="#myPathModal">
												<i class="fa fa-plus"></i></a>
											</div>
											<select name="pathology[]" id="pathology" class="js-example-basic-multiple  form-control" multiple="multiple">
											{{-- @foreach ($pathologies as $pathology)
											<option value="{{$pathology->id}}">{{$pathology->name}}</option>
											@endforeach --}}
										</select>
										<span class="help-block">{{$errors->first('pathology')}}</span>
									</div>
								</div>

								<div class="col-md-3 col-xs-12">
									<div class="form-group {{ $errors->has('systolic') || $errors->has('diastolic')?'has-error':''}}">
										<label for="">Blood Pressure (Systolic/Diastolic)</label>
										<div class="row">
											<div class="col-md-6 ">
												<input  data-parsley-type="digits" minlength="2" maxlength="3"  name="systolic" id="systolic" class="form-control" placeholder="Systolic"  style="text-align: center;">
											</div>
											
											<div class="col-md-6">
												<input data-parsley-type="digits" minlength="2" maxlength="3" class="form-control" name="diastolic" id="diastolic" placeholder="Diastolic"  style="text-align: center;">
											</div>
										</div>
										@if ($errors->has('systolic'))
										<span class="help-block">{{$errors->first('systolic')}}</span>
										@else
										<span class="help-block">{{$errors->first('diastolic')}}</span>
										@endif
									</div>
								</div>

								
							</div>
							{{-- .row --}}
							<hr>

							{{-- =====================================TESTING================================================= --}}

						{{-- <div class="row">
							<div class="col-md-12 col-xs-12">
								<div class="form-group {{ $errors->has('patho')?'has-error':''}}">
									<label class="control-label" for="patho">Testing Recommended Clinical Follow up</label>
									<div class="pull-right box-tools">
										<a type="button" id="addpath" class="btn btn btn-sm" style="color: gray;" data-toggle="modal" data-target="#myPathModal">
											<i class="fa fa-plus"></i></a>
										</div>
										<select name="patho[]" id="patho" class="form-control" multiple="multiple">
											
										</select>
										<span class="help-block">{{$errors->first('patho')}}</span>
									</div>
								</div>


							</div> --}}
							{{-- .row --}}
							{{-- <hr> --}}

							{{-- =====================================TESTING================================================= --}}


							<div class="row">
								<div class="col-md-12">
									<!-- small box -->
									<div class="small-box bg-aqua">
										<div class="inner">
											<div class="row">
												<div class="col-md-6 col-xs-12">
													<div class="form-group {{ $errors->has('medname')?'has-error':''}}">
														<label for="medname" id="medname" class="control-label">Brand Name</label>
														<div class="pull-right box-tools">
															<a type="button" id="addmed" class="btn btn-sm" style="color: gray;" data-toggle="modal" data-target="#myModal">
																<i class="fa fa-plus"></i></a>
																<a type="button" id="clear" class="btn btn btn-sm" style="color: gray;">
																	<i class="fa fa-times"></i></a>
																</div>
																<select name="medname" id="medname" class="medname form-control" >
																</select>
																<i id="messagebox" class="help-block" style="color: red;"></i>
															</div>
														</div>{{-- .col-md-6 --}}


														<div class="col-md-3 col-xs-12">
															<div class="form-group {{ $errors->has('doseduration')?'has-error':''}}">
																<label class="control-label" for="doseduration">Dose Duration</label>
																<select name="doseduration" id="doseduration" class="js-example-basic-single form-control">
																	<option value="days" selected="">Days</option>
																	<option value="weeks" selected="">Weeks</option>
																	<option value="months" >Months</option>
																	<option value="years" >Years</option>
																	<option value="sos" >SOS</option>
																	<option value="lifetime" >Lifetime</option>
																</select>
																<span class="help-block">{{$errors->first('doseduration')}}</span>
															</div>
														</div>

														<div class="col-md-1 col-xs-12">
															<div class="form-group dosedurationdays {{ $errors->has('dosedurationdays')?'has-error':''}}">
																<label class="control-label" id="dosedurationdayslabel" for="dosedurationdays">Days</label>
																<select name="dosedurationdays" id="dosedurationdays" class="js-example-basic-single form-control">
																	{{-- appending values between 1 and 31 using jquery --}}
																</select>
																<span class="help-block">{{$errors->first('dosedurationdays')}}</span>
															</div>
														</div>


													</div>{{-- .row --}}

													<div class="row">
														<div class="col-md-2 col-xs-12">
															<div class="form-group dosetime {{ $errors->has('dosetime')?'has-error':''}}">
																<label class="control-label" for="dosetime">Dose Time</label>
																<select name="dosetime" id="dosetime" class="js-example-basic-single form-control">
																	<option value="bf" selected="selected">Before Food</option>
																	<option value="af" >After Food</option>
																	<option value="wf" >With Food</option>
																	<option value="oth" >Other</option>
																</select>
																<span class="help-block">{{$errors->first('dosetime')}}</span>
															</div>
														</div>
														<div class="col-md-4 col-xs-12">
															<div class="form-group dosetimespecial {{ $errors->has('dosetimespecial')?'has-error':''}}">
																<label class="control-label" for="dosetimespecial">Dose Time (Special Instructions)</label>
																<input type="text" name="dosetimespecial" id="dosetimespecial" class="form-control">
																<span class="help-block">{{$errors->first('dosetimespecial')}}</span>
															</div>
														</div>

														<div class="col-md-3 col-xs-12">
															<div class="form-group {{ $errors->has('doseregime1')?'has-error':''}}">
																<label class="control-label" for="doseregime1">Dose Regime</label>
																<select name="doseregime1" id="doseregime1" class="js-example-basic-single form-control">
																	<option value="M-A-N">M-A-N</option>
																	<option value="SOS" >SOS</option>
																	<option value="Other" >Other</option>
																</select>
																<span class="help-block">{{$errors->first('doseregime1')}}</span>
															</div>
														</div>

														<div class="col-md-1 col-xs-12">
															<div class="form-group dosemorning {{ $errors->has('dosemorning')?'has-error':''}}">
																<label class="control-label" id="dosemorninglabel" for="dosemorning">Morning</label>
																<select  name="dosemorning" id="dosemorning" class="js-example-basic-single form-control">
																	{{-- appending values between 0 and 10 using jquery --}}
																</select>
																<span class="help-block">{{$errors->first('dosemorning')}}</span>
															</div>
														</div>

														<div class="col-md-1 col-xs-12">
															<div class="form-group doseafternoon {{ $errors->has('doseafternoon')?'has-error':''}}">
																<label class="control-label" id="doseafternoonlabel" for="doseafternoon">Afternoon</label>
																<select name="doseafternoon" id="doseafternoon" class="js-example-basic-single form-control">
																	{{-- appending values between 1 and 31 using jquery --}}
																</select>
																<span class="help-block">{{$errors->first('doseafternoon')}}</span>
															</div>
														</div>

														<div class="col-md-1 col-xs-12">
															<div class="form-group dosenight {{ $errors->has('dosenight')?'has-error':''}}">
																<label class="control-label" id="dosenightlabel" for="dosenight">Night</label>
																<select name="dosenight" id="dosenight" class="js-example-basic-single form-control">
																	{{-- appending values between 1 and 31 using jquery --}}
																</select>
																<span class="help-block">{{$errors->first('dosenight')}}</span>
															</div>
														</div>
													</div>{{-- .row --}}

													<div class="row">
														<div class="col-md-6 col-md-offset-6 col-xs-12">
															<div class="form-group doseregimespecial {{ $errors->has('doseregimespecial')?'has-error':''}}">
																<label class="control-label" for="doseregimespeciallabel">Dose Regime (Special Instructions)</label>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
																	<textarea   name="doseregimespecial" id="doseregimespecial" class="form-control" cols="30" rows="2" style="resize: none;" placeholder="Special Instruction for Dose Regime"></textarea>
																</div>
																<span class="help-block">{{$errors->first('doseregimespecial')}}</span>
															</div>
														</div>

													</div>
													{{-- .row --}}

													<div class="row">
														<div class="col-md-12 col-xs-12">
															<div class="form-group {{ $errors->has('remarks')?'has-error':''}}">
																<label class="control-label" for="remarks">Remarks</label>
																<div class="input-group">
																	<span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
																	<textarea  autofocus=""  name="remarks" id="remarks" class="form-control" cols="30" rows="2" style="resize: none;text-transform: uppercase;" placeholder="Doctor's Remarks"></textarea>
																</div>
																<span class="help-block">{{$errors->first('remarks')}}</span>
															</div>
														</div>

													</div>
													{{-- .row --}}
												</div>{{-- .inner --}}
												{{-- <a id="bbb" class="small-box-footer">Add Prescription<i class="fa fa-arrow-circle-right"></i></a> --}}
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 col-md-offset-4">
											<a id="bbb" class="btn btn-primary btn-block">Add Prescription</a>
										</div>
									</div>
									<hr>

									<div class="row">
										<div class="col-md-12">
											<div class="box box-gray">
												<div class="box-header">
												</div>
												<div class="box-body">
													<ul class="todo-list" id="scriplist">
													{{-- <li class="plist">
														<input type="hidden" name="medid[]" value="Hello">
														<small class="label label-danger"><i class="fa fa-heartbeat"></i> Brand Name</small>
														<span class="text">STRONGER NEO MINOPHAGEN C INJECTION 20 ML (HEPATIC PROTECTORS INCLUDING AYURVEDIC | A5D3)</span>
														<div class="pull-right">
															<a class="rem" style="color: crimson;"><i class="fa fa-trash"></i></a>
														</div>
														<br>
														<input type="hidden" name="doseduration[]" value="doseduration">
														<small class="label label-warning"><i class="fa fa-calendar-check-o"></i> Dose Duration</small>
														<span class="text">1 Day</span> |
														<input type="hidden" name="dosetimings[]" value="dosetimings">
														<small class="label label-primary"><i class="fa fa-clock-o"></i> Dose Timings</small><span class="text">Before Food</span> |
														<input type="hidden" name="doseregime[]" value="doseregime">
														<small class="label label-success"><i class="fa fa-asterisk "></i> Dose Regime</small>
														<span class="text">1-1-2</span>
														<br>
														<input type="hidden" name="remarks[]" value="">
														<small class="label label-info"><i class="fa fa-comments "></i> Remarks</small>
														<span class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam distinctio s </span>
													</li> --}}
												</ul>
											</div>
										</div>
									</div>
								</div>

							</div>
							<!-- /.box-body -->

							<div class="box-footer clearfix">
								
								<button type="submit" class="btn btn-success pull-right"><i class="fa fa-check-square-o"></i> Save Consultation
								</button>
								<a href="{{route('patients.show',$patient->id)}}" class="btn btn-danger pull-right" style="margin-right: 5px;">
									<i class="fa fa-times"></i> Cancel
								</a>
								{{-- <div class="col-md-3"> --}}
								{{-- <a href="" onclick="event.preventDefault(); document.getElementById('consult').submit();" class="form-group btn btn-success btn-block">Save Consultation</a> --}}
										{{-- <button type="submit"  class="form-group btn btn-success btn-block">Save Consultation</button>
									</div>
									<div class="col-md-3 col-md-offset-6">
										<a href="{{route('patients.show',$patient->id)}}" class="form-group btn btn-danger btn-block">Cancel</a>
									</div> --}}

								</div>
								<!-- /.box-footer -->
							</form>
						</div>
					</div>
				</div>
				{{-- .row --}}
				@if (count($patient->visits) != 0)
				{{-- expr --}}
				
				<h2 class="page-header">PATIENT MEDICAL HISTORY</h2>

				{{-- {{$patient->visits}} --}}
				<div class="row">
					<div class="col-md-12">
						<div class="box box-solid box-primary">
							<div class="box-header">
								@if (Auth::user()->isRemoteDoc)
								<h3 class="box-title">Patient Medical History (Kenya Time)</h3>
								@else
								<h3 class="box-title">Patient Medical History</h3>
								@endif
							</div>{{-- .box-header --}}

							<div class="box-body">
								<div class="box-group" id="accordion">
									<?php $count=1; ?>
									@foreach ($patient->visits as $visit){{-- .loop a --}}
									<div class="panel box box-solid {{$count%2!=0 ?'box-primary':'box-warning'}}">
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
											<div class="box-tools pull-right">
												@if ($visit->user->isRemoteDoc)
												<span data-toggle="tooltip" title="Kenyan Consult" class="badge bg-blue">Kenyan Consult</span>
												@else
												{{-- <span data-toggle="tooltip" title="Indian Consult" class="badge bg-yellow">Indian Consult</span> --}}
												@endif

											</div>
										</div>
										<div id="collapse{{$count}}" class="panel-collapse collapse">
											<div class="box-body">
												<span class="badge bg-gray pull-right">Consultant: DR. {{$visit->user->name}}</span>
												@if ($visit->user->isRemoteDoc)
												<dl>
													<dt>Chief Complaints</dt>
													<dd>{{$visit->rem_complaints}}</dd>
													<dt>Patient History</dt>
													<dd>{{$visit->rem_history}}</dd>
													<dt>Doctor Notes</dt>
													<dd>{{$visit->rem_notes}}</dd>
												</dl>
												@if (count($visit->reports)>0)
												<table class="table table-bordered text-center">
													<thead style="background-color: #C0C0C0;">
														<th>Investigation Name</th>
														<th>Investigation Category</th>
														<th>Date of Investigation</th>
														<th>View Investigations</th>
													</thead>
													<tbody>
														@foreach ($visit->reports as $report)
														<tr>
															<td>
																{{$report->name}}
																<span class="label label-primary pull-right">
																	{{$report->images()->count()}}
																</span>
															</td>
															<td>{{$report->cat_name}}</td>
															<td>{{$report->report_date}}</td>
															<td>
																@foreach ($report->images as $image)
																<a href="{{url($image->file_path)}}" data-lightbox="myreports{{$report->id}}" >
																	<img id="report-images" src="{{url($image->file_path)}}" alt="">
																</a>
																@endforeach
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
												@else
												<div class="row">
													<div class="col-md-12">
														<div class="callout callout-info">
															<h4>No Reports Found!!</h4>
															<p>There are no reports found for this Patient Visit.</p>
														</div>
													</div>
												</div>
												@endif
												@else{{-- .if not Remote Doc then this --}}
												<dl>
													<dt>Chief Complaints</dt>
													<dd>{{$visit->chiefcomplaints}}</dd>
													<dt>Examination Findings</dt>
													<dd>{{$visit->examinationfindings}}</dd>
													<dt>History</dt>
													<dd>{{$visit->patienthistory}}</dd>
													<dt>Diagnosis</dt>
													<dd>{{$visit->diagnosis}}</dd>
													<dt>Advise</dt>
													<dd>{{$visit->advise}}</dd>
													<dt>Follow Up Date</dt>
													@if ($visit->isSOS)
													<dd>On SOS or With Reports</dd>
													@else
													{{-- <dd>{{$visit->nextvisit}}</dd> --}}
													<dd>{{$visit->nextvisit->format('d/m/Y')}}</dd>
													{{-- <dd>{{Carbon::createFromFormat('d/m/Y',$visit->nextvisit)}}</dd> --}}
													@endif
												</dl>
												
												@if (count($visit->prescriptions)>0)
												<div class="col-md-12">
													<div class="box">
														<div class="box-header with-border">
															<h3 class="box-title">Prescription</h3>
														</div>
														<!-- /.box-header -->
														<div class="box-body">
															<table class="table table-bordered text-center">
																<tr>
																	<th>Brand Name</th>
																	<th>Regime</th>
																	<th>Timing</th>
																	<th>Duration</th>
																	<th>Remarks</th>
																</tr>
																@foreach ($visit->prescriptions as $p)
																<tr>
																	<td><b>{{$p->medicinename}}</b><br><small><i>({{$p->medicinecomposition}})</i></small></td>
																	<td>{{$p->doseregime}}</td>
																	<td>{{$p->dosetimings}}</td>
																	<td>{{$p->doseduration}}</td>
																	<td><small><i>{{$p->remarks}}</i></small></td>
																</tr>
																@endforeach
																
															</table>
														</div>
														<!-- /.box-body -->
														
													</div>
													<!-- /.box -->
												</div>
												@endif
												@if ($visit->systolic != "" && $visit->diastolic !="")
												<div>
													<strong>BP </strong>{{$visit->systolic}}/{{$visit->diastolic}} mm Hg
												</div>	
												<br>
												@endif


												<dl>
													<dt>Recommended Clinical Followup</dt>
													<ul>
														@foreach ($visit->pathologies as $pathology)
														<li>{{$pathology->name}}</li>
														@endforeach
													</ul>
												</dl>


												@if (Auth::user()->id == $visit->user_id)
												<div class="box-footer clearfix">
													<a href="{{route('print.visits',$visit->id)}}" class="btn btn btn-success  pull-right"  target="_blank">Print</a>
												</div>{{-- expr --}}
												@endif

												@endif
											</div>{{-- .box-body --}}
										</div>
									</div>{{-- .panel --}}
									<?php $count++; ?>
									@endforeach{{-- .outer $patient->visits as $visit loop, end of loop a --}}
								</div>
							</div>{{-- .box-body --}}
						</div>{{-- .box --}}
					</div>
				</div>
				@endif
				{{-- .row --}}
				{{-- @else
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
				@endif --}}

				<!-- Modal -->
			{{-- 	<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Modal Header</h4>
							</div>
							<div class="modal-body">
								<p>Some text in the modal.</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div> --}}

				<div class="example-modal" >
					<div class="modal modal-primary" id="myModal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Add Medicine</h4>
									</div>
									<div class="modal-body">
										<form data-parsley-validate class="formmed" action="#"  enctype="multipart/form-data" method="POST">
											{{csrf_field()}}
											{{-- <div class="form-group">
												<label for="medname">Medicine Name</label>
												<input event.preventDefault(); autofocus="" required="" type="text" name="medname" id="medname" class="form-control">
											</div> --}}
											
											<div id="medname-error-label" class="form-group ">
												<label class="control-label" for="medname">Add Medicine</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
													<input event.preventDefault(); autofocus="" style="text-transform: capitalize;" type="text" name="medname" id="medname" class="form-control">
												</div>
												<span id="medname-error1" class="help-block"></span>
											</div>

											<div  class="form-group ">
												<label class="control-label" for="medicomp">Medicine Composition</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
													<input event.preventDefault(); autofocus="" type="text" name="medicomp" style="text-transform: capitalize;" id="medicomp" class="form-control">
												</div>
												<span  class="help-block"></span>
											</div>

											{{-- <div class="form-group">
												<label for="medcompo">Medicine Composition</label>
												<input event.preventDefault();  type="text" name="medcompo" id="medcompo" class="form-control">
											</div> --}}
											
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
											<button type="submit" id="addmedicine" class="btn btn-primary">Save changes</button>
										</div>
									</form>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<!-- /.modal -->
					</div>
					<!-- /.example-modal -->


					<div class="example-modal">
						<div class="modal modal-primary" id="myPathModal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Add New Investigation</h4>
										</div>
										<div class="modal-body">
											<form data-parsley-validate class="formpath" action="#" method=""  enctype="multipart/form-data" >
												{{csrf_field()}}
												<div id="pathname-error-label" class="form-group ">
													<label class="control-label" for="pathname">Add Investigation</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
														<input event.preventDefault(); autofocus="" type="text" name="pathname" style="text-transform: capitalize;" id="pathname" class="form-control">
													</div>
													<span id="pathname-error" class="help-block"></span>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
												<button type="submit" id="addpathology" class="btn btn-outline">Save changes</button>
											</div>
										</form>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							<!-- /.modal -->
						</div>
						<!-- /.example-modal -->

						{{-- ccModal --}}
						<div class="example-modal">
						<div class="modal modal-primary" id="ccModal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Add Chief Investigation Template</h4>
										</div>
										<div class="modal-body">
											<form data-parsley-validate class="formcc" action="#" method=""  enctype="multipart/form-data" >
												{{csrf_field()}}
												<div id="templatename-error-label" class="form-group ">
													<label class="control-label" for="templatename">Chief Complaint Template Name</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
														<input event.preventDefault(); autofocus="" type="text" name="templatename" style="text-transform: uppercase;" id="templatename" class="form-control">
													</div>
													<span id="templatename-error" class="help-block"></span>
												</div>
												
												<div id="template-error-label" class="form-group ">
													<label class="control-label" for="template">Chief Complaint Template</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
														<textarea event.preventDefault(); class="form-control" style="text-transform: uppercase;" id="template" name="template" id="template" cols="30" rows="5"></textarea>
														
													</div>
													<span id="template-error" class="help-block"></span>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
												<button type="submit" id="addcctemplate" class="btn btn-outline">Save changes</button>
											</div>
										</form>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							<!-- /.modal -->
						</div>
						<!-- /.example-modal -->

						<div class="example-modal">
						<div class="modal modal-primary" id="efModal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">Add Examination Findings Template</h4>
										</div>
										<div class="modal-body">
											<form data-parsley-validate class="formef" action="#" method=""  enctype="multipart/form-data" >
												{{csrf_field()}}
												<div id="templatenameef-error-label" class="form-group ">
													<label class="control-label" for="templatenameef">Examination Findings Template Name</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
														<input event.preventDefault(); autofocus="" type="text" name="templatenameef" style="text-transform: uppercase;" id="templatenameef" class="form-control">
													</div>
													<span id="templatenameef-error" class="help-block"></span>
												</div>
												
												<div id="templateef-error-label" class="form-group ">
													<label class="control-label" for="templateef">Examination Findings Template</label>
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
														<textarea event.preventDefault(); class="form-control" style="text-transform: uppercase;" id="templateef" name="templateef" id="templateef" cols="30" rows="5"></textarea>
														
													</div>
													<span id="templateef-error" class="help-block"></span>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
												<button type="submit" id="addeftemplate" class="btn btn-outline">Save changes</button>
											</div>
										</form>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							<!-- /.modal -->
						</div>
						<!-- /.example-modal -->

						<div class="row">
							<div class="col-md-4 col-md-offset-4">
								<a href="{{route('patients.show',$patient->id)}}" class="btn btn-primary btn-block"><< Back</a>
							</div>
						</div>
						@stop

						@section('scripts')
						<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
						{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script> --}}
						<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
						<script>
							var prescrip = [];
							var prescriprowcount = 0;

							$(document).ready(function(){
								$('#chiefcomplaints').focus();

								// $(".js-example-basic-multiple").select2({
								// 	placeholder: "Recommended Clinical follow up"
								// });
								$(".testselect").select2({
									placeholder: "Testing Select2"
								});

			//Datemask dd/mm/yyyy
			$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    		//Datemask2 mm/dd/yyyy
    		$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    		//Money Euro
    		$("[data-mask]").inputmask();
    		//console.log( "document loaded Dilip" );
    		$("#numdayslabel").hide();
    		$('#numdays').hide();
    		$("#nextvisitlabel").hide();
    		$("#nextvisit").hide();
			//$('#days').find('option[value="SOS"]').attr("selected", "selected");
			$("#followuptype").val("SOS").change();
			$("#doseregime1").val("M-A-N").change();
			$("#dosetime").val("bf").change();
			$("#doseduration").val("days").change();
			$('.doseregimespecial').hide();
			$('.dosetimespecial').hide();
			
			$('#dosemorning').empty();
			$('#doseafternoon').empty();
			$('#dosenight').empty();
			$('#dosemorning').append($('<option></option>').val('0').html('0'));
			$('#dosemorning').append($('<option></option>').val('1/4').html('1/4'));
			$('#dosemorning').append($('<option></option>').val('1/2').html('1/2'));
			$('#dosemorning').append($('<option></option>').val('1').html('1'));
			$('#dosemorning').append($('<option></option>').val('2').html('2'));
			$('#dosemorning').append($('<option></option>').val('3').html('3'));
			$('#dosemorning').append($('<option></option>').val('4').html('4'));
			$('#doseafternoon').append($('<option></option>').val('0').html('0'));
			$('#doseafternoon').append($('<option></option>').val('1/4').html('1/4'));
			$('#doseafternoon').append($('<option></option>').val('1/2').html('1/2'));
			$('#doseafternoon').append($('<option></option>').val('1').html('1'));
			$('#doseafternoon').append($('<option></option>').val('2').html('2'));
			$('#doseafternoon').append($('<option></option>').val('3').html('3'));
			$('#doseafternoon').append($('<option></option>').val('4').html('4'));
			$('#dosenight').append($('<option></option>').val('0').html('0'));
			$('#dosenight').append($('<option></option>').val('1/4').html('1/4'));
			$('#dosenight').append($('<option></option>').val('1/2').html('1/2'));
			$('#dosenight').append($('<option></option>').val('1').html('1'));
			$('#dosenight').append($('<option></option>').val('2').html('2'));
			$('#dosenight').append($('<option></option>').val('3').html('3'));
			$('#dosenight').append($('<option></option>').val('4').html('4'));

			$("#dosedurationdays").empty();
			$('.dosedurationdays').show();
			$("#dosedurationdayslabel").text("Days");
			$('#dosedurationdays').append($('<option></option>').val('1').html('1'));
			$('#dosedurationdays').append($('<option></option>').val('2').html('2'));
			$('#dosedurationdays').append($('<option></option>').val('3').html('3'));
			$('#dosedurationdays').append($('<option></option>').val('4').html('4'));
			$('#dosedurationdays').append($('<option></option>').val('5').html('5'));
			$('#dosedurationdays').append($('<option></option>').val('6').html('6'));
			$('#dosedurationdays').append($('<option></option>').val('7').html('7'));
			$('#dosedurationdays').append($('<option></option>').val('8').html('8'));
			$('#dosedurationdays').append($('<option></option>').val('9').html('9'));
			$('#dosedurationdays').append($('<option></option>').val('10').html('10'));
			$('#dosedurationdays').append($('<option></option>').val('11').html('11'));
			$('#dosedurationdays').append($('<option></option>').val('12').html('12'));
			$('#dosedurationdays').append($('<option></option>').val('13').html('13'));
			$('#dosedurationdays').append($('<option></option>').val('14').html('14'));
			$('#dosedurationdays').append($('<option></option>').val('15').html('15'));
			$('#dosedurationdays').append($('<option></option>').val('16').html('16'));
			$('#dosedurationdays').append($('<option></option>').val('17').html('17'));
			$('#dosedurationdays').append($('<option></option>').val('18').html('18'));
			$('#dosedurationdays').append($('<option></option>').val('19').html('19'));
			$('#dosedurationdays').append($('<option></option>').val('20').html('20'));
			$('#dosedurationdays').append($('<option></option>').val('21').html('21'));
			$('#dosedurationdays').append($('<option></option>').val('22').html('22'));
			$('#dosedurationdays').append($('<option></option>').val('23').html('23'));
			$('#dosedurationdays').append($('<option></option>').val('24').html('24'));
			$('#dosedurationdays').append($('<option></option>').val('25').html('25'));
			$('#dosedurationdays').append($('<option></option>').val('26').html('26'));
			$('#dosedurationdays').append($('<option></option>').val('27').html('27'));
			$('#dosedurationdays').append($('<option></option>').val('28').html('28'));
			$('#dosedurationdays').append($('<option></option>').val('29').html('29'));
			$('#dosedurationdays').append($('<option></option>').val('30').html('30'));
			$('#dosedurationdays').append($('<option></option>').val('31').html('31'));

			$('#doseduration').change(function(){
				$(this).find("option:selected").each(function(){
					var doseduropt = $(this).attr("value");
					if(doseduropt == "days"){
						$("#dosedurationdays").empty();
						$('.dosedurationdays').show();
						$("#dosedurationdayslabel").text("Days");
						$('#dosedurationdays').append($('<option></option>').val('1').html('1'));
						$('#dosedurationdays').append($('<option></option>').val('2').html('2'));
						$('#dosedurationdays').append($('<option></option>').val('3').html('3'));
						$('#dosedurationdays').append($('<option></option>').val('4').html('4'));
						$('#dosedurationdays').append($('<option></option>').val('5').html('5'));
						$('#dosedurationdays').append($('<option></option>').val('6').html('6'));
						$('#dosedurationdays').append($('<option></option>').val('7').html('7'));
						$('#dosedurationdays').append($('<option></option>').val('8').html('8'));
						$('#dosedurationdays').append($('<option></option>').val('9').html('9'));
						$('#dosedurationdays').append($('<option></option>').val('10').html('10'));
						$('#dosedurationdays').append($('<option></option>').val('11').html('11'));
						$('#dosedurationdays').append($('<option></option>').val('12').html('12'));
						$('#dosedurationdays').append($('<option></option>').val('13').html('13'));
						$('#dosedurationdays').append($('<option></option>').val('14').html('14'));
						$('#dosedurationdays').append($('<option></option>').val('15').html('15'));
						$('#dosedurationdays').append($('<option></option>').val('16').html('16'));
						$('#dosedurationdays').append($('<option></option>').val('17').html('17'));
						$('#dosedurationdays').append($('<option></option>').val('18').html('18'));
						$('#dosedurationdays').append($('<option></option>').val('19').html('19'));
						$('#dosedurationdays').append($('<option></option>').val('20').html('20'));
						$('#dosedurationdays').append($('<option></option>').val('21').html('21'));
						$('#dosedurationdays').append($('<option></option>').val('22').html('22'));
						$('#dosedurationdays').append($('<option></option>').val('23').html('23'));
						$('#dosedurationdays').append($('<option></option>').val('24').html('24'));
						$('#dosedurationdays').append($('<option></option>').val('25').html('25'));
						$('#dosedurationdays').append($('<option></option>').val('26').html('26'));
						$('#dosedurationdays').append($('<option></option>').val('27').html('27'));
						$('#dosedurationdays').append($('<option></option>').val('28').html('28'));
						$('#dosedurationdays').append($('<option></option>').val('29').html('29'));
						$('#dosedurationdays').append($('<option></option>').val('30').html('30'));
						$('#dosedurationdays').append($('<option></option>').val('31').html('31'));
					}else if(doseduropt == "weeks"){
						$("#dosedurationdays").empty();
						$('.dosedurationdays').show();
						$("#dosedurationdayslabel").text("Weeks");
						$('#dosedurationdays').append($('<option></option>').val('1').html('1'));
						$('#dosedurationdays').append($('<option></option>').val('2').html('2'));
						$('#dosedurationdays').append($('<option></option>').val('3').html('3'));
						$('#dosedurationdays').append($('<option></option>').val('4').html('4'));
						$('#dosedurationdays').append($('<option></option>').val('5').html('5'));
						$('#dosedurationdays').append($('<option></option>').val('6').html('6'));
					}else if(doseduropt == "months"){
						$("#dosedurationdays").empty();
						$('.dosedurationdays').show();
						$("#dosedurationdayslabel").text("Months");
						$('#dosedurationdays').append($('<option></option>').val('1').html('1'));
						$('#dosedurationdays').append($('<option></option>').val('2').html('2'));
						$('#dosedurationdays').append($('<option></option>').val('3').html('3'));
						$('#dosedurationdays').append($('<option></option>').val('4').html('4'));
						$('#dosedurationdays').append($('<option></option>').val('5').html('5'));
						$('#dosedurationdays').append($('<option></option>').val('6').html('6'));
						$('#dosedurationdays').append($('<option></option>').val('7').html('7'));
						$('#dosedurationdays').append($('<option></option>').val('8').html('8'));
						$('#dosedurationdays').append($('<option></option>').val('9').html('9'));
						$('#dosedurationdays').append($('<option></option>').val('10').html('10'));
						$('#dosedurationdays').append($('<option></option>').val('11').html('11'));
						$('#dosedurationdays').append($('<option></option>').val('12').html('12'));
					}else if(doseduropt == "years"){
						$("#dosedurationdays").empty();
						$('.dosedurationdays').show();
						$("#dosedurationdayslabel").text("Years");
						$('#dosedurationdays').append($('<option></option>').val('1').html('1'));
						$('#dosedurationdays').append($('<option></option>').val('2').html('2'));
						$('#dosedurationdays').append($('<option></option>').val('3').html('3'));
						$('#dosedurationdays').append($('<option></option>').val('4').html('4'));
						$('#dosedurationdays').append($('<option></option>').val('5').html('5'));
					}else if(doseduropt == "sos"){
						$('.dosedurationdays').hide();
					}else if(doseduropt == "lifetime"){
						$('.dosedurationdays').hide();
					}
				});
});

$('#dosetime').change(function(){
	$(this).find("option:selected").each(function(){
		var dtoption = $(this).attr("value");
		if(dtoption=="bf"){
			$('.dosetimespecial').hide();
		}else if(dtoption == "af"){
			$('.dosetimespecial').hide();
		}else if(dtoption == "wf"){
			$('.dosetimespecial').hide();
		}else if(dtoption == "oth"){
			$('.dosetimespecial').show();
		}
	});
});

$("#doseregime1").change(function(){
	$(this).find("option:selected").each(function(){
		var hell = $(this).attr("value");
		if(hell == "M-A-N"){
			$('.dosemorning').show();
			$('.doseafternoon').show();
			$('.dosenight').show();

			$('#dosemorninglabel').text("Morning");
			$('#doseafternoonlabel').text("Afternoon");
			$('#dosenightlabel').text("Night");

			$('#dosemorninglabel').show();
			$('#doseafternoonlabel').show();
			$('#dosenightlabel').show();

			$('.doseregimespecial').hide();

			$('#dosemorning').show();
			$('#dosemorning').empty();
			$('#dosemorning').append($('<option></option>').val('0').html('0'));
			$('#dosemorning').append($('<option></option>').val('1/4').html('1/4'));
			$('#dosemorning').append($('<option></option>').val('1/2').html('1/2'));
			$('#dosemorning').append($('<option></option>').val('1').html('1'));
			$('#dosemorning').append($('<option></option>').val('2').html('2'));
			$('#dosemorning').append($('<option></option>').val('3').html('3'));
			$('#dosemorning').append($('<option></option>').val('4').html('4'));

			$('#doseafternoon').show();
			$('#doseafternoon').empty();
			$('#doseafternoon').append($('<option></option>').val('0').html('0'));
			$('#doseafternoon').append($('<option></option>').val('1/4').html('1/4'));
			$('#doseafternoon').append($('<option></option>').val('1/2').html('1/2'));
			$('#doseafternoon').append($('<option></option>').val('1').html('1'));
			$('#doseafternoon').append($('<option></option>').val('2').html('2'));
			$('#doseafternoon').append($('<option></option>').val('3').html('3'));
			$('#doseafternoon').append($('<option></option>').val('4').html('4'));

			$('#dosenight').show();
			$('#dosenight').empty();
			$('#dosenight').append($('<option></option>').val('0').html('0'));
			$('#dosenight').append($('<option></option>').val('1/4').html('1/4'));
			$('#dosenight').append($('<option></option>').val('1/2').html('1/2'));
			$('#dosenight').append($('<option></option>').val('1').html('1'));
			$('#dosenight').append($('<option></option>').val('2').html('2'));
			$('#dosenight').append($('<option></option>').val('3').html('3'));
			$('#dosenight').append($('<option></option>').val('4').html('4'));

		}else if(hell == "SOS"){
			$('#dosemorninglabel').text("SOS");
			$('.dosemorning').show();

			$('#dosemorninglabel').show();
			$('#doseafternoonlabel').hide();
			$('#dosenightlabel').hide();

			$('#dosemorning').show();
			$('#dosemorning').empty();
			$('#dosemorning').append($('<option></option>').val('0').html('0'));
			$('#dosemorning').append($('<option></option>').val('1').html('1'));
			$('#dosemorning').append($('<option></option>').val('2').html('2'));
			$('#dosemorning').append($('<option></option>').val('3').html('3'));
			$('#dosemorning').append($('<option></option>').val('4').html('4'));

			$('#doseafternoon').empty();
			$('#doseafternoon').hide();

			$('#dosenight').empty();
			$('#dosenight').hide();

			$('.doseregimespecial').hide();
		}else if(hell == "Other"){
			$('.doseregimespecial').show();
			$('.dosemorning').hide();
			$('.doseafternoon').hide();
			$('.dosenight').hide();
		}
	});

});

$("#followuptype").change(function(){
	$(this).find("option:selected").each(function(){
		var optionValue = $(this).attr("value");
		console.log(optionValue);
		if(optionValue == "SOS"){
			$("#numdayslabel").hide();
			$("#numdays").hide();
			$("#nextvisitlabel").hide();
			$("#nextvisit").hide();
		} else if(optionValue == "Days"){
			$("#nextvisitlabel").show();
			$("#nextvisit").show();
			$("#numdayslabel").text("(Days)");
			$("#numdayslabel").show();
			$("#numdays").show();
			$("#numdays").empty();

			$('#numdays').append($('<option></option>').val('1').html('1'));
			$('#numdays').append($('<option></option>').val('2').html('2'));
			$('#numdays').append($('<option></option>').val('3').html('3'));
			$('#numdays').append($('<option></option>').val('4').html('4'));
			$('#numdays').append($('<option></option>').val('5').html('5'));
			$('#numdays').append($('<option></option>').val('6').html('6'));
			$('#numdays').append($('<option></option>').val('7').html('7'));
			$('#numdays').append($('<option></option>').val('8').html('8'));
			$('#numdays').append($('<option></option>').val('9').html('9'));
			$('#numdays').append($('<option></option>').val('10').html('10'));
			$('#numdays').append($('<option></option>').val('11').html('11'));
			$('#numdays').append($('<option></option>').val('12').html('12'));
			$('#numdays').append($('<option></option>').val('13').html('13'));
			$('#numdays').append($('<option></option>').val('14').html('14'));
			$('#numdays').append($('<option></option>').val('15').html('15'));
			$('#numdays').append($('<option></option>').val('16').html('16'));
			$('#numdays').append($('<option></option>').val('17').html('17'));
			$('#numdays').append($('<option></option>').val('18').html('18'));
			$('#numdays').append($('<option></option>').val('19').html('19'));
			$('#numdays').append($('<option></option>').val('20').html('20'));
			$('#numdays').append($('<option></option>').val('21').html('21'));
			$('#numdays').append($('<option></option>').val('22').html('22'));
			$('#numdays').append($('<option></option>').val('23').html('23'));
			$('#numdays').append($('<option></option>').val('24').html('24'));
			$('#numdays').append($('<option></option>').val('25').html('25'));
			$('#numdays').append($('<option></option>').val('26').html('26'));
			$('#numdays').append($('<option></option>').val('27').html('27'));
			$('#numdays').append($('<option></option>').val('28').html('28'));
			$('#numdays').append($('<option></option>').val('29').html('29'));
			$('#numdays').append($('<option></option>').val('30').html('30'));
			$('#numdays').append($('<option></option>').val('31').html('31'));

			$test =	$('#numdays').val();
			$("#numdays").change(function(){
				$test =	$('#numdays').val();
				$mom = moment().add($test,'days').format('DD-MM-YYYY');
				$('#nextvisit').val($mom);
			});
			$mom = moment().add($test,'days').format('DD-MM-YYYY');

			$('#dp').val($mom);
			$('#nextvisit').val($mom);

			console.log($mom);
		}else if(optionValue == "Months"){
			$("#nextvisitlabel").show();
			$("#nextvisit").show();
			$("#numdayslabel").text("(Months)");
			$("#numdayslabel").show();
			$("#numdays").show();
			$("#numdays").empty();
			$('#numdays').append($('<option></option>').val('1').html('1'));
			$('#numdays').append($('<option></option>').val('2').html('2'));
			$('#numdays').append($('<option></option>').val('3').html('3'));
			$('#numdays').append($('<option></option>').val('4').html('4'));
			$('#numdays').append($('<option></option>').val('5').html('5'));
			$('#numdays').append($('<option></option>').val('6').html('6'));
			$('#numdays').append($('<option></option>').val('7').html('7'));
			$('#numdays').append($('<option></option>').val('8').html('8'));
			$('#numdays').append($('<option></option>').val('9').html('9'));
			$('#numdays').append($('<option></option>').val('10').html('10'));
			$('#numdays').append($('<option></option>').val('11').html('11'));
			$('#numdays').append($('<option></option>').val('12').html('12'));
			$test =	$('#numdays').val();
			$("#numdays").change(function(){
				$test =	$('#numdays').val();
				$mom = moment().add($test,'months').format('DD-MM-YYYY');
				$('#nextvisit').val($mom);
			});
			$mom = moment().add($test,'months').format('DD-MM-YYYY');
			$('#dp').val($mom);
			$('#nextvisit').val($mom);
		}
	});
});
});

$("#pathology").select2({
	ajax: {
		multiple:true,
		url: '{{URL::route('pathologies.index')}}',
		type: 'GET',
		dataType: 'json',
		delay:250,
		data: function(params){
			return {
				q: params.term,
			};
		},
		processResults: function(data, params){
			return{
				results:data,
			};
		},
		cache:true,
	},
	minimumInputLength:3,
});

$(".medname").select2({
	
	ajax: {
		multiple: false,
		url:'{{URL::route('medicines.index',Auth::user()->id)}}',
		type:'GET',
		dataType:'json',
		delay:250,
		data: function(params){
			return {
        q: params.term, // search term
        //page: params.page
    };
},
processResults: function (data, params) {
      // parse the results into the format expected by Select2
      // since we are using custom formatting functions we do not need to
      // alter the remote JSON data, except to indicate that infinite
      // scrolling can be used
      //params.page = params.page || 1;

      return {
      	results: data,
      	// pagination: {
      	// 	more: (params.page * 30) < data.total_count
      	// }
      };
  },
  cache: true
},
//escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
minimumInputLength: 3,
  //templateResult: formatRepo, // omitted for brevity, see the source of this page
  //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
});

$( function() {

	$( "#chiefcomplaints" ).autocomplete({
      // source: "http://localhost:8000/templates"
      source: "{{route('templates.showcc')}}",
      minLength: 3
  });
} );

$(function(){
	$("#examinationfindings").autocomplete({
		source: "{{route('templates.showef')}}",
		minLength: 3
	});
});



$("#bbb").click(function(){
	$('#consult').validate({
		onsubmit: false,
		rules:{
			medname: {
				required: true
			}
		},
		messages:{
			medname:{
				required: "Brand Name is required"
			}
		},
		errorPlacement: function(error,element){
			console.log(element.attr("name"));
			if(element.attr("name") == "medname"){
				error.appendTo("#messagebox");
			}
		},
		success:function(label,element){
			//Array prescrip is declared as an empty array on page load
			prescrip = [];
			//Array prescriprowcount is declared and intialized to 0 on page load, incremented on ever prescription added
			prescriprowcount++;

			var medicinename = $('.medname').select2('data')[0]['text'];
			var medicinecomp = $('.medname').select2('data')[0]['composition'];
			var mednameonly = $('.medname').select2('data')[0]['mednameonly'];
			var medicineid = $('.medname').select2('data')[0]['id'];
			var doseregimetype = $('#doseregime1').val();
			var doseregime = '';
			var dosetime = '';
			var dosetimetype = $('#dosetime').val();
			var doseduration = '';
			var dosedurationtype = $('#doseduration').val();
			var docremarks = $('#remarks').val();

			if(doseregimetype=="M-A-N"){
				doseregime = $('#dosemorning').val() + '-' + $('#doseafternoon').val() + '-' + $('#dosenight').val();
			}else if(doseregimetype=="SOS"){
				doseregime = 'SOS - ' + $('#dosemorning').val();
			}else if(doseregimetype=="Other"){
				doseregime = $('#doseregimespecial').val();
			}

			if(dosetimetype == "bf"){
				dosetime = 'Before Food';
			}else if(dosetimetype == "af"){
				dosetime = 'After Food';
			}else if(dosetimetype == "wf"){
				dosetime = 'With Food';
			}else if(dosetimetype == "oth"){
				dosetime = $('#dosetimespecial').val();
			}

			if(dosedurationtype == "days"){
				if($('#dosedurationdays').val() == "1"){
					doseduration = "1 Day";
				}else{
					doseduration = $('#dosedurationdays').val() + " Days";
				}
			}else if(dosedurationtype == "weeks"){
				if($('#dosedurationdays').val() == "1"){
					doseduration = "1 Week";
				}else{
					doseduration = $('#dosedurationdays').val() + " Weeks";
				}
			}else if(dosedurationtype == "months"){
				if($('#dosedurationdays').val() == "1"){
					doseduration = "1 Month";
				}else{
					doseduration = $('#dosedurationdays').val() + " Months";
				}
			}else if(dosedurationtype == "years"){
				if($('#dosedurationdays').val() == "1"){
					doseduration = "1 Year";
				}else{
					doseduration = $('#dosedurationdays').val() + " Years";
				}
			}else if(dosedurationtype == "sos"){
				doseduration = "SOS";
			}else if(dosedurationtype == "lifetime"){
				doseduration = "Lifetime";
			}

			prescrip.push(medicinename,doseregime,dosetime,doseduration,docremarks);
			//var nameasd = prescrip[3];
			//console.log(bn);
			// $('#scriplist').append('<li class="plist"><input type="hidden" name="medid[]" value="'+ medicineid +'"><small class="label label-danger"><i class="fa fa-heartbeat"></i> Brand Name</small><span class="text">'+ medicinename +'</span><div class="pull-right"><a class="rem" style="color: crimson;"><i class="fa fa-trash"></i></a></div><br><input type="hidden" name="doseduration[]" value="'+ doseduration +'"><small class="label label-warning"><i class="fa fa-calendar-check-o"></i> Dose Duration</small><span class="text">'+ doseduration +'</span> |<input type="hidden" name="dosetimings[]" value="'+ dosetime +'"><small class="label label-primary"><i class="fa fa-clock-o"></i> Dose Timings</small><span class="text">'+ dosetime +'</span> |<input type="hidden" name="doseregime[]" value="'+ doseregime +'"><small class="label label-success"><i class="fa fa-asterisk "></i> Dose Regime</small><span class="text">'+ doseregime +'</span><br><input type="hidden" name="remarks[]" value="'+ docremarks +'"><small class="label label-info"><i class="fa fa-comments "></i> Remarks</small><span class="text">'+ docremarks +'</span></li>');
			// 
			// $('#scriplist').append('<li class="plist"><input type="hidden" name="medid[]" value="'+ medicineid + '"><small class="label label-danger"><i class="fa fa-heartbeat"></i> Brand Name</small><span class="text">'+ medicinename +'</span><div class="pull-right"><a class="rem" style="color: crimson;"><i class="fa fa-trash"></i></a></div><br><small class="label label-warning"><i class="fa fa-calendar-check-o"></i> Dose Duration</small><span class="text">'+ doseduration +'</span> |<small class="label label-primary"><i class="fa fa-clock-o"></i> Dose Timings</small><span class="text">Before Food</span> |<small class="label label-success"><i class="fa fa-asterisk "></i> Dose Regime</small><span class="text">1-1-2</span><br><small class="label label-info"><i class="fa fa-comments "></i> Remarks</small><span class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam distinctio s </span></li>');
			// 
			$('#scriplist').append('<li class="plist"><input type="hidden" name="medid[]" value="'+ medicineid +'"><input type="hidden" name="mednameonly[]" value="'+ mednameonly +'"><input type="hidden" name="medcomp[]" value="'+ medicinecomp +'"><small class="label label-danger"><i class="fa fa-heartbeat"></i> Brand Name</small><span class="text">'+ medicinename +'</span><div class="pull-right"><a class="rem" style="color: crimson;"><i class="fa fa-trash"></i></a></div><br><input type="hidden" name="doseduration[]" value="'+ doseduration +'"><small class="label label-warning"><i class="fa fa-calendar-check-o"></i> Dose Duration</small><span class="text">'+ doseduration +'</span> |<input type="hidden" name="dosetimings[]" value="'+ dosetime +'"><small class="label label-primary"><i class="fa fa-clock-o"></i> Dose Timings</small><span class="text">'+ dosetime +'</span> |<input type="hidden" name="doseregime[]" value="'+ doseregime +'"><small class="label label-success"><i class="fa fa-asterisk "></i> Dose Regime</small><span class="text">'+ doseregime +'</span><br><input type="hidden" name="remarks[]" value="'+ docremarks +'"><small class="label label-info"><i class="fa fa-comments "></i> Remarks</small><span class="text">'+ docremarks +'</span></li>');
			
			$(".medname").select2("val", " ");
			$("#doseregime1").val("M-A-N").change();
			$("#dosetime").val("bf").change();
			$("#dosetimespecial").val('');
			$("#doseregimespecial").val('');
			$('#doseduration').val("days").change();
			$('#remarks').val('');
			console.log(prescrip,prescriprowcount);
		}

	});
$('#consult').valid();
	//$("[name='medname']").valid();
});

$("#clear").click(function(){
	$(".medname").select2("val", " ");

});

$("#addmedicine").click(function(e){
	e.preventDefault();
	$.ajax({
		type: "POST",
		url: "/medicines",
		
		data: $("form.formmed").serialize(),
		success: function(response){
			$('#medname').val('');
			$("#myModal").modal('hide');

		},
		error: function(data){
			console.log(data.responseText);
			var obj = jQuery.parseJSON( data.responseText );
			if(obj.medname){
				$("#medname-error-label").addClass("has-warning");
				$( '#medname-error1' ).html( obj.medname );
			}

		}
	});
	return false;
});

$('#addpathology').click(function(e){
	e.preventDefault();
	$.ajax({
		type: "POST",
		url : "/pathologies",
		data: $("form.formpath").serialize(),
		success:function(response){
			$("#myPathModal").modal('hide');
		},
		error: function(data){
			console.log(data.responseText);
			var obj = jQuery.parseJSON( data.responseText );
			if(obj.pathname){
				$("#pathname-error-label").addClass("has-warning");
				$('#pathname-error').html( obj.pathname );
			}
			//alert('error');
		}
	});
	//return false;
});

$('#addcctemplate').click(function(e){
	e.preventDefault();
	$.ajax({
		type: "POST",
		url : "/storecc",
		data: $("form.formcc").serialize(),
		success:function(response){
			$("#ccModal").modal('hide');
		},
		error:function(data){
			console.log(data.responseText);
			var obj = jQuery.parseJSON(data.responseText);
			if (obj.templatename) {
				$("#templatename-error-label").addClass("has-warning");
				$('#templatename-error').html(obj.templatename);
			}
			if (obj.template) {
				$("#template-error-label").addClass("has-warning");
				$('#template-error').html(obj.template);
			}
		}
	});
});

$('#addeftemplate').click(function(e){
	e.preventDefault();
	$.ajax({
		type: "POST",
		url: "/storeef",
		data: $("form.formef").serialize(),
		success: function(response){
			$("#efModal").modal('hide');
		},
		error: function(data){
			var obj = jQuery.parseJSON(data.responseText);
			if(obj.templatenameef){
				$("#templatenameef-error-label").addClass("has-warning");
				$('#templatenameef-error').html(obj.templatenameef);
			}
			if (obj.templateef) {
				$("#templateef-error-label").addClass("has-warning");
				$('#templateef-error').html(obj.templateef);
			}
		}
	});
});

// $("#addpath").click(function(e){
// 	e.preventDefault();
// 	$.ajax({
// 		type: "POST",
// 		url:"/pathologies",
// 		data: $("form.formpath").serialize(),
// 		success: function(response){
// 			// $("#myPathModal").modal('hide');
// 		},
// 		error: function(data){
// 			console.log(data.responseText);
// 		}
// 	});
// 	return false;
// });

$("#addmed").click(function(){
	$(".medname").select2("val", " ");
});

$('#testme').click(function(){
	var rest = nums[3];
	console.log(rest);
});

$('.rem').click(function(){
	//console.log('Hello');
	//$(this).closest('.row').remove();
	$(this).closest('.plist').remove();
});

$(document).on('click', '.rem', function(){ 
	//console.log('Hello');
	//$(this).closest('.row').remove();
	$(this).closest('.plist').remove();
});

</script>
@stop