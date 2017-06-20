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
				<h3 class="box-title">Register New Patient</h3><br><small class="text-green">(New Patient Registration Information)</small>
			</div>{{-- .box-header --}}

			<div class="box-body">
				<form data-parsley-validate action="{{route('patients.store')}}" method="POST">
					<input type="hidden" name="_token" value="{{csrf_token()}}">

					<div class="row">
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('name')?'has-error':''}}">
								<label class="control-label" for="name" >First Name</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-id-badge"></i></span>
									<input event.preventDefault(); style="text-transform: uppercase;text-align: center;" required="" value="{{old('name')}}" autofocus="" type="text" class="form-control" maxlength="255" id="name" name="name" placeholder="First Name"  data-parsley-required-message="Patient Name cannot be left blank">
								</div>

								<span class="help-block">{{$errors->first('name')}}</span>
							</div>{{-- .full name div --}}

						</div>
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('midname')?'has-error':''}}">
								<label class="control-label" for="midname" style="text-align: center;">Middle Name/Husband's Name/Fathers Name</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-id-badge"></i></span>
									<input event.preventDefault(); style="text-transform: uppercase;text-align: center;"  value="{{old('midname')}}"  type="text" class="form-control" maxlength="255" id="midname" name="midname" placeholder="Middle Name"  >
								</div>

								<span class="help-block">{{$errors->first('midname')}}</span>
							</div>{{-- .middle name div --}}
						</div>
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('surname')?'has-error':''}}">
								<label class="control-label" for="surname">Last Name/Family Name/Surname</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-id-badge"></i></span>
									<input event.preventDefault(); style="text-transform: uppercase;text-align: center;" required="" value="{{old('surname')}}"  type="text" class="form-control" maxlength="255" id="surname" name="surname" placeholder="Surname"  data-parsley-required-message="Patient Surname cannot be left blank">
								</div>

								<span class="help-block">{{$errors->first('surname')}}</span>
							</div>{{-- .last name div --}}
						</div>
						
					</div>{{-- .row --}}

					<div class="row">
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('dob')?'has-error':''}}">
								<label class="control-label" for="dob">Date of Birth (dd/mm/yyyy)</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-calendar"></i></span>
									{{-- <input required="" value="{{old('dob')}}" autofocus="" type="text" class="form-control" maxlength="255" id="dob" dob="dob" placeholder="Enter Patient's Full dob"  data-parsley-required-message="Patient dob cannot be left blank"> --}}
									<input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="dob" id="dob" value="{{old('dob')}}" style="text-align: center;">
								</div>

								<span class="help-block">{{$errors->first('dob')}}</span>
							</div>{{-- .full name div --}}
						</div>

						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('approxage')?'has-error':''}}">
								<label class="control-label" for="approxage">Approximate Age</label> <div class="pull-right  box-tools"><input event.preventDefault(); name="cbage" id="cbage" type="checkbox"  ></div>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-calendar"></i></span>
									<input event.preventDefault(); data-parsley-type="digits" minlength="1" maxlength="3" style="text-transform: uppercase;text-align: center;"   class="form-control"  id="approxage" name="approxage" placeholder="Approximate Age" >
								</div>

								<span class="help-block">{{$errors->first('approxage')}}</span>
							</div>{{-- .last name div --}}
						</div>

						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('approxdob')?'has-error':''}}">
								<label class="control-label" for="approxdob">Approximate Year of Birth</label> 
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-calendar"></i></span>
									<input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask name="approxdob" id="approxdob"  style="text-align: center;" readonly="">
								</div>

								<span class="help-block">{{$errors->first('approxdob')}}</span>
							</div>{{-- .last name div --}}
						</div>
					</div>{{-- .row --}}

					

					<div class="row">
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('gender')?'has-error':''}}">
								<label class="control-label" for="gender">Gender</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-transgender-alt"></i></span>
									<select style="text-align: center;" required="" name="gender" id="gender" class="form-control">
										<option style="text-align: center;" value="Male" selected="selected">MALE</option>
										<option style="text-align: center;" value="Female" >FEMALE</option>
										<option style="text-align: center;" value="Other" >OTHER</option>
									</select>
								</div>
								<span class="help-block">{{$errors->first('gender')}}</span>
							</div>{{-- .Gender div --}}
						</div>
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('bloodgroup')?'has-error':''}}">
								<label class="control-label" for="bloodgroup">Blood Group</label>
								<div class="input-group">
									<span  class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-tint"></i></span>
									<select required="" name="bloodgroup" id="bloodgroup" class="form-control">
										<option value="Not Known" selected="selected">NOT KNOWN</option>
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
							</div>{{-- .BloodGroup div --}}
						</div>
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('idproof')?'has-error':''}}">
								<label class="control-label" for="idproof">Enter Id Proof</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-credit-card"></i></span>
									<input value="{{old('idproof')}}" type="text" class="form-control" id="idproof" name="idproof" placeholder="Please Enter AAdhar Number" style="text-align: center;">
								</div>
								<span class="help-block">{{$errors->first('idproof')}}</span>
							</div>
						</div>
					</div>{{-- .row --}}
					<hr>
					<div class="row">
						<div class="col-md-12 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('address')?'has-error':''}}">
								<label class="control-label" for="address">Postal Address</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-map-marker"></i></span>
									<textarea required="" placeholder="Postal Address"  name="address" id="address" class="form-control" cols="30" rows="2" style="resize: none;text-transform: uppercase;text-align: center;" data-parsley-required-message="Postal Address of Patient required">{{old('address')}}</textarea>
								</div>
								<span class="help-block">{{$errors->first('address')}}</span>
							</div>
						</div>
					</div>{{-- .row --}}
					<div class="row">
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('patientstate')?'has-error':''}}">
								<label class="control-label" for="patientstate">State</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-map-marker"></i></span>
									<select style="text-align: center;" required="" name="patientstate" id="patientstate" class="form-control">
										@foreach ($states as $state)
										<option value="{{$state->state}}" {{$state->state == 'MAHARASHTRA' ? 'selected="selected"' : ''}}>{{$state->state}}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">{{$errors->first('patientstate')}}</span>
							</div>{{-- .Gender div --}}
						</div>
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('patientcity')?'has-error':''}}">
								<label class="control-label" for="patientcity">City</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-map-marker"></i></span>
									<input value="{{old('patientcity')}}" type="text" class="form-control" id="patientcity" name="patientcity" placeholder="Enter City Name" style="text-align: center;text-transform: uppercase;" required="" data-parsley-required-message="Please Enter City Name">
								</div>
								<span class="help-block">{{$errors->first('patientcity')}}</span>
							</div>
						</div>
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('patientpin')?'has-error':''}}">
								<label class="control-label" for="patientpin">Pin Code</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-map-marker"></i></span>
									<input value="{{old('patientpin')}}" required="" data-parsley-type="digits" minlength="6" maxlength="6" class="form-control" id="patientpin" name="patientpin" placeholder="ENTER PIN CODE" style="text-align: center;" data-parsley-required-message="Pin Code is required">
								</div>
								<span class="help-block">{{$errors->first('patientpin')}}</span>
							</div>
						</div>
					</div>{{-- .row --}}
					<div class="div" style="color: red;">
						<hr >
					</div>
					
					<div class="row">
						<div class="col-md-12 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('allergies')?'has-error':''}}">
								<label class="control-label" for="allergies">Known Allergies</label>
								<div class="input-group">
									<span class="input-group-addon "style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-bug"></i></span>
									<textarea event.preventDefault(); required="" name="allergies" id="allergies" class="form-control" cols="30" rows="2" style="resize: none;text-transform: uppercase;text-align: center;"  data-parsley-required-message="Enter Patient's Known Allergies. Enter Not Known Otherwise.">{{old('allergies')}}</textarea>

								</div>
								<span class="help-block">{{$errors->first('allergies')}}</span>
							</div>
						</div>
						
					</div>{{-- .row --}}
					<hr>
					<div class="row">
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('phoneprimary')?'has-error':''}}">
								<label class="control-label" for="phoneprimary">Primary Phone</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-volume-control-phone"></i></span>
									<input required="" data-parsley-type="number" value="{{old('phoneprimary')}}"  class="form-control" id="phoneprimary" name="phoneprimary" placeholder="ENTER PRIMARY PHONE NUMBER" minlength="10" maxlength="10" style="text-align: center;" data-parsley-required-message="Primary Phone Number is compulsory">
								</div>
								<span class="help-block">{{$errors->first('phoneprimary')}}</span>
							</div>
						</div>
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('phonealternate')?'has-error':''}}">
								<label class="control-label" for="phonealternate">Emergency Phone Number</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-volume-control-phone"></i></span>
									<input required="" data-parsley-type="digits" value="{{old('phonealternate')}}" type="text" class="form-control" id="phonealternate" name="phonealternate" placeholder="ENTER EMERGENCY PHONE NUMBER" minlength="10" maxlength="10" style="text-align: center;" data-parsley-required-message="Emergency Phone Number is compulsory">
								</div>
								<span class="help-block">{{$errors->first('phonealternate')}}</span>
							</div>
						</div>
						<div class="col-md-4 col-xs-12" style="text-align: center;">
							<div class="form-group {{ $errors->has('email')?'has-error':''}}">
								<label class="control-label" for="email">Email Address</label>
								<div class="input-group">
									<span class="input-group-addon" style="color: #3c8dbc;background-color:#FFFFFF;"><i class="fa fa-envelope-o"></i></span>
									<input value="{{old('email')}}" type="email" class="form-control" id="email" name="email" placeholder="ENTER EMAIL ADDRESS" style="text-align: center;">
								</div>
								<span class="help-block">{{$errors->first('email')}}</span>
							</div>
						</div>
					</div>{{-- .row --}}
					
				</div>{{-- .box-body --}}
				<div class="box-footer clearfix text-center">
					<div class="row">
						<div class="col-md-6">
							<button type="submit" class="btn btn-success btn-block">Register New Patient</button>  
						</div>
						<div class="col-md-6">
							<a href="{{route('patients.index')}}" class="btn btn-danger btn-block">Cancel</a>  
						</div>
					</div>
				</div>
			</div>{{-- .box-primary --}}
		</div>{{-- .col-md-12 col-xs-12--}}
	</div>{{-- .row --}}
	
</form>
@stop
@section('scripts')
<script>
	$(function () {

		$('#name').focus();
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    	checkboxClass: 'icheckbox_minimal-blue',
    	radioClass: 'iradio_minimal-blue'
    });


    $('#approxage').attr("disabled","disabled");
    $('#dob').removeAttr("disabled");
    
    $("#cbage").click(function(){

    	if($(this).prop('checked')==true){
    		$("#approxage").removeAttr("disabled");
    		$("#approxage").focus();
    		$("#dob").val("");
    		$("#dob").attr("disabled","disabled");
    		$("#approxage").change(function(){
    			$test =	$('#approxage').val();
    			$mom = moment().subtract($test,'years').format('01-01-YYYY');
    			$("#approxdob").val($mom);
    			console.log($mom);
    		});
    	}else{
    		$("#approxage").attr("disabled","disabled");
    		$("#dob").removeAttr("disabled");
    		$("#approxage").val("");
    		$("#dob").focus();
    	}

    });

});
</script>
@stop