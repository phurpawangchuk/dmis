<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            @php
            $elementActive = '';
            @endphp
            <li class="nav-item">
        <a href="/admin" class="nav-link {{ $elementActive == 'home' ? 'active' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>

    <li class="nav-item">
        <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.projects.index') }}">
        <i class="nav-icon fas fa-folder"></i>
            <p>Project Master</p>
        </a>
    </li>
    <li class="nav-item">
        <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.sliders.index') }}">
        <i class="nav-icon fas fa-folder"></i>
            <p>Slider Photo Mgt</p>
        </a>
    </li>
    <li class="nav-item">
        <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.donors.index') }}">
        <i class="nav-icon fas fa-book"></i>
            <p>Payment Report</p>
        </a>
    </li>

    <li class="nav-item">
        <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.fundutils.index') }}">
        <i class="nav-icon fas fa-book"></i>
            <p>Fund Utilization Report</p>
        </a>
    </li>


    <li class="nav-item">
        <a href="{{ route('dashboard.donors.donorlist') }}" class="nav-link  {{ $elementActive == 'addschoolar' ? 'active' : '' }}">
        <i class="nav-icon fa fa-users"></i>
            <p>
             Active Donor Lists
            </p>
        </a>
    </li>

    <li class="nav-item">
            <a href="{{ route('dashboard.donors.inactivedonorlist') }}" class="nav-link  {{ $elementActive == 'addschoolar' ? 'active' : '' }}">
            <i class="nav-icon fa fa-users"></i>
                <p>
                Inactive Donor Lists
                </p>
            </a>
    </li>
    
    <li class="nav-item">
    <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.events.index') }}">
        <i class="nav-icon fa fa-calendar"></i>
            <p>
             Manage YDF Events
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.donors.send-greeting') }}">
        <i class="nav-icon fas fa-envelope"></i>
        <p> Send Greeting</p>
        </a>
    </li>
    </ul>
</nav>
