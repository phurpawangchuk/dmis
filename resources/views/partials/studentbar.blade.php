<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="/studentDashboard/instructions" class="nav-link {{ $elementActive == 'home' ? 'active' : '' }}">
            <i class="nav-icon fas fa-piggy-bank"> </i>
                 <p>
                    Donate
                 </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="/Accounts/myProfile" class="nav-link  {{ $elementActive == 'profile' ? 'active' : '' }}">
            <i class="nav-icon fas fa-id-card-alt"></i>
              <p>
               My Profile
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="/Applications/startApplication" class="nav-link  {{ $elementActive == 'startapplication' ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
              <p>
               Donation Details
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/Applications/myApplication" class="nav-link  {{ $elementActive == 'myapplication' ? 'active' : '' }}">
            <i class="nav-icon fas fa-file"></i>
              <p>
              Donation Usage Report
              </p>
            </a>
          </li>



        </ul>
</nav>
