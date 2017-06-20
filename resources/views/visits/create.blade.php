@extends('layouts.master')
@section('title')
| New Patient Visit
@stop
@section('pageheading')
New Patient Visit
@stop
@section('subpageheading')
Create a New Visit
@stop
@section('content')
<div class="row">
  <div class="col-md-12 col-xs-12">
   <div class="box box-primary">
    <div class="box-header with-border text-center">
      <h3 class="box-title">{{$patient->name}}</h3><br><small class="text-green">
      @if ($patient->dob != "1900-01-01 00:00:00")
      Age: {{$patient->dob->diff(Carbon::now())->format('%y Years, %m Months and %d Days')}}
      @else
      Age: Date of Birth Not Provided
      @endif
    </small><br><small class="text-red">Known Allergies : {{$patient->allergies}}</small>
  </div>
  <!-- /.box-header -->

  <div class="box-body">
    <div class="row">
      <form action="{{route('visits.store')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="patient_id" value="{{$patient->id}}">
        <div class="col-md-6 col-xs-12">
          <div class="form-group {{ $errors->has('rem_complaints')?'has-error':''}}">
            <label class="control-label" for="rem_complaints">Chief Complaints</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
              <textarea  autofocus=""  name="rem_complaints" id="rem_complaints" class="form-control" cols="30" rows="10" style="resize: none;">{{old('rem_complaints')}}</textarea>
            </div>
            <span class="help-block">{{$errors->first('rem_complaints')}}</span>
          </div>
        </div>

        <div class="col-md-6 col-xs-12">
          <div class="form-group {{ $errors->has('rem_history')?'has-error':''}}">
            <label class="control-label" for="rem_history">Patient History</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
              <textarea   name="rem_history" id="rem_history" class="form-control" cols="30" rows="10" style="resize: none;">{{old('rem_history')}}</textarea>
            </div>
            <span class="help-block">{{$errors->first('rem_history')}}</span>
          </div>
        </div>
      </div>{{-- .row --}}
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="form-group {{ $errors->has('rem_notes')?'has-error':''}}">
            <label class="control-label" for="rem_notes">Doctor Notes</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>
              <textarea   name="rem_notes" id="rem_notes" class="form-control" cols="30" rows="5" style="resize: none;">{{old('rem_notes')}}</textarea>
            </div>
            <span class="help-block">{{$errors->first('rem_notes')}}</span>
          </div>
        </div>
      </div>

    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix text-center">
      <div class="row">
        <div class="col-md-6">
          <button type="submit" class="btn btn-success btn-block ">Save & Add Investigation Images</button>
        </div>
        <div class="col-md-6">
          <a href="{{route('patients.show',$patient->id)}}" class="btn btn-danger btn-block ">Cancel</a>  
        </div>
      </div>
      {{--  <ul class="pagination pagination-sm no-margin text-center"> --}}

      {{--  </ul> --}} 

    </div>{{-- .box-footer --}}
  </div>
  <!-- /.box -->
</div>{{-- .col-md-6 --}}

</form>
</div>{{-- .row --}}
@stop