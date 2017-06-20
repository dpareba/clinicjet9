@extends('layouts.app')
@section('title')
| Register
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Doctor Registration</div>
                <div class="panel-body">
                   @include('partials.flash', ['some' => 'data'])
                   <form data-parsley-validate class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">

                         <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" event.preventDefault(); required="" autofocus style="text-transform: uppercase;" data-parsley-required-message="*Name is required" placeholder="Full Name (Do Not Suffix Dr.)"> 



                         @if ($errors->has('name'))
                         <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="row">
                    <div class="col-md-8 col-md-offset-4">
                            <label class="radio-inline"><input type="radio" name="doctype" value="GP" checked="" id="gp">GENERAL PRACTITIONER</label>
                        
                        <label class="radio-inline"><input type="radio" name="doctype" value="AYUSH"  id="ayush">AYUSH DOCTOR</label>
                        <label class="radio-inline"><input type="radio" name="doctype" value="DOCTOR"  id="doc">DOCTOR</label>

                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                     </div>   
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-4">
                           <label class="radio-inline"><input type="radio" name="doctype" value="JUNIOR DOCTOR" id="jrdoc">JUNIOR DOCTOR</label>
                           <label class="radio-inline"><input type="radio" name="doctype" value="RECEPTIONIST" id="rep">RECEPTIONIST</label>
                           <label class="radio-inline"><input type="radio" name="doctype" value="OTHERS" id="others">OTHERS</label>
                       </div>

                   </div>

               </div>

               <div class="form-group{{ $errors->has('speciality') ? ' has-error' : '' }}">
                <label for="speciality" class="col-md-4 control-label">Select Specialty</label>

                <div class="col-md-6">
                    <select required="" data-parsley-required-message="*Kindly Select a Specialty" name="speciality" id="speciality" class="js-example-basic-single form-control">
                        @foreach ($specialities as $speciality)
                        <option value="{{$speciality->id}}" {{$speciality->speciality == 'GENERAL MEDICINE' ? 'selected="selected"' : ''}}>{{$speciality->speciality}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('speciality'))
                    <span class="help-block">
                        <strong>{{ $errors->first('speciality') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required="" data-parsley-required-message="*A valid Email is required to register" placeholder="Email Address">

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-md-4 control-label">Contact Number</label>

                <div class="col-md-6">
                    <input id="phone" type="text" required=""  data-parsley-pattern="(7|8|9)\d{9}" class="form-control" name="phone" value="{{ old('phone') }}" data-parsley-required-message="*A valid phone is required to register" data-parsley-pattern-message="*Invalid Mobile Number" placeholder="Mobile Number">

                    @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

                         {{-- <div class="form-group{{ $errors->has('passkey') ? ' has-error' : '' }}">
                            <label for="passkey" class="col-md-4 control-label">Passkey</label>

                            <div class="col-md-6">
                                <input id="passkey" type="text" class="form-control" name="passkey" value="{{ old('passkey') }}" required data-parsley-required-message="*The Passkey value is required to be filled in!" placeholder="Passkey">

                                @if ($errors->has('passkey'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passkey') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required="" minlength="6" data-parsley-required-message="*Please set your password" placeholder="Password">

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="" data-parsley-equalto="#password" data-parsley-required-message="*Please confirm your password!" data-parsley-equalto-message="*This should match the password provided!" placeholder="Password Again">

                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>

                                Have an account? <a href="{{ url('/login') }}"><strong>LOGIN</strong></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $('#name').focus();
    });
  $("#gp").click(function(){
        $("#speciality").attr("disabled",false);
        $("#speciality").val("22");
    });
      $("#ayush").click(function(){
        $("#speciality").attr("disabled",false);
        $("#speciality").val("22");
    });
    $("#doc").click(function(){
        $("#speciality").attr("disabled",false);
        $("#speciality").val("22");
    });
    $("#jrdoc").click(function(){
        $("#speciality").attr("disabled",false);
        $("#speciality").val("22");
    });
      $("#others").click(function(){
        $("#speciality").attr("disabled",false);
        $("#speciality").val("22");
    });
    $("#rep").click(function(){
        $("#speciality").attr("disabled",true);
        $("#speciality").val("73");
    });
</script>
@endsection
