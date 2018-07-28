<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <li class="nav-header">
        <div class="dropdown profile-element"> 
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="clear"> 
              <span class="block m-t-xs"> <strong class="font-bold">{{ \Session::get('name') }}</strong></span>
            </span>
          </a>
        </div>
        <div class="logo-element">
          Hakiki
        </div>
      </li>
      @foreach(MenuHelper::getArrOfMenu() as $menu)
        @if($menu['visible'])
          <li class="{{ isset($menu['active']) && $menu['active'] ? 'active' : '' }}">
            <a href="{{ $menu['url'] != '#' ? route($menu['url']) : '#'  }}">
              <i class="fa fa-{{ $menu['icon'] }}"></i> <span class="nav-label">{{ $menu['label'] }}</span>
              @if (isset($menu['items']) && !empty($menu['items']))
                <span class="fa arrow"></span>
              @endif
            </a>
            @if(isset($menu['items']) && !empty($menu['items']))
              <ul class="nav nav-second-level collapse">
                @foreach($menu['items'] as $secondMenu)
                  @if($secondMenu['visible'])
                    <li class="{{ isset($secondMenu['active']) && $secondMenu['active'] ? "active" : "" }}">
                      <a href="{{ $secondMenu['url'] != '#' ? route($secondMenu['url']) : '#' }}">
                        {{ $secondMenu['label'] }}
                        @if (isset($secondMenu['items']) && !empty($secondMenu['items'])):?>
                          <span class="fa arrow"></span>
                        @endif
                      </a>
                      @if(isset($secondMenu['items']) && !empty($secondMenu['items']))
                        <ul class="nav nav-third-level">
                          @foreach($secondMenu['items'] as $thirdMenu)
                            @if($thirdMenu['visible'])
                              <li class="{{ Request::is($thirdMenu['url']) ? 'active' : '' }}">
                                <a href="{{ route($thirdMenu['url']) }}">
                                  {{ $thirdMenu['label'] }}
                                </a>
                              </li>
                            @endif
                          @endforeach
                        </ul>
                      @endif
                    </li>
                  @endif
                @endforeach
              </ul>
            @endif
          </li>
        @endif
      @endforeach
    </ul>
  </div>
</nav>