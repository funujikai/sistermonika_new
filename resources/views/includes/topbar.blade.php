<div class="top_nav">
  <div class="nav_menu bluesky">
    <nav class="" role="navigation">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="{{ url ('/logout') }}" class="user-profile"><i class="fa fa-power-off"></i> Log Out</a>
        </li>
        <li class="">
          <a href="http://192.168.10.188/SSO_WebService/profile.php?source=http://{{$_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']).((strpos(dirname($_SERVER['REQUEST_URI']),'/public')!==FALSE)?'':'/public')}}&app_code=SIPP&username={{ Session::get('SIPP_Username') }}" class="user-profile">
            @if(Session::get('SIPP_Foto') != '')
			        <img src='{{ Session::get('SIPP_Foto') }}' alt="">{{ Session::get('SIPP_Name') }}
            @else
              <img src="images/img.jpg" alt="">{{ Session::get('SIPP_Name') }}
            @endif
          </a>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" onclick='list_notif()'>
            <i class="fa fa-gavel" aria-hidden="true"></i> <span id='number_list' class="label label-danger"></span> <i class="fa fa-caret-down"></i>
          </a>
          <ul class="dropdown-menu dropdown-messages" id='notif_log' style='width:500px !important;overflow-y: scroll;height:200px;'>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" data-toggle="modal" data-target="#modal_notifnotaris" onclick="list_notif_notaris()">
            <i class="fa fa-balance-scale" aria-hidden="true"></i>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>