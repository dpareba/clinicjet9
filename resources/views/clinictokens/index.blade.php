@extends('layouts.master')
@section('title')
  | Clinic Token Management
@stop
@section('pageheading')
  Clinic Token Management
@stop
@section('subpageheading')
  Manage Clinic Tokens to register new Clinics
@stop
@section('content')
  <div class="row">
    <div class="col-md-4 col-xs-12 col-md-offset-4">
      <div class="box box-primary">
            <div class="box-header with-border text-center">
              <h3 class="box-title">Generate Clinictokens</h3><br><small class="text-green">(New Clinic Registration)</small>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <div class="row">
                <div class="col-xs-12">
                  <form data-parsley-validate action="{{route('clinictokens.store')}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group {{ $errors->has('clinictoken')?'has-error':''}}">
                      <label class="control-label" for="clinictoken">Custom Clinic Token</label>
                      <input minlength="6" maxlength="6" autofocus="" type="text" class="form-control" id="clinictoken" name="clinictoken" placeholder="Create your own clinictoken">
                      <span class="help-block">{{$errors->first('clinictoken')}}</span>
                    </div>
                      <button type="submit" class="btn btn-default btn-block btn-sm">Generate Clinic Token</button>
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
                  <th class="text-center">Clinic Token</th>
                  <th class="text-center">Delete</th>
                </thead>
                <tbody>
                  @foreach ($clinictokens as $clinictoken)
                    <tr>
                      <form id="del-clinictoken" action="{{route('clinictokens.destroy',$clinictoken->id)}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        <input type="hidden" name="_method" value="DELETE">
                        <td class="text-center" id="{{$clinictoken->id}}">{{$clinictoken->clinictoken}}</td>
                        {{-- <td class="text-center"><a onclick="event.preventDefault(); document.getElementById('del-clinictoken').submit();" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a></td> --}}
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
                   {{$clinictokens->links()}}
             {{--  </ul> --}} 
             
            </div>
          </div>
          <!-- /.box -->
    </div>{{-- .col-md-6 --}}

    
  </div>{{-- .row --}}
@stop