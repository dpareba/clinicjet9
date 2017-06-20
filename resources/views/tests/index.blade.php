@extends('layouts.master')
@section('title')
| Test
@stop
@section('pageheading')
Testing
@stop
@section('subpageheading')
Testing Material Design
@stop
@section('css')

<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.light_blue-red.min.css" />
<script src="https://storage.googleapis.com/code.getmdl.io/1.0.1/material.min.js"></script>
@endsection
@section('content')
<div class="row" >
	<div class="col-md-12 col-xs-12">
		<div class="box box-primary">
			<div class="box-header with-border text-center">
				<h3 class="box-title">Testing</h3><br><small class="text-green">(Testing new page)</small>
			</div>

			<div class="box-body">
				<form action="{{route('tests.store')}}" method="POST">
					{{csrf_field()}}

					{{-- <div class="row">
						<div class="col-md-4">
							<div class="group">      
								<input type="text" autofocus="" required>
								<span class="highlight"></span>
								<span class="bar"></span>
								<label>First Name</label>
							</div>
						</div>

						<div class="col-md-4">
							<div class="group">      
								<input type="text" required>
								<span class="highlight"></span>
								<span class="bar"></span>
								<label>Middle Name</label>
							</div>
						</div>

						<div class="col-md-4">
							<div class="group">      
								<input type="email" required>
								<span class="highlight"></span>
								<span class="bar"></span>
								<label>email</label>
							</div>
						</div>
					</div>
 --}}
					{{-- MDL --}}
					<br>
					<div class="row">
						<div class="col-md-4">
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" >
								<input class="mdl-textfield__input" type="text"  id="username"  />
								<label class="mdl-textfield__label" for="username">Username</label>
								{{-- <span class="mdl-textfield__error">Only alphabet and no spaces, please!</span> --}}
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4">
							<button type="submit" class="btn btn-success">YUP</button>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection