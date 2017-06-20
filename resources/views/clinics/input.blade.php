@extends('layouts.app')
@section('title')
	| Select Clinic
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Enter Clinic Code</div>
                <div class="panel-body">
                     
                    <form data-parsley-validate class="form-horizontal" role="form" method="POST" action="{{route('cliniccheck')}}">
                        {{ csrf_field() }}
                
                       
                        <div class="form-group{{ $errors->has('cliniccode') ? ' has-error' : '' }}">
                            <label for="cliniccode" class="col-md-4 control-label">Clinic Code</label>

                            <div class="col-md-6">
                                <input id="cliniccode" type="text" class="form-control" name="cliniccode" value="{{ old('cliniccode') }}" autofocus=""  data-parsley-required-message="*The Clinic Code is required to be filled in!" placeholder="Clinic Code">

                                @if ($errors->has('cliniccode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cliniccode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       {{--  <div class="form-group{{ $errors->has('clinictoken') ? ' has-error' : '' }}">
                            <label for="clinictoken" class="col-md-4 control-label">Clinic Token</label>

                            <div class="col-md-6">
                                <input id="clinictoken" type="text" class="form-control" name="clinictoken" value="{{ old('clinictoken') }}" required="" data-parsley-required-message="*The Clinic Token value is required to be filled in!" placeholder="Please enter valid Clinic Token">

                                @if ($errors->has('clinictoken'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clinictoken') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-block">
                                    Next >>
                                </button>
                                
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
