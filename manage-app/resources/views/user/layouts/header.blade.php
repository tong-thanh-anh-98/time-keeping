<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
        <div class="container">
            <a class="navbar-brand" href="index.html">Uruca</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.html">Home</a>
                    </li>
                </ul>
                @auth
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <a class="btn btn-danger me-2" href="{{ route('logout') }}" type="submit">Logout</a>
                    </form>
                @endauth
                @guest
                    <a class="btn btn-primary me-2" href="{{ route('login') }}">Login</a>
                @endguest
                <a class="btn btn-danger" href="{{ route('showTimeCard') }}" type="submit">TimeCard</a>
            </div>
        </div>
    </nav>
</header>
