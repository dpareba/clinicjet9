@extends('layouts.master')
@section('title')
	| Add New Patient
@stop
@section('pageheading')
	Add New Patient
@stop
@section('subpageheading')
	Register new patients in clinic
@stop
@section('content')
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="box box-primary">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Register New Patient</h3><br><small class="text-green">(New Patient Registration in Clinic)</small>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <form data-parsley-validate action="{{route('patients.store')}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group {{ $errors->has('name')?'has-error':''}}">
                      <label class="control-label" for="name">Full Name</label>
                      <div class="input-group">
                      	 <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>
                      	<input required="" value="{{old('name')}}" autofocus="" type="text" class="form-control" maxlength="255" id="name" name="name" placeholder="Enter Patient's Full Name"  data-parsley-required-message="Patient Name cannot be left blank">
                      </div>
                      
                      <span class="help-block">{{$errors->first('name')}}</span>
                    </div>
                    </div>

                    <div class="col-md-6 col-xs-12">
                      <div class="form-group {{ $errors->has('gender')?'has-error':''}}">
                      <label class="control-label" for="gender">Gender</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-transgender-alt"></i></span>
                        <select required="" name="gender" id="gender" class="form-control">
                        <option value="Male" selected="selected">Male</option>
                        <option value="Female" >Female</option>
                        <option value="Other" >Other</option>
                      </select>
                      </div>
                     <span class="help-block">{{$errors->first('gender')}}</span>
                    </div>
                    </div>
                   </div>{{-- .row --}}

                   <div class="row">
                     <div class="col-md-6 col-xs-12">
                       <div class="form-group {{ $errors->has('phoneprimary')?'has-error':''}}">
                        <label class="control-label" for="phoneprimary">Primary Phone</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-volume-control-phone"></i></span>
                          <input data-parsley-type="digits" value="{{old('phoneprimary')}}" type="text" class="form-control" id="phoneprimary" name="phoneprimary" placeholder="Enter Primary Phone Number" maxlength="15">
                        </div>
                        <span class="help-block">{{$errors->first('phoneprimary')}}</span>
                      </div>
                     </div>

                     <div class="col-md-6 col-xs-12">
                        <div class="form-group {{ $errors->has('phonealternate')?'has-error':''}}">
                        <label class="control-label" for="phonealternate">Alternate Phone</label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-volume-control-phone"></i></span>
                          <input data-parsley-type="digits" value="{{old('phonealternate')}}" type="text" class="form-control" id="phonealternate" name="phonealternate" placeholder="Enter Alternate Phone Number" maxlength="15">
                        </div>
                        <span class="help-block">{{$errors->first('phonealternate')}}</span>
                        </div>
                     </div>
                   </div>{{-- .row --}}

                   <div class="row">
                     <div class="col-md-6 col-xs-12">
                       <div class="form-group {{ $errors->has('email')?'has-error':''}}">
                      <label class="control-label" for="email">Email Address</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                        <input value="{{old('email')}}" data-parsley-type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address">
                      </div>
                    <span class="help-block">{{$errors->first('email')}}</span>
                    </div>
                     </div>

                     <div class="col-md-6 col-xs-12">
                       
                    <div class="form-group {{ $errors->has('bloodgroup')?'has-error':''}}">
                      <label class="control-label" for="bloodgroup">Blood Group</label>
                      <div class="input-group">
                        <span  class="input-group-addon"><i class="fa fa-tint"></i></span>
                        <select required="" name="bloodgroup" id="bloodgroup" class="form-control">
                        <option value="Not Known" selected="selected">Not Known</option>
                        <option value="A+" >A RhD positive (A+)</option>
                        <option value="A-" >A RhD negative (A-)</option>
                        <option value="B+" >B RhD positive (B+)</option>
                        <option value="B-" >B RhD negative (B-)</option>
                        <option value="O+" >O RhD positive (O+)</option>
                        <option value="O-" >O RhD negative (O-)</option>
                        <option value="AB+" >AB RhD positive (AB+)</option>
                        <option value="AB-" >AB RhD negative (AB-)</option>
                      </select>
                      </div>
                     <span class="help-block">{{$errors->first('bloodgroup')}}</span>
                    </div>

                     </div>
                   </div>{{-- .row --}}

                   <div class="row">
                     
                     <div class="col-md-6 col-xs-12">
                       <div class="form-group {{ $errors->has('address')?'has-error':''}}">
                      <label class="control-label" for="address">Postal Address</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                        <textarea  name="address" id="address" class="form-control" cols="30" rows="5" style="resize: none;">{{old('address')}}</textarea>
                      </div>
                    <span class="help-block">{{$errors->first('address')}}</span>
                    </div>
                    </div>

                    <div class="col-md-6 col-xs-12">
                      
                     <div class="form-group {{ $errors->has('allergies')?'has-error':''}}">
                      <label class="control-label" for="allergies">Known Allergies</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bug"></i></span>
                        <textarea  name="allergies" id="allergies" class="form-control" cols="30" rows="5" style="resize: none;">{{old('allergies')}}</textarea>
                      </div>
                    <span class="help-block">{{$errors->first('allergies')}}</span>
                    </div>

                    </div>
                   </div>{{-- .row --}}
					{{-- DOB Pending --}}
                   {{--  <div class="form-group {{ $errors->has('dob')?'has-error':''}}">
                      <label class="control-label" for="dob">DOB</label>
                       <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                    	<input  type="text" class="form-control" name="dob" id="dob" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                        </div>  
                        <span class="help-block">{{$errors->first('dob')}}</span>
                    </div> --}}

					
                    
                    

					          
                    
                    
                     {{--  <button type="submit" class="btn btn-success btn-block btn-sm">Register New Patient</button>
                    <br> --}}
                   {{-- </form> --}}
               
                {{-- <div class="col-xs-2 col-xs-offset-5">
                  <a href="{{route('passkeys.index')}}"  class="btn btn-default btn-block btn-sm"><i class="fa fa-refresh"></i></a>
                  <br>
                </div> --}}
                
              
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix text-center">
            	<div class="row">
            		<div class="col-md-6">
            			<button type="submit" class="btn btn-success btn-block btn-sm">Register New Patient</button>  
            		</div>
            		<div class="col-md-6">
                  <a href="{{route('patients.index')}}" class="btn btn-danger btn-block btn-sm">Cancel</a>  
                </div>
            	</div>
            {{--  <ul class="pagination pagination-sm no-margin text-center"> --}}
                 
             {{--  </ul> --}} 
             
            </div>
          </div>
          <!-- /.box -->
		</div>{{-- .col-md-6 --}}

    </form>
	</div>{{-- .row --}}
@stop
