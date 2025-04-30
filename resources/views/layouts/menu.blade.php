<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Male Fashion</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/shop') }}">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/blog') }}">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
        </li>
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/register') }}">Register</a>
          </li>
        @else
          @if (!Auth::user()->hasVerifiedEmail())
            <li class="nav-item">
              <a class="nav-link" href="{{ route('verification.notice') }}" style="color: #e53637;">Verify Email</a>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/profile') }}">Profile ({{ Auth::user()->name }})</a>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="nav-link btn btn-link" style="padding: 0; border: none; background: none; margin-right: 15px;">Logout</button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>