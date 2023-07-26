<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{url('console')}}" target="_blank">
        <img src="{{url('/argon/img')}}/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Hệ thống tính thưởng</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        @if(auth()->user()->can('view_users'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->routeIs('vi-tri.*')) ? 'active' : '' }}" href="{{route('vi-tri.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-circle-08 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Vị trí</span>
          </a>
        </li>
        @endif
        @if(auth()->user()->can('view_users'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->routeIs('tham-quyen.*')) ? 'active' : '' }}" href="{{route('tham-quyen.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-circle-08 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Thẩm quyền</span>
          </a>
        </li>
        @endif
        @if(auth()->user()->can('view_users'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->routeIs('nhiem-vu.*')) ? 'active' : '' }}" href="{{route('nhiem-vu.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-circle-08 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Nhiệm vụ</span>
          </a>
        </li>
        @endif
        @if(auth()->user()->can('view_users'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->routeIs('mo-ta-nhiem-vu.*')) ? 'active' : '' }}" href="{{route('mo-ta-nhiem-vu.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-circle-08 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Mô tả nhiệm vụ</span>
          </a>
        </li>
        @endif
        @if(auth()->user()->can('view_users'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->routeIs('quan-he.*')) ? 'active' : '' }}" href="{{route('quan-he.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-circle-08 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Quan hệ trong công việc</span>
          </a>
        </li>
        @endif
        @if(auth()->user()->can('view_users'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->routeIs('tieu-chuan.*')) ? 'active' : '' }}" href="{{route('tieu-chuan.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-circle-08 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Tiêu chuẩn tuyển chọn</span>
          </a>
        </li>
        @endif
        @if(auth()->user()->can('view_users'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->routeIs('users.*')) ? 'active' : '' }}" href="{{route('users.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-circle-08 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Người dùng</span>
          </a>
        </li>
        @endif
        
        @if(auth()->user()->can('view_roles'))
        <li class="nav-item">
          <a class="nav-link {{ (request()->routeIs('roles.*')) ? 'active' : '' }}" href="{{route('roles.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-settings text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Phân quyền</span>
          </a>
        </li>
        @endif
      </ul>
    </div>
    
    
  </aside>