<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
     
    
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
         
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <form action="{{url('logout')}}" method="POST">
              @csrf
            <a href="javascript:;" onclick="document.getElementById('logout_button').click()" class="nav-link text-white font-weight-bold px-0">
              <i class="fa fa-user me-sm-1"></i>
              <span class="d-sm-inline d-none">Đăng xuất</span>
            </a>
            <button type="submit" id="logout_button" style="display:none;height:0;visible:0">Logout</button>
          </form>
          </li>
          

        </ul>
      </div>
    </div>
  </nav>