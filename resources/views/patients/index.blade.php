@extends('layouts.master')
@section('title')
	| All Patients
@stop
@section('pageheading')
	All Patients		
@stop
@section('subpageheading')
	View/Search for Patients registered with Clinic
@stop
@section('content')
	{{-- {{$patients}} --}}
	<div class="row">
        <div class="col-xs-12">
 			<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Registered Patients</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Primary Phone</th>
                  <th>Alternate Phone</th>
                  <th>Email</th>
                  <th>Patient Code</th>
                   <th>Registered On</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($patients as $patient)
                	<tr>
	                  <td><a href="{{route('patients.show',$patient->id)}}">{{$patient->name}} {{$patient->midname}} {{$patient->surname}}</a></td>
	                  <td>{{$patient->phoneprimary}}</td>
	                  <td>{{$patient->phonealternate}}</td>
	                  <td>{{$patient->email}}</td>
	                  <td>{{$patient->patientcode}}</td>
	                   <td>{{date('M j, Y',strtotime($patient->created_at))}}</td>
                	</tr>
                @endforeach
                
                  
                </tbody>
                <tfoot>
                <tr>
                  <th>Full Name</th>
                  <th>Primary Phone</th>
                  <th>Alternate Phone</th>
                  <th>Email</th>
                  <th>Patient Code</th>
                   <th>Registered On</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
@stop