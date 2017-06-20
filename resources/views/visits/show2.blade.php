@extends('layouts.master')
@section('title')
| Patient Visits
@stop
@section('pageheading')
View Patient Visits		
@stop
@section('subpageheading')
Patient Visit Details
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
				<h5 class="widget-user-desc"><span class="badge bg-gray">Created On: {{$patient->created_at->format('D, d F Y')}}</span> | <span class="badge bg-gray">Created By: DR. {{$user->name}}</span> </h5>
				
			</div>
		</div>
		<!-- /.widget-user -->
		<h2 class="page-header">Patient Visits</h2>
	</div>
</div>
{{-- .row --}}

@if (count($patient->visits) != 0)
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid box-primary">
			<div class="box-header with-border">
				@if (Auth::user()->isRemoteDoc)
				<h3 class="box-title">Patient Visit (Kenya Time)</h3>
				@else
				<h3 class="box-title">Patient Visit (Indian Time)</h3>
				@endif
				
			</div><!-- /.box-header -->

			<div class="box-body">
				<div class="box-group" id="accordion">
					<?php $count=1; ?>
					@foreach ($patient->visits as $visit){{-- .loop a --}}
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
						</div>
						<div id="collapse{{$count}}" class="panel-collapse collapse {{$count=='1'?'in':''}}">
							<div class="box-body">
								<span class="badge bg-gray pull-right">Consultant: DR. {{$visit->user->name}}</span>
							</div>
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
									<th>Report Name</th>
									<th>Report Category</th>
									<th>View Reports</th>
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
							</dl>
							@if (Auth::user()->isRemoteDoc)
								<div class="row">
								<hr>
									<div class="col-md-12">
										<a href="" class="btn btn-warning pull-right">Print</a>
										<br>
									</div>
								</div>
							@endif

							@endif{{-- .endif to check for Remote Doc --}}
						</div>
					</div>
					<?php $count++; ?>
					@endforeach{{-- .outer $patient->visits as $visit loop, end of loop a --}}
				</div>{{-- .box-group --}}
			</div>{{-- .box-body --}}
		</div>{{-- .box.box-solid.box-primary --}}
	</div>{{-- .col-md-12 --}}
</div>{{-- .row --}}
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

					<p>No previous patient visits found. If this is a new visit, please create a new visit from the previous page, if not, please contact your system administrator.</p>
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

































































