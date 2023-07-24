<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <a href="{{route('welcome')}}" class="logo m-0 float-start">펫 방</a>
                <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                    <li class="active"><a href="{{route('welcome')}}">메인</a></li>
                    @if (session('u_id'))
                            @if (session('seller_license'))
                            <li><a href={{ route('dashboard') }}>매물올리기</a></li>
                            @endif
                            @if (session('seller_license'))
                            <li><a href="{{ route('sellpro') }}">내 정보</a></li>
                            @else
                            <li><a href="{{ route('profile') }}">내 정보</a></li>
                            @endif
                    </li>
                    @endif
                    <li><a href="{{ route('sellers_info') }}">공인중개사 목록</a></li>
                    @if (!session('u_id'))
                    <li><a href="{{ route('login') }}">로그인</a></li>
                    <li><a href="{{ route('register') }}" class="active">회원가입</a></li>
                    @else
                    <li><form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{route('logout')}}" style="color: white"
                                onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                로그아웃
                            </a>
                            </li>
                        </form></div>
                    @endif
                </ul>

                <a href="#" class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none" data-toggle="collapse" data-target="#main-navbar">
    <span></span>
</a>
</div>
</div>
</div>
</nav>
