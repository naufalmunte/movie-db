<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-success">
      <div class="container-fluid">
          <a class="navbar-brand" href="#">Movie DB</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link @yield('navHome')" aria-current="page" href="{{ route('movies.index') }}">Home</a>
                  </li>
                  @auth
                  <li class="nav-item">
                      <a class="nav-link @yield('navInput')" href="{{ route('movies.create') }}">Input Movie</a>
                  </li>
                  @endauth
              </ul>

             <!-- Search Bar -->
            <form class="d-flex me-3" action="{{ route('movies.search') }}" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Search by title" aria-label="Search" value="{{ request()->query('query') }}">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>

            <!-- Tombol Login / Logout -->
            @auth
            <div class="d-flex align-items-center text-white me-2">
                Hello, {{ explode(' ', auth()->user()->name)[0] ?? auth()->user()->email }}
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light">Logout</button>
            </form>
            @endauth


                @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
                @endguest

          </div>
      </div>
  </nav>
</header>
