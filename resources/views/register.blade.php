<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>

    <!----------------------- Main Container -------------------------->

    @if (session('status') == 'gagal')
    {{-- <?php
    print_r(session()->all());
    ?> --}}
    <div class="alert alert-danger">
        <p>password beda </p>
    </div>
@endif
     <div class="container d-flex justify-content-center align-items-center min-vh-100">


    <!----------------------- Login Container -------------------------->

       <div class="row border rounded-5 p-3 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->

       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: orange;">
           <div class="featured-image mb-3">
            <img src="{{ asset('Assets/image/background.png') }}" class="img-fluid" style="width: 250px;">
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Mel's Cake</p>
           <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on this platform.</small>
       </div> 

    <!-------------------- ------ Right Box ---------------------------->
        
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2>Register page</h2>
                </div>
                <form action="{{ route('kirimregister') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder=" User Name" id="username" name="username">
                    </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" id="email" name="email">
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" id="password" name="password">
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-warning  w-100 fs-6 text-white" type="submit">Register</button>
                </div>
            </form>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-light w-100 fs-6 "><small>Sign Up with Google</small></button>
                </div>
                <div class="row">
                    <small>Already have account? <a href="{{ route('login') }}">Sign in</a></small>
                </div>
          </div>
       </div> 

      </div>
    </div>

</body>
</html>