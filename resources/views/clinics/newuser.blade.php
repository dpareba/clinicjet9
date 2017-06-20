@extends('layouts.app')
@section('title')
| First Time User
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">First Time User ?</div>
                <div class="panel-body">
                   <div class="row">
                      @if (Auth::user()->doctype == "DOCTOR" || Auth::user()->doctype == "GP")
                      <div class="col-md-6">
                        <a href="{{route('clinics.create')}}" class="btn btn-success btn-block">Create a New Clinic</a>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-warning btn-block" href="{{route('clinicinput')}}">Register with Existing Clinic</a>
                    </div>
                    @else
                    <div class="col-md-8 col-md-offset-2">
                        <a class="btn btn-warning btn-block" href="{{route('clinicinput')}}">Register with Existing Clinic</a>
                    </div>
                    @endif
                </div>                  
            </div>
        </div>
    </div>
</div>
</div>
@endsection
