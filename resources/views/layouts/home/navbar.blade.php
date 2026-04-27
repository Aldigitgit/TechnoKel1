<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="container">
        <!-- Brand / Logo -->
        <a class="navbar-brand" href="#" id="logo">🥟 Duha Pao</a>

        <!-- Toggler (mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <!-- Dropdown Category -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-bs-toggle="dropdown">
                        Menu
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#product-cards" onclick="filterMenu('bakpao-manis', this)">Bakpao Manis</a></li>
                        <li><a class="dropdown-item" href="#product-cards" onclick="filterMenu('bakpao-gurih', this)">Bakpao Gurih</a></li>
                        <li><a class="dropdown-item" href="#product-cards" onclick="filterMenu('risol-mayo', this)">Risol Mayo</a></li>
                        <li><a class="dropdown-item" href="#product-cards" onclick="filterMenu('dimsum', this)">Dimsum</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#product-cards" onclick="filterMenu('semua', this)">Semua Menu</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallary">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Kontak</a>
                </li>
            </ul>
            <!-- Tombol Login di kanan -->
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn-login">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- CSS tambahan untuk navbar dan tombol login -->
<style>
    /* Navbar styling sesuai tema Duha Pao */
    #navbar {
        background-color: #4A1E0C; /* brown-dark */
        padding: 0.5rem 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        position: sticky;
        top: 0;
        z-index: 1030;
    }
    #navbar .navbar-brand {
        font-family: 'Playfair Display', serif;
        font-size: 1.7rem;
        font-weight: 700;
        color: #FFD4A8;
        letter-spacing: 1px;
    }
    #navbar .navbar-brand:hover {
        color: #E8A040;
    }
    #navbar .nav-link {
        color: #FFF8F0;
        font-weight: 600;
        margin: 0 0.5rem;
        transition: 0.3s;
        font-size: 1rem;
    }
    #navbar .nav-link:hover,
    #navbar .nav-link.active {
        color: #D4882E;
    }
    .dropdown-menu {
        background-color: #FFF8F0;
        border: 1px solid rgba(212,136,46,0.3);
        border-radius: 12px;
        margin-top: 0.5rem;
    }
    .dropdown-item {
        color: #4A1E0C;
        font-weight: 500;
    }
    .dropdown-item:hover {
        background-color: #FFE5CC;
        color: #D4882E;
    }
    .btn-login {
        background-color: #D4882E;
        color: white;
        border: none;
        padding: 6px 18px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: 0.2s;
    }
    .btn-login:hover {
        background-color: #E8A040;
        color: #4A1E0C;
        transform: translateY(-2px);
    }
    .navbar-toggler {
        border-color: rgba(255,212,168,0.5);
    }
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,212,168,1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    @media (max-width: 992px) {
        #navbar .navbar-nav {
            margin: 1rem 0;
        }
        .btn-login {
            margin-left: 0;
            margin-top: 0.5rem;
            width: fit-content;
        }
    }
</style>