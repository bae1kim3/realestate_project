<link rel="stylesheet" href="{{ asset('nav.css') }}">

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                    <div class="ml-2">
                        <button id="darkToggle" type="button" x-bind:class="darkMode ? 'bg-indigo-500' : 'bg-gray-200'"
                            x-on:click="darkMode = !darkMode"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            role="switch" aria-checked="false">
                            <span class="sr-only">다크모드</span>
                            <span x-bind:class="darkMode ? 'translate-x-5 bg-gray-700' : 'translate-x-0 bg-white'"
                                class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full shadow ring-0 transition duration-200 ease-in-out">
                                <span
                                    x-bind:class="darkMode ? 'opacity-0 ease-out duration-100' : 'opacity-100 ease-in duration-200'"
                                    class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                                    aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                    </svg>
                                </span>
                                <span
                                    x-bind:class="darkMode ? 'opacity-100 ease-in duration-200' : 'opacity-0 ease-out duration-100'"
                                    class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity"
                                    aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        <h2 class="dark:text-gray-100">
                            {{ __('홈') }}
                        </h2>
                    </x-nav-link>
                </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('map.map')" :active="request()->routeIs('map.map')">
                        <h2 class="dark:text-gray-100">
                            {{ __('지도') }}
                        </h2>
                    </x-nav-link>
                </div>

            @if(session('seller_license'))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <h2 class="dark:text-gray-100">
                            {{ __('매물올리기') }}
                        </h2>
                    </x-nav-link>
                </div>
            @endif
            
            @if(!session('u_id'))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        <h2 class="dark:text-gray-100">
                            {{ __('로그인') }}
                        </h2>
                    </x-nav-link>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        <h2 class="dark:text-gray-100">
                            {{ __('회원가입') }}
                        </h2>
                    </x-nav-link>
                </div>
            @endif
            </div>

            <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex justify-center" style="margin-top:20px; margin-right:200px">
            </div>

            @if (isset(session()->all()['auth']))
                <!-- Settings Dropdown -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button>
                                    <img class="h-8 w-8 rounded-full object-cover" id="img"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                        id="profile-img">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->

                            <x-dropdown-link :href="route('profile.com')">
                                {{ __('프로필') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link :href="route('logout')" @click.prevent="$root.submit();">
                                    {{ __('로그아웃') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                {{-- <div
                    @if (Route::has('login'))
                        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">매물올리기</a>
                                    <a href="{{ route('map.map') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">지도</a>
                            @else
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <a href="{{ route('map.map') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 dark:text-white">지도</a>
                                    <a href="{{ route('login') }}"
                                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 dark:text-white">로그인</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 dark:text-white">회원가입</a>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    @endif --}}
            @endif


            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link class="dark:text-white" :href="route('welcome')" :active="request()->routeIs('welcome')">
                {{ __('홈') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link class="dark:text-white" :href="route('map.map')" :active="request()->routeIs('map.map')">
                {{ __('지도') }}
            </x-responsive-nav-link>
        </div>
        @if (!session('u_id'))
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link class="dark:text-white" :href="route('login')" :active="request()->routeIs('login')">
                {{ __('로그인') }}
            </x-responsive-nav-link>
        </div>
        @endif

        @if (session('seller_license'))
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link class="dark:text-white" :href="url(url('/dashboard'))" :active="request()->routeIs('dashborad')">
                {{ __('매물올리기') }}
            </x-responsive-nav-link>
        </div>
        @endif

        <div class="pt-2 pb-3 space-y-1">
            @if (!session('u_id'))
                <x-responsive-nav-link class="dark:text-white" :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('회원가입') }}
                </x-responsive-nav-link>
            @endif
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-gray-200">
            <div class="px-4">
                @if (auth()->check())
                    <x-responsive-nav-link :href="route('profile.com')" :active="request()->routeIs('profile.com')">
                    <div class="font-medium text-base text-gray-500 dark:text-white">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500 dark:text-white">{{ auth()->user()->email }}</div>
                    </x-responsive-nav-link>
                @endif

            </div>


                <!-- Authentication -->
                @if(session('u_id'))
                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link class="dark:text-white" :href="route('logout')"
                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                        {{ __('로그아웃') }}
                    </x-responsive-nav-link>
                </form>
                </div>
                @endif

        </div>
    </div>
</nav>
