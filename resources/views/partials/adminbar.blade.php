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
            <p>Donation Report</p>
        </a>
    </li>
    <li class="nav-item">
        <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.donors.index1') }}">
        <i class="nav-icon fas fa-book"></i>
            <p>Download Receipt</p>
        </a>
    </li>


    <li class="nav-item">
        <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.fundutils.index') }}">
        <i class="nav-icon fas fa-book"></i>
            <p>Fund Utilization Report</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('dashboard.events.index') }}" class="nav-link  {{ $elementActive == 'addschoolar' ? 'active' : '' }}">
        <i class="nav-icon fa fa-calendar"></i>
            <p>
             Manage YDF Events
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('dashboard.calendars.index') }}" class="nav-link  {{ $elementActive == 'addschoolar' ? 'active' : '' }}">
        <i class="nav-icon fa fa-calendar"></i>
            <p>
             Manage Calendars
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('dashboard.users.index') }}" class="nav-link  {{ $elementActive == 'addschoolar' ? 'active' : '' }}">
        <i class="nav-icon fa fa-users"></i>
            <p>
             Manage Users
            </p>
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
        <a href="{{ route('dashboard.donors.donateform') }}" class="nav-link {{ $elementActive == 'home' ? 'active' : '' }}">
          <i class="nav-icon fas fa-bars"></i>
          <p>
          Donate Now
          </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('dashboard.countries.index') }}" class="nav-link  {{ $elementActive == 'addschoolar' ? 'active' : '' }}">
        <i class="nav-icon fa fa-globe"></i>
            <p>
             Manage Country List
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.donors.send-greeting') }}">
        <i class="nav-icon fas fa-envelope"></i>
        <p> Send Birthday Greeting</p>
        </a>
    </li>
    <li class="nav-item">
        <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.donors.festgreeting') }}">
        <i class="nav-icon fas fa-envelope"></i>
        <p> Send Festival Greeting</p>
        </a>
    </li>
    </ul>
</nav>
