@extends('layouts.app')
@section('title')
	| Add Clinic
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Clinic</div>
                <div class="panel-body">
                     
                    <form data-parsley-validate class="form-horizontal" role="form" method="POST" action="{{route('clin')}}">
                        {{ csrf_field() }}

                        
                	   <div class="form-group">
                            <label for="clinictoken">Clinic Token</label>
                            <input type="text" name="clinictoken" id="clinictoken" class="form-control">   
                       </div>	
                      

                		 
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