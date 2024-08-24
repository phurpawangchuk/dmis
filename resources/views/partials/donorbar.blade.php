<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    @php
        $elementActive = '';
    @endphp
     <!-- <li class="nav-item">
        <a href="{{ route('dashboard.users.index') }}" class="nav-link {{ $elementActive == 'home' ? 'active' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>-->
      <li class="nav-item">
        <a href="/admin" class="nav-link {{ $elementActive == 'home' ? 'active' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
    <li class="nav-item">
        <a href="{{ route('dashboard.donors.donationhistory') }}" class="nav-link {{ $elementActive == 'home' ? 'active' : '' }}">
          <i class="nav-icon fas fa-bars"></i>
          <p>
           My Donation History
          </p>
        </a>
    </li>

    <li class="nav-item">
        <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.fundutils.index') }}">
        <i class="nav-icon fas fa-book"></i>
            <p>Fund Utilization Report</p>
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


   <!-- <li class="nav-item">
        <a href="{{ route('dashboard.users.index') }}" class="nav-link {{ $elementActive == 'home' ? 'active' : '' }}">
          <i class="nav-icon fas fa-bars"></i>
          <p>
          Donation Receipt
          </p>
        </a>
    </li>-->

    <li class="nav-item">
        <a  class="nav-link  @if(request()->is('dashboard/donors') || request()->is('dashboard/donors/*')) is_active @endif" href="{{ route('dashboard.projects.index') }}">
        <i class="nav-icon fas fa-folder"></i>
            <p>YDF Project</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('dashboard.events.index') }}" class="nav-link  {{ $elementActive == 'addschoolar' ? 'active' : '' }}">
        <i class="nav-icon fa fa-calendar"></i>
            <p>
            YDF Events
            </p>
        </a>
    </li>

    </ul>
</nav>
