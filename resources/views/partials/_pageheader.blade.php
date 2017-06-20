<!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          @yield('pageheading')
          <small>@yield('subpageheading')</small>
        </h1>
        <ol class="breadcrumb">
          <li class="active"><i class="fa fa-id-card-o"></i> Clinic Name: </li>
          <li class="active">{{Session::get('clinicname')}} (Id: {{Session::get('cliniccode')}} )</li> | 
          <a href="{{route('clinics.index')}}">Change Clinic</a>
        </ol>
      </section>