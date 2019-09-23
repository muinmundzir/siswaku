<nav class="navbar navbar-default">
<div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#bs-example-navbar-collapse-1"
            aria-expanded="false">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">SiswakuApp</a>
    </div>
    <div class="collapse navbar-collapse"
        id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            @if (!empty($halaman) && $halaman == 'siswa')
                <li class="active"><a href="{{ url('siswa')}}">Siswa
                <span class="sr-only">(current)</span></a></li>
            @else
                <li><a href="{{ url('siswa')}}">Siswa</a></li>                
            @endif
            @if (!empty($halaman) && $halaman == 'kelas')
                <li class="active"><a href="{{ url('kelas')}}">Kelas
                <span class="sr-only">(current)</span></a></li>
            @else
                <li><a href="{{ url('kelas')}}">Kelas</a></li>
            @endif
            @if (!empty($halaman) && $halaman == 'hobi')
                <li class="active"><a href="{{ url('hobi') }}">Hobi
                <span class="sr-only">(current)</span></a></li>
            @else
                <li><a href="{{ url('hobi')}}">Hobi</a></li>
            @endif
            @if (!empty($halaman) && $halaman == 'about')
                <li class="active"><a href="{{ url('about') }}">About
                <span class="sr-only">(current)</span></a></li>
            @else
                <li><a href="{{ url('about')}}">About</a></li>
            @endif
            @if (!empty($halaman) && $halaman == 'user')
                <li class="active"><a href="{{ url('user') }}">User
                <span class="sr-only">(current)</span></a></li>
            @else
                <li><a href="{{ url('user') }}">User</a></li>
            @endif
        </ul>

        {{-- Link Login / Logout --}}
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout')}}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @else
                <li class="nav-item"> 
                    <a class="nav-link" href="{{ route('login') }}">
                        {{ __('Login')}}
                    </a>
                </li>
            @endif
        </ul>
        {{-- /logout link --}}

    </div>
</div>
</nav>