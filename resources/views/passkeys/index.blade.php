@extends('layouts.master')
@section('title')
| Passkey Management
@stop
@section('pageheading')
Passkey Management
@stop
@section('subpageheading')
Manage Passkeys to register new Doctors
@stop
@section('content')
<div class="row">
  <div class="col-md-4 col-xs-12 col-md-offset-4">
   <div class="box box-primary">
    <div class="box-header with-border text-center">
      <h3 class="box-title">Generate Passkeys</h3><br><small class="text-green">(New Doctor Registration)</small>
    </div>
    <!-- /.box-header -->
    
    <div class="box-body">
      <div class="row">
        <div class="col-xs-12">
          <form data-parsley-validate action="{{route('passkeys.store')}}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group {{ $errors->has('passkey')?'has-error':''}}">
              <label class="control-label" for="passkey">Custom Passkey</label>
              <input minlength="6" maxlength="6" autofocus="" type="text" class="form-control" id="passkey" name="passkey" placeholder="Create your own passkey">
              <span class="help-block">{{$errors->first('passkey')}}</span>
            </div>
            <button type="submit" class="btn btn-default btn-block btn-sm">Generate Passkey</button>
            <br>
          </form>
        </div>
                {{-- <div class="col-xs-2 col-xs-offset-5">
                  <a href="{{route('passkeys.index')}}"  class="btn btn-default btn-block btn-sm"><i class="fa fa-refresh"></i></a>
                  <br>
                </div> --}}
                
              </div>
              <table class="table table-bordered">
                <thead style="background-color: #C0C0C0;">
                	<th class="text-center">Passkey</th>
                	<th class="text-center">Delete</th>
                </thead>
                <tbody>
                  @foreach ($passkeys as $passkey)
                  <tr>
                    <form id="del-passkey" action="{{route('passkeys.destroy',$passkey->id)}}" method="POST">
                      {{csrf_field()}}
                      {{method_field('delete')}}
                      <input type="hidden" name="_method" value="DELETE">
                      <td class="text-center" id="{{$passkey->id}}">{{$passkey->passkey}}</td>
                      {{-- <td class="text-center"><a onclick="event.preventDefault(); document.getElementById('del-passkey').submit();" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a></td> --}}
                      <td class="text-center"><button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button></td>
                    </form>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix text-center">
              {{--  <ul class="pagination pagination-sm no-margin text-center"> --}}
              {{$passkeys->links()}}
              {{--  </ul> --}} 
              
            </div>
          </div>
          <!-- /.box -->
        </div>{{-- .col-md-6 --}}

        
      </div>{{-- .row --}}
      @stop