<div class="col-md-3 left_col left_navigasi">
  <div class="left_col scroll-view">
    <div class="navbar nav_title white" style="border: 0;">
      <a href="{{ url ('/') }}" class="site_title"><img src="{{ asset('images/logopnm.png') }}" width="60%" class="fixed_width center-block"></i></a>
    </div>

    <div class="clearfix"></div>

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
          @foreach(Session::get('menus') as $key=>$value)
            @if(isset($value['child']))
              <li><a><i class="{{$value['icon']}}"></i> {{$value['menu']}}<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                  @foreach($value['child'] as $keys=>$values)
                    <li><a href="{{ url ($values['link']) }}"><i class="{{$values['icon']}}"></i> {{$values['menu']}}</a></li>
                  @endforeach
                </ul>
              </li>
            @else
              <li><a href="{{ url ($value['link']) }}"><i class="{{$value['icon']}}"></i> {{$value['menu']}}</a></li>
            @endif
          @endforeach
        </ul> <!-- Edited at January 01 2017-->
      </div>
    </div> <!-- /sidebar menu -->
  </div>
</div> <!-- Edited at January 01 2017-->