<nav class="navbar navbar-expand-md shadow-sm">
    <div class="container">

        {{-- <a class="navbar-brand" href="{{ route('dashboard') }}">
            {{ __('Dashboard') }}
        </a> --}}

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fa-solid fa-bars"></i> <span>{{ __('Menu') }}</span>
        </button>

        <ul class="navbar-nav me-auto navbar-only-sm d-md-none">
            @auth
                <li class="nav-item ms-3">
                    <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-link me-1">
                        </i>{{ __('My links') }}</a>
                </li>
                <li class="nav-item ms-3">
                    <a class="nav-link" href="{{ route('links.create') }}"><i class="fa-solid fa-plus me-1">
                        </i>{{ __('Create new') }}</a>
                </li>
            @endauth
        </ul>

        <div class="collapse navbar-collapse mt-3 mt-md-0" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-house navbar-icon"></i>
                        </i>{{ __('Home') }}</a>
                </li>

                @auth
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-link me-1">
                            </i>{{ __('My links') }}</a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link" href="{{ route('links.create') }}"><i class="fa-solid fa-plus me-1">
                            </i>{{ __('Create new') }}</a>
                    </li>
                @endauth

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            {{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                {{ __('Register') }}</a>
                        </li>
                    @endif
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('Log Out') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth

                <li class="nav-item dropdown">
                    <x-lang-switcher />
                </li>

            </ul>
        </div>
    </div>
</nav>
