<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="/avatar/docs/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{Auth::user()->doctype!="RECEPTIONIST"?"DR.":''}} {{ Auth::user()->name }} </p>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      @if ((!Auth::user()->isRemoteDoc))
      <li class="treeview {{(Request::is('patients/create')||Request::is('patients'))?'active':''}}">
        <a href="#">
          <i class="fa fa-stethoscope"></i> <span>My Clinic Patients</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{Request::is('patients')?'active':''}}"><a href="{{ route('patients.index') }}"><i class="fa fa-circle-o text-yellow"></i> View All Patients</a></li>
          <li class="{{Request::is('patients/create')?'active':''}}"><a href="{{route('patients.create')}}"><i class="fa fa-circle-o text-green"></i> Add New Patient</a></li>
        </ul>
      </li>
      @endif

      {{-- @if ((!Auth::user()->isRemoteDoc))
      <li class="treeview {{(Request::is('patients/create')||Request::is('patients'))?'active':''}}">
        <a href="#">
          <i class="fa fa-hospital-o"></i> <span>My Clinic Patients</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{Request::is('patients')?'active':''}}"><a href="{{ route('patients.index') }}"><i class="fa fa-circle-o text-yellow"></i> View All Patients</a></li>
          
        </ul>
      </li>
      @endif --}}


        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li> --}}
        <li class="{{Request::is('profile')?'active':''}}">
          <a href="{{route('profile')}}">
            <i class="fa fa-user-circle"></i> <span>Profile</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-blue">Pro</small>
            </span>
          </a>
        </li>
       
        <li class="{{Request::is('videocall/initiate')?'active':''}}">
          <a href="{{route('videocall.initiate')}}" target="_blank">
            <i class="fa fa-video-camera"></i> <span>Video Call</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-maroon">Video</small>
            </span>
          </a>
        </li>
        



       {{--  @foreach ($roles as $role)
          @if ($role->role =='superadmin')
            <li class="{{Request::is('passkeys')?'active':''}}">
            <a href="{{route('passkeys.index')}}">
            <i class="fa fa-user-secret"></i> <span>Passkey</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">PK</small>
            </span>
            </a>
            </li>

            <li class="{{Request::is('clinictokens')?'active':''}}">
            <a href="{{route('clinictokens.index')}}">
            <i class="fa fa-user-secret"></i> <span>Clinic Token</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">CT</small>
            </span>
            </a>
            </li>
          @endif
          @endforeach --}}
       {{--  @if (Auth::user()->roles()->name == "superadmin")
          <li class="{{Request::is('passkeys')?'active':''}}">
          <a href="{{route('passkeys.index')}}">
            <i class="fa fa-user-secret"></i> <span>Passkey</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">PK</small>
            </span>
          </a>
          </li>
          @endif --}}
          {{-- @if (Auth::user()->isSuperAdmin || Session::has('isclinicadmin'))
          <li class="{{Request::is('passkeys')?'active':''}}">
            <a href="{{route('passkeys.index')}}">
              <i class="fa fa-user-secret"></i> <span>Passkey</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-yellow">PK</small>
              </span>
            </a>
          </li>
          @endif --}}

          {{-- @if (Auth::user()->isSuperAdmin || Session::has('isclinicadmin'))
          <li class="{{Request::is('clinictokens')?'active':''}}">
            <a href="{{route('clinictokens.index')}}">
              <i class="fa fa-user-secret"></i> <span>Clinic Token</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green">CT</small>
              </span>
            </a>
          </li>
          @endif --}}

          @if (Auth::user()->isSuperAdmin || Session::has('isclinicadmin'))
          <li class="{{Request::is('print')?'active':''}}">
            <a href="{{route('print.index')}}">
              <i class="fa fa-wrench"></i> <span>Print Settings</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-navy">Settings</small>
              </span>
            </a>
          </li>
          @endif


        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li> --}}
        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="../UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li> --}}
        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="../forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li> --}}
        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="../tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        <li>
          <a href="../calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="../mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li class="active"><a href="blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="../../documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> --}}

          <li class="{{Request::is('test')?'active':''}}">
          <a href="{{route('tests.index')}}">
            <i class="fa fa-user-circle"></i> <span>Test</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-blue">Pro</small>
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>