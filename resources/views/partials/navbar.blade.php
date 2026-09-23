<nav class="navbar navbar-expand-lg fixed-top nala-navbar" data-nala-navbar>
    <div class="container nala-navbar__inner">
        <a class="navbar-brand nala-navbar__brand" href="{{ route('home') }}#home" aria-label="Nala Coffee home">
            <img class="nala-navbar__logo" src="{{ asset('images/nala-logo.png') }}" alt="Nala Coffee">
            <span><small>COFFEE N ROASTERY</small></span>
        </a>

        <button class="navbar-toggler nala-navbar__toggle" type="button" data-bs-toggle="collapse" data-bs-target="#nalaNavbar" aria-controls="nalaNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nalaNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center nala-navbar__menu">
                <li class="nav-item"><a class="nav-link" href="#cerita">Cerita</a></li>
                <li class="nav-item"><a class="nav-link" href="#kopi">Kopi</a></li>
                <li class="nav-item"><a class="nav-link" href="#proses">Proses</a></li>
                <li class="nav-item"><a class="nav-link" href="#petani">Petani</a></li>
                <li class="nav-item"><a class="nav-link" href="#mitra">Mitra</a></li>
                @auth('member')
                    <li class="nav-item"><a class="nav-link" href="{{ route('member.dashboard') }}">Member</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('member.logout') }}">
                            @csrf
                            <button class="nav-link nala-navbar__logout" type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('member.login') }}">Member</a></li>
                @endauth
                <li class="nav-item nala-navbar__contact"><a class="nav-link" href="#hubungi">Hubungi Nala <span>↗</span></a></li>
            </ul>
        </div>
    </div>
</nav>
