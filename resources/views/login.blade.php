<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>

    <!----------------------- Main Container -------------------------->
    {{-- @if (session('status') == 'terkirim')
<div class="alert alert-danger">
    <p>Selamat datang 
        @if (session('username'))
        {{session('username')}}
        @endif   
    </p>
</div>
@endif --}}

    @if (session('status') == 'eror')
        <div class="alert alert-danger">
            <p>login gagal</p>
        </div>
    @endif


    <div class="container d-flex justify-content-center align-items-center min-vh-100">


        <!----------------------- Login Container -------------------------->
        
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            
    @if (session('error'))
    <div class="alert alert-danger">
    {{ session('error') }}
</div>
    @endif
            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: orange;">
                <div class="featured-image mb-3">
                    <img src="{{ asset('Assets/image/background.png') }}" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">
                    Mel's Cake</p>
                <small class="text-white text-wrap text-center"
                    style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on
                    this platform.</small>
            </div>

            <!-------------------- ------ Right Box ---------------------------->

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Login page</h2>
                        <p>Selamat datang @if (session('username'))
                                {{ session('username') }}
                            @endif
                        </p>
                    </div>
                    <form action="{{ route('kirimlogin') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6"
                                placeholder=" User Name" id="username" name="username">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Email address" id="email" name="email">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Password" id="password" name="password">
                        </div>
                        <div class="input-group mb-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember
                                        Me</small></label>
                            </div>
                            <div class="forgot">
                                <small><a href="#">Forgot Password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-warning  w-100 fs-6" type="submit">Login</button>
                        </div>
                    </form>
                    <div class="row mt-3">
                        <small>Don't have account? <a href="{{ route('register') }}">Sign Up</a></small>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
