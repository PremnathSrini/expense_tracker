<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expense Tracker</title>
    {{-- <link id="pagestyle" href="{{asset('admin_assets/css/material-dashboard.css?v=3.2.0')}}" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <section class="bg-image"
        style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center gradient-custom-3">
        <div class="container h-100">
          <div class="row justify-content-center align-items-center">
            <div class="col-12 col-lg-9 col-xl-7">
              <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-5">
                  <h3 class="mb-2">Registration Form</h3>
                  <form action="{{route('user.register')}}" method="POST">
                    @csrf
                    @error('name')
                    <span class="text-danger"> {{$message}} </span>
                    @enderror
                    <div data-mdb-input-init class="form-outline mb-3">
                      <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control form-control-lg" />
                      <label class="form-label" for="name"  >Your Name</label><span class="text-danger">*</span>
                    </div>

                    @error('email')
                    <span class="text-danger"> {{$message}} </span>
                    @enderror
                    <div data-mdb-input-init class="form-outline mb-3">
                      <input type="email" name="email" id="email"  value="{{old('email')}}"class="form-control form-control-lg" />
                      <label class="form-label" for="email"  >Your Email</label><span class="text-danger">*</span>
                    </div>

                    @error('password')
                    <span class="text-danger"> {{$message}} </span>
                    @enderror
                    <div data-mdb-input-init class="form-outline mb-3">
                      <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control form-control-lg" />
                      <label class="form-label" for="password"  >Password</label><span class="text-danger">*</span>
                    </div>

                    @error('password_confirmation')
                    <span class="text-danger"> {{$message}} </span>
                    @enderror
                    <div data-mdb-input-init class="form-outline mb-3">
                      <input type="password" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" class="form-control form-control-lg" />
                      <label class="form-label" for="password_confirmation">Repeat your password</label><span class="text-danger">*</span>
                    </div>


                    {{-- <div class="form-check d-flex justify-content-center mb-5">
                      <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                      <label class="form-check-label" for="form2Example3g">
                        I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                      </label>
                    </div> --}}

                    <div class="d-flex justify-content-center">
                      <button type="submit" data-mdb-button-init
                        data-mdb-ripple-init class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                    </div>

                    <p class="text-center text-muted mt-3 mb-0">Have already an account? <a href="{{url('/')}}"
                        class="fw-bold text-body"><u>Login here</u></a></p>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>

    <script src="{{asset('admin_assets/js/core/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @if(Session::has('message'))
    <script>
        $(document).ready(function () {
            toastr.success("Session::get('message')");
        });
    </script>
    @endif
</body>
</html>

