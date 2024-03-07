<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link bg-warning">
      <img src="{{asset('/images/fav.jpeg')}}" alt="ydf Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-heavy text-bold">DMiS V</span><i style="font-size:15px;">1.0</i>
    </a>

    <!-- Sidebar -->
    <div class="sidebar  ">
      <!-- Sidebar user panel (optional) -->
      <div >

      </div>

    
      <!-- Sidebar Menu -->
      @if(Auth()->user()->role_id == 1)
        @include('partials.adminbar')
      @elseif(Auth()->user()->role_id ==2)
        @include('partials.ydfbar')
      @else
        @include('partials.donorbar')
      @endif
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
