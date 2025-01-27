<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin_assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('admin_assets/img/favicon.png')}}">
  <title>
    Expense Tracker
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="{{asset('admin_assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('admin_assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('admin_assets/css/material-dashboard.css?v=3.2.0')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
</head>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-2 pe-1">
                  <h4 class="text-white font-weight-bolder text-center my-3">Sign in</h4>
                </div>
              </div>
              <div class="card-body">
                <form class="text-start" action="{{route('user.login')}}" method="POST">
                    @csrf
                    @if(Session::has('error'))
                        <small class="text-danger"> {{Session::get('error')}} </small>
                    @endif

                    @error('email')
                    <small class="text-danger"> {{$message}} </small>
                    @enderror
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                  </div>
                  @error('password')
                  <small class="text-danger"> {{$message}} </small>
                  @enderror
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe" value="1" {{ old('rememberMe') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign in</button>
                  </div>
                  <div class="d-flex justify-content-between align-items-center pt-0">
                    <div class="">
                        <br/>
                        <a href="{{ route('auth.google') }}">
                            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                        </a>
                    </div>
                    <div>
                        <span class="text-sm">Don't have an account?</span><br>
                        <a href="{{ route('register.form') }}" class="text-dark float-end">Sign up</a>
                    </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-12 col-md-6 my-auto">
              <div class="copyright text-center text-sm text-white text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart" aria-hidden="true"></i> by
                <a href="https://authorselvi.com" class="font-weight-bold text-white" target="_blank">AuthorSelvi</a>
                for a better web.
              </div>
            </div>
            <div class="col-12 col-md-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://authorselvi.com" class="nav-link text-white" target="_blank">AuthorSelvi</a>
                </li>
                <li class="nav-item">
                  <a href="https://authorselvi.com/about-us/" class="nav-link text-white" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://authorselvi.com/blog/" class="nav-link text-white" target="_blank">Blog</a>
                </li>
                {{-- <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-white" target="_blank">License</a>
                </li> --}}
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="{{asset('admin_assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('admin_assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin_assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('admin_assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script src="{{asset('admin_assets/js/material-dashboard.min.js?v=3.2.0')}}"></script>

@if(Session::has('success'))
    <script>
        $(document).ready(function() {
            toastr.success("{{ Session::get('success') }}");
        });
    </script>
@endif

@if(Session::has('error'))
    <script>
        $(document).ready(function() {
            toastr.error("{{ Session::get('error') }}");
        });
    </script>
@endif
</body>
</html>
