<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Simple Photo Sharing" />
    <meta name="author" content="Sheikh Heera" />

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
	  <title>Photoshow</title>

</head>
<body>

	@include('inc.navbar')

    @if (! Request::is('admins') && ! Request::is('admins/*'))
        @include('inc.header')
    @endif

    <div class="container">
        @auth
            @if(auth()->user()->admin == 0)
                <div class="alert alert-info alert-dismissible fade show">
                    Hello <strong>{{ auth()->user()->name }}</strong> Thanks for joining us, we've recieved your request, you can view albums, downlaod images for now.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        @endauth
        @yield('content')
    </div>

    @if(! Request::is('admins') && ! Request::is('admins/*') )
    <!-- Footer -->
    <footer class="page-footer font-small unique-color-dark pt-4">

      <!-- Footer Elements -->

        <!-- Call to action -->
        <ul class="list-unstyled list-inline text-center py-2">
          <li class="list-inline-item">
            <h5 class="mb-1">Register for free</h5>
          </li>
          <li class="list-inline-item">
            <a href="/register" class="btn btn-outline-white btn-rounded sign-up-btn">Sign up!</a>
          </li>
        </ul>
        <!-- Call to action -->

        <!-- Social buttons -->
        <ul class="list-unstyled list-inline text-center">
          <li class="list-inline-item">
            <a href="#" class="btn-floating btn-fb mx-1">
              <i class="fa fa-facebook-f"> </i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="btn-floating btn-gplus mx-1">
              <i class="fa fa-google-plus"> </i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="btn-floating btn-li mx-1">
              <i class="fa fa-linkedin"> </i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" class="btn-floating btn-dribbble mx-1">
              <i class="fa fa-dribbble"> </i>
            </a>
          </li>
        </ul>
        <!-- Social buttons -->

      <!-- Footer Elements -->

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2018 Copyright:
        <a href="/">photoshow.com</a>
      </div>
      <!-- Copyright -->

    </footer>
    <!-- Footer -->
    @endif

    <!-- JQuery CDN -->
    <script
    src="https://code.jquery.com/jquery-1.12.4.js"
    integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
    crossorigin="anonymous"></script>

    <!-- Bootstrap js CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    
    <script src="{{ asset('js/script.js') }}"></script>


    @yield('scripts')

</body>
</html>