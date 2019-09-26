<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
  <a class="navbar-brand" href="/home"><span>P</span>hoto<span>S</span>how</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/videos">Videos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/albums">Albums</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/photos">Photos</a>
      </li>
      <li class="nav-item">
        @guest
          <a style="color: #FFA500 !important;" class="nav-link" href="/register">Join us</a>
        @endguest
        @auth
          <a style="color: #FFA500 !important;" class="nav-link user-drop">{{ auth()->user()->name }}</a>
        @endauth
      </li>
    </ul>
  </div>
  </div>

  <div class="user-dropdown">
      
      <ul class="list-unstyled">
        <li><a href="/register">Join us</a></li>
        @auth
        <li><a href="/profile/{{ auth()->user()->name }}">Profile</a></li>
        @endauth
        <li><a href="/logout">Logout</a></li>
      </ul>

  </div>

</nav>
