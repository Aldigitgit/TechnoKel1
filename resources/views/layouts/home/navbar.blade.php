<nav class="navbar navbar-expand-md" id="navbar">
    <!-- Brand -->
    <a class="navbar-brand" href="#" id="logo"><img src="{{ asset('Assets/image/logo.png') }}"
            alt="" width="50px">Mels'cake</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span><img src="{{ asset('Assets/image/menu.png') }}" alt="" width="30px"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#home">Home</a>
            </li>
            <!-- dropdown -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                    Category
                </a>
                <div class="dropdown-menu">
                    <a href="#product-cards" class="dropdown-item">Birthday Cake</a>
                    <a href="#product-cards" class="dropdown-item">Chocolate Cake</a>
                    <a href="#product-cards" class="dropdown-item">Party Cake</a>
                    <a href="#product-cards" class="dropdown-item">Slice Cake</a>
                    <a href="#product-cards" class="dropdown-item">Cup Cake</a>
                </div>
            </li>
            <!-- dropdown -->
            <li class="nav-item">
                <a class="nav-link" href="#gallary">Galary</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
            </li>
        </ul>
    </div>
    <div class="icons">
        <a href="{{ route('login') }}">
            <img src="{{ asset('Assets/image/user.png') }}" alt="" width="20px">
        </a>    
    </div>
</nav>

@if (session('status') == 'success')
{{-- <?php
print_r(session()->all());
?> --}}

<div class="alert alert-success">
    <p>login berhasil</p>
</div>
@endif
