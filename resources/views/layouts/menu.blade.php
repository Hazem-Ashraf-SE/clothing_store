<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: transparent;">
  <div class="container">
    <a class="navbar-brand text-white" href="{{ url('/') }}">Male Fashion</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('webfront/shop') ? 'active' : '' }}" href="{{ url('webfront/shop') }}">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('webfront/blog') ? 'active' : '' }}" href="{{ url('webfront/blog') }}">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ request()->is('webfront/contact') ? 'active' : '' }}" href="{{ url('webfront/contact') }}">Contact</a>
        </li>

        @guest
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
          </li>
        @else
          @if (!Auth::user()->hasVerifiedEmail())
            <li class="nav-item">
              <a class="nav-link text-danger" href="{{ route('verification.notice') }}">Verify Email</a>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('profile') }}">Profile ({{ Auth::user()->name }})</a>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="nav-link btn btn-link text-white" style="padding: 0; border: none; background: none;">Logout</button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<style>
  .navbar-nav .nav-link:hover,
  .navbar-nav .nav-link.active {
    color: #e53637 !important;
  }
</style>
