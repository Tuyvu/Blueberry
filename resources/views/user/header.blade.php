<header class="bb-header">
    <div class="bottom-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="inner-bottom-header">
                        <div class="cols bb-logo-detail">
                            <!-- Header Logo Start -->
                            <div class="header-logo">
                                <a href="{{route('user.index')}}">
                                    <img src="{{asset('assets')}}/img/logo/logo.png" alt="logo" class="light">
                                    <img src="{{asset('assets')}}/img/logo/logo-dark.png" alt="logo" class="dark">
                                </a>
                            </div>
                            <!-- Header Logo End -->
    
                        </div>
                        <div class="cols">
                            <div class="header-search">
                                <form class="bb-btn-group-form" action="{{route('user.findProduct')}}" method="GET">
                                    @csrf
                                    <input class="form-control bb-search-bar" name="findproduct" placeholder="Tìm kiếm sản phẩm..."
                                        type="text">
                                    <button class="submit" type="submit"><i class="ri-search-line"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="cols bb-icons">
                            <div class="bb-flex-justify">
                                <div class="bb-header-buttons">
                                    <div class="bb-acc-drop">
                                        <a href="javascript:void(0)"
                                            class="bb-header-btn bb-header-user dropdown-toggle bb-user-toggle"
                                            title="Account">
                                            <div class="header-icon">
                                                <svg class="svg-icon" viewBox="0 0 1024 1024" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M512.476 648.247c-170.169 0-308.118-136.411-308.118-304.681 0-168.271 137.949-304.681 308.118-304.681 170.169 0 308.119 136.411 308.119 304.681C820.594 511.837 682.645 648.247 512.476 648.247L512.476 648.247zM512.476 100.186c-135.713 0-246.12 109.178-246.12 243.381 0 134.202 110.407 243.381 246.12 243.381 135.719 0 246.126-109.179 246.126-243.381C758.602 209.364 648.195 100.186 512.476 100.186L512.476 100.186zM935.867 985.115l-26.164 0c-9.648 0-17.779-6.941-19.384-16.35-2.646-15.426-6.277-30.52-11.142-44.95-24.769-87.686-81.337-164.13-159.104-214.266-63.232 35.203-134.235 53.64-207.597 53.64-73.555 0-144.73-18.537-208.084-53.922-78 50.131-134.75 126.68-159.564 214.549 0 0-4.893 18.172-11.795 46.4-2.136 8.723-10.035 14.9-19.112 14.9L88.133 985.116c-9.415 0-16.693-8.214-15.47-17.452C91.698 824.084 181.099 702.474 305.51 637.615c58.682 40.472 129.996 64.267 206.966 64.267 76.799 0 147.968-23.684 206.584-63.991 124.123 64.932 213.281 186.403 232.277 329.772C952.56 976.901 945.287 985.115 935.867 985.115L935.867 985.115z" />
                                                </svg>
                                            </div>
                                            <div class="bb-btn-desc">
                                                <span class="bb-btn-title">Tài khoản</span>
                                                @if (Auth::check())
                                                <span class="bb-btn-stitle">{{ Auth::user()->firstname }}{{ Auth::user()->lastname }}</span>  
                                                @else
                                                <span class="bb-btn-stitle">Đăng nhập</span> 
                                                @endif
                                            </div>
                                        </a>
                                        <ul class="bb-dropdown-menu">
                                            @if (Auth::check())
                                            <li><a class="dropdown-item" href="{{route('user.shiping')}}">Đơn hàng của tôi</a></li>  
                                            <li><a class="dropdown-item" href="{{route('user.logout')}}">Đăng xuất</a></li>  
                                            @else
                                            <li><a class="dropdown-item" href="{{route('user.register')}}">Tạo tài khoản</a></li>
                                            <li><a class="dropdown-item" href="{{route('user.login')}}">Đăng nhập</a></li>
                                            @endif
                                    
                                        </ul>
                                    </div>
                                    
                                    <a href="{{route('cart.view')}}" class="bb-header-btn" title="Cart">
                                        <div class="header-icon">
                                            <svg class="svg-icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M351.552 831.424c-35.328 0-63.968 28.64-63.968 63.968 0 35.328 28.64 63.968 63.968 63.968 35.328 0 63.968-28.64 63.968-63.968C415.52 860.064 386.88 831.424 351.552 831.424L351.552 831.424 351.552 831.424zM799.296 831.424c-35.328 0-63.968 28.64-63.968 63.968 0 35.328 28.64 63.968 63.968 63.968 35.328 0 63.968-28.64 63.968-63.968C863.264 860.064 834.624 831.424 799.296 831.424L799.296 831.424 799.296 831.424zM862.752 799.456 343.264 799.456c-46.08 0-86.592-36.448-92.224-83.008L196.8 334.592 165.92 156.128c-1.92-15.584-16.128-28.288-29.984-28.288L95.2 127.84c-17.664 0-32-14.336-32-31.968 0-17.664 14.336-32 32-32l40.736 0c46.656 0 87.616 36.448 93.28 83.008l30.784 177.792 54.464 383.488c1.792 14.848 15.232 27.36 28.768 27.36l519.488 0c17.696 0 32 14.304 32 31.968S880.416 799.456 862.752 799.456L862.752 799.456zM383.232 671.52c-16.608 0-30.624-12.8-31.872-29.632-1.312-17.632 11.936-32.928 29.504-34.208l433.856-31.968c15.936-0.096 29.344-12.608 31.104-26.816l50.368-288.224c1.28-10.752-1.696-22.528-8.128-29.792-4.128-4.672-9.312-7.04-15.36-7.04L319.04 223.84c-17.664 0-32-14.336-32-31.968 0-17.664 14.336-31.968 32-31.968l553.728 0c24.448 0 46.88 10.144 63.232 28.608 18.688 21.088 27.264 50.784 23.52 81.568l-50.4 288.256c-5.44 44.832-45.92 81.28-92 81.28L385.6 671.424C384.8 671.488 384 671.52 383.232 671.52L383.232 671.52zM383.232 671.52" />
                                            </svg>
                                            <span class="main-label-note-new"></span>
                                        </div>
                                        <div class="bb-btn-desc">
                                            <span class="bb-btn-title"><b class="bb-cart-count"><x-cart-nav/></b></span>
                                            <span class="bb-btn-stitle">Giỏ hàng</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)" class="bb-toggle-menu">
                                        <div class="header-icon">
                                            <i class="ri-menu-3-fill"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bb-main-menu-desk">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bb-inner-menu-desk">
                        <div class="bb-main-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.index')}}">Trang chủ</a>
                                </li>
                                <li class="nav-item bb-main-dropdown">
                                    <a class="nav-link bb-dropdown-item" href="javascript:void(0)">Danh mục</a>
                                    <ul class="mega-menu">
                                        <li>
                                            <x-categoty-nav/>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.show')}}">Xem của hàng</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bb-mobile-menu-overlay"></div>
    <div id="bb-mobile-menu" class="bb-mobile-menu">
        <div class="bb-menu-title">
            <span class="menu_title">Tiêu đề</span>
            <button type="button" class="bb-close-menu">×</button>
        </div>
        <div class="bb-menu-inner">
            <div class="bb-menu-content">
                <ul>
                    <li>
                        <a href="{{route('user.index')}}">Trang chủ</a>
                    </li>
                    {{-- <li>
                        <a class="nav-link bb-dropdown-item" href="javascript:void(0)">Danh mục</a>
                        
                    </li> --}}
                    <li class=""><span class="menu-toggle"></span>
                        <a href="javascript:void(0)">Categories</a>
                        <x-categoty-nav/>
                    </li>
                    <li>
                        <a href="{{route('user.show')}}">Xem của hàng</a>
                    </li>
                </ul>
            </div>
            <div class="header-res-lan-curr">
                <!-- Social Start -->
                <div class="header-res-social">
                    <div class="header-top-social">
                        <ul class="mb-0">
                            <li class="list-inline-item">
                                <a href="https://www.facebook.com/"><i class="ri-facebook-fill"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://twitter.com/"><i class="ri-twitter-fill"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://instagram.com/"><i class="ri-instagram-line"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://linkedin.com/"><i class="ri-linkedin-fill"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Social End -->
            </div>
        </div>
    </div>
</header>
