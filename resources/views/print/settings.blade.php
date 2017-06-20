@extends('layouts.master')
@section('title')
| Print Settings
@stop
@section('pageheading')
Print Settings
@stop
@section('subpageheading')
Edit Print Settings
@stop
@section('content')
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border text-center">
				<h3 class="box-title">Print Settings</h3><br><small class="text-green">Edit Print Settings</small>
			</div>{{-- .box-header --}}
			<form action="{{route('print.store')}}" method="POST">
				{{csrf_field()}}
				<div class="box-body">
					<div class="row">
						<div class="col-md-4 col-xs-12 text-center">
							<div class="form-group {{ $errors->has('margin_top')?'has-error':''}}">
								<label for="margin_top">Margin Top(in centimeters)</label>
								<input type="text" id="margin_top" name="margin_top" class="form-control text-center" value="{{$clinic->margin_top}}">
								<span class="help-block">{{$errors->first('margin_top')}}</span>
							</div>
						</div>
						<div class="col-md-4 col-xs-12 text-center">
							<div class="form-group {{ $errors->has('margin_bottom')?'has-error':''}}">
								<label for="margin_bottom">Margin Bottom(in centimeters)</label>
								<input type="text" id="margin_bottom" name="margin_bottom" class="form-control text-center" value="{{$clinic->margin_bottom}}">
								<span class="help-block">{{$errors->first('margin_bottom')}}</span>
							</div>
						</div>
						<div class="col-md-4 col-xs-12 text-center">
							<div class="form-group {{ $errors->has('pageformat')?'has-error':''}}">
								<label for="pageformat">Page Format</label>
								<select name="pageformat" id="pageformat" class="form-control" required="">
									@foreach ($pageformats as $pageformat)
										<option value="{{$pageformat->pageformat}}" {{$pageformat->pageformat == $clinic->pageformat ? 'selected="selected"':''}}>{{$pageformat->pageformat}}</option>
									@endforeach
								</select>
								<span class="help-block">{{$errors->first('pageformat')}}</span>
							</div>
						</div>
						{{-- <div class="col-md-3 col-xs-12 text-center">
							<div class="form-group {{ $errors->has('margin_right')?'has-error':''}}">
								<label for="margin_right">Margin Right(in mm)</label>
								<input type="text" id="margin_right" name="margin_right" class="form-control text-center" value="{{$clinic->margin_right}}">
								<span class="help-block">{{$errors->first('margin_right')}}</span>
							</div>
						</div>
						<div class="col-md-3 col-xs-12 text-center">
							<div class="form-group {{ $errors->has('margin_left')?'has-error':''}}">
								<label for="margin_left">Margin Left(in mm)</label>
								<input type="text" id="margin_left" name="margin_left" class="form-control text-center" value="{{$clinic->margin_left}}">
								<span class="help-block">{{$errors->first('margin_left')}}</span>
							</div>
						</div> --}}
					</div>{{-- .row --}}

					<div class="row">
						
					</div>{{-- .row --}}
				</div>{{-- .box-body --}}
				<div class="box-footer">
					<div class="row">
						<div class="col-md-6">
							<button type="submit" class="btn btn-success btn-block">Save Settings</button>
						</div>
						<div class="col-md-6">
							<a href="{{route('patients.index')}}" class="btn btn-danger btn-block">Cancel</a>
						</div>
					</div>
				</div>{{-- .box-footer --}}
			</form>
		</div>{{-- .box --}}
	</div>
</div>{{-- .row --}}
@stop