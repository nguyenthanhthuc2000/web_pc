
<div class="header">
    <div class="header-left">
        <a href="{{ route('admin.dashboard') }}" class="logo"> <img src="{{asset('/_admin/img/hotel_logo.png')}}" width="50" height="70" alt="logo"> <span class="logoclass">HOTEL</span> </a>
    </div>
    <a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
    <a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span class="user-img"><img class="rounded-circle" src="{{asset('/_admin/img/profiles/avatar-01.jpg')}}" width="31" alt="Soeng Souy"></span> </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm"> <img src="{{asset('/_admin/img/profiles/avatar-01.jpg')}}" alt="User Image" class="avatar-img rounded-circle"> </div>
                    <div class="user-text">
                        <h6>{{ Auth::user()->name }}</h6>
                        <p class="text-muted mb-0">
                            @if(Auth::user()->level == 1)
                                Administrator
                            @else
                                Nhân viên
                            @endif

                        </p>
                    </div>
                </div> <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a> </div>
        </li>
    </ul>
    <div class="top-nav-search">
        <form>
            <input type="text" class="form-control" placeholder="Search here">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active"> <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
                <li class="list-divider"></li>
                <li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span> Danh mục</span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="{{ route('category.index') }}"> Danh sách </a></li>
                        <li><a href="{{ route('category.add') }}"> Thêm mới </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span>  Sản phẩm  </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="all-booking.html"> Danh sách </a></li>
                        <li><a href="edit-booking.html"> Thêm mới </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-key"></i> <span> Đơn hàng </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="all-rooms.html"> Danh sách </a></li>
                    </ul>
                </li>
                <li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Nhân viên </span> <span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a href="all-staff.html">Danh sách </a></li>
                        <li><a href="edit-staff.html">Thêm mới </a></li>
                    </ul>
                </li>
                <li> <a href="pricing.html"><i class="far fa-money-bill-alt"></i> <span>Đổi mật khẩu</span></a> </li>

            </ul>
        </div>
    </div>
</div>
