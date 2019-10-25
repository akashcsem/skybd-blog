<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('assets/backend') }}/images/user.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                          <i class="material-icons">input</i>Sign Out
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->

    {{-- menus for admin --}}
    @if (Request::is('admin*'))
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tag.index') }}">
                        <i class="material-icons">label</i>
                        <span>Tag</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}">
                        <i class="material-icons">label</i>
                        <span>Category</span>
                    </a>
                </li>
                <li class="header">System</li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                      <i class="material-icons">input</i>
                                      <span>Logout Out</span>
                     </a>

                     <form id="logout-form" style="display: none" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
                </li>
            </ul>
        </div>
    @endif


    {{-- menus for author --}}
    @if (Request::is('author*'))
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('author.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="header">System</li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                      <i class="material-icons">input</i>
                                      <span>Logout Out</span>
                     </a>

                     <form id="logout-form" style="display: none" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
                </li>
            </ul>
        </div>
    @endif
    



    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2019 <a href="javascript:void(0);">Admin - SKYBD</a>.
        </div>
    </div>
    <!-- #Footer -->
</aside>