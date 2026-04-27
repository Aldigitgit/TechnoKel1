<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Register | Duha Pao</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --brown-dark: #4A1E0C;
            --brown: #6B3A2A;
            --brown-mid: #8B4A30;
            --gold: #D4882E;
            --gold-light: #E8A040;
            --cream: #FFF8F0;
            --cream-mid: #FFF2E5;
            --cream-dark: #FFE5CC;
            --muted: #9A7060;
            --text: #2C1A10;
        }

        body {
            font-family: 'Nunito', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, var(--cream) 0%, var(--cream-dark) 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative background elements */
        body::before {
            content: '🥟';
            position: absolute;
            bottom: 20px;
            left: 20px;
            font-size: 120px;
            opacity: 0.05;
            pointer-events: none;
        }

        body::after {
            content: '🥠';
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 100px;
            opacity: 0.05;
            pointer-events: none;
        }

        /* Main Container */
        .container {
            min-height: 100vh;
            padding: 2rem;
        }

        /* Register Box */
        .box-area {
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .box-area:hover {
            transform: translateY(-5px);
        }

        /* Left Box */
        .left-box {
            background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown) 50%, var(--brown-mid) 100%);
            position: relative;
            overflow: hidden;
        }

        .left-box::before {
            content: '🧀';
            position: absolute;
            bottom: -30px;
            left: -30px;
            font-size: 180px;
            opacity: 0.08;
            pointer-events: none;
        }

        .left-box::after {
            content: '🥟';
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 140px;
            opacity: 0.08;
            pointer-events: none;
        }

        .featured-image {
            position: relative;
            z-index: 1;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .featured-image img {
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.2));
        }

        .brand-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 900;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
        }

        .brand-subtitle {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.8);
            max-width: 200px;
            text-align: center;
            line-height: 1.6;
        }

        /* Right Box */
        .right-box {
            padding: 2.5rem;
            background: white;
        }

        .header-text h2 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--brown-dark);
            margin-bottom: 8px;
        }

        .header-text p {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        /* Form Styles */
        .form-control {
            border-radius: 12px;
            border: 2px solid #F0E5D8;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: 'Nunito', sans-serif;
        }

        .form-control:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(212, 136, 46, 0.1);
            outline: none;
        }

        .input-group {
            margin-bottom: 1.25rem;
        }

        /* Register Button */
        .btn-register {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 136, 46, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 136, 46, 0.4);
            background: linear-gradient(135deg, var(--gold-light) 0%, var(--gold) 100%);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        /* Google Button */
        .btn-google {
            background: white;
            color: var(--muted);
            border: 2px solid #F0E5D8;
            padding: 10px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-google:hover {
            border-color: var(--gold);
            background: var(--cream);
            transform: translateY(-2px);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #F0E5D8;
        }

        .divider span {
            margin: 0 10px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
        }

        /* Sign In Link */
        .signin-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .signin-link small {
            color: var(--muted);
            font-size: 13px;
        }

        .signin-link a {
            color: var(--gold);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s;
        }

        .signin-link a:hover {
            color: var(--brown-mid);
            text-decoration: underline;
        }

        /* Alert Styles */
        .alert-custom {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 300px;
            border-radius: 12px;
            padding: 15px 20px;
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .alert-danger {
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
            color: #991B1B;
            border-left: 4px solid #DC2626;
        }

        .alert-success {
            background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
            color: #065F46;
            border-left: 4px solid #10B981;
        }

        /* Password Requirements */
        .password-requirements {
            font-size: 11px;
            color: var(--muted);
            margin-top: -0.5rem;
            margin-bottom: 0.5rem;
            padding-left: 0.5rem;
        }

        .password-requirements span {
            display: inline-block;
            margin-right: 12px;
        }

        .requirement-met {
            color: #10B981;
        }

        .requirement-unmet {
            color: var(--muted);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .box-area {
                border-radius: 24px;
            }

            .right-box {
                padding: 2rem;
            }

            .left-box {
                padding: 2rem !important;
            }

            .brand-title {
                font-size: 24px;
            }

            .header-text h2 {
                font-size: 28px;
            }

            body::before,
            body::after {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .right-box {
                padding: 1.5rem;
            }

            .header-text h2 {
                font-size: 24px;
            }

            .btn-register,
            .btn-google {
                padding: 10px;
            }

            .alert-custom {
                min-width: calc(100% - 40px);
                left: 20px;
                right: 20px;
            }
        }

        /* Eye icon for password */
        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--muted);
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- Alert Notifications -->
    @if (session('status') == 'gagal')
        <div class="alert-custom alert-danger">
            <strong>❌ Registrasi Gagal!</strong><br>
            Password tidak sesuai. Silakan coba lagi.
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-custom alert-danger">
            <strong>❌ Error!</strong><br>
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="alert-custom alert-success">
            <strong>✅ Registrasi Berhasil!</strong><br>
            {{ session('success') }}
        </div>
    @endif

    <div class="container d-flex justify-content-center align-items-center">
        <div class="row border-0 rounded-4 p-0 bg-white shadow box-area">

            <!-- Left Box - Branding Area -->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box p-4">
                <div class="featured-image mb-3">
                    <img src="https://png.pngtree.com/png-vector/20221019/ourmid/pngtree-meatbun-chines-png-image_6353132.png" class="img-fluid"
                        style="width: 220px; border-radius: 20px;">
                </div>
                <h1 class="brand-title">Duha Pao</h1>
                <p class="brand-subtitle mt-2">Bakpao & Dimsum Segar Setiap Hari</p>
                <div class="mt-3 text-center">
                    <small style="color: rgba(255,212,168,0.7); font-size: 11px;">✨ Bergabunglah dengan keluarga 
                         ✨</small>
                </div>
            </div>

            <!-- Right Box - Register Form -->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Buat Akun</h2>
                        <p>Daftar sekarang untuk memesan bakpao & dimsum favoritmu</p>
                    </div>

                    <form action="{{ route('kirimregister') }}" method="POST" id="registerForm">
                        @csrf

                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Username" id="username" name="username"
                                value="{{ old('username') }}" required>
                        </div>

                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email Address" id="email" name="email"
                                value="{{ old('email') }}" required>
                        </div>

                        <div class="input-group">
                            <div class="password-wrapper" style="width: 100%; position: relative;">
                                <input type="password" class="form-control" placeholder="Password" id="password"
                                    name="password" required>
                                <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
                            </div>
                        </div>

                        <div class="password-requirements" id="passwordRequirements">
                            <span id="lengthReq" class="requirement-unmet">🔘 Minimal 6 karakter</span>
                            <span id="letterReq" class="requirement-unmet">🔘 Huruf & angka</span>
                        </div>

                        <div class="input-group">
                            <div class="password-wrapper" style="width: 100%; position: relative;">
                                <input type="password" class="form-control" placeholder="Confirm Password"
                                    id="confirm_password" name="confirm_password" required>
                                <span class="toggle-password" onclick="togglePassword('confirm_password')">👁️</span>
                            </div>
                        </div>

                        <div class="input-group">
                            <button class="btn btn-register w-100" type="submit" id="submitBtn">
                                📝 Daftar Sekarang
                            </button>
                        </div>
                    </form>

                    <div class="divider">
                        <span>atau</span>
                    </div>

                    <div class="input-group">
                        <button class="btn btn-google w-100"
                            onclick="alert('Fitur Google Sign In akan segera tersedia')">
                            🔑 Sign Up with Google
                        </button>
                    </div>

                    <div class="signin-link">
                        <small>Sudah punya akun?</small><br>
                        <a href="{{ route('login') }}">Masuk →</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
            field.setAttribute('type', type);
        }

        // Password validation
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('confirm_password');
        const submitBtn = document.getElementById('submitBtn');
        const lengthReq = document.getElementById('lengthReq');
        const letterReq = document.getElementById('letterReq');

        function validatePassword() {
            const password = passwordInput.value;
            const isValidLength = password.length >= 6;
            const hasLetterAndNumber = /[a-zA-Z]/.test(password) && /[0-9]/.test(password);

            // Update requirements styling
            if (isValidLength) {
                lengthReq.innerHTML = '✅ Minimal 6 karakter';
                lengthReq.className = 'requirement-met';
            } else {
                lengthReq.innerHTML = '🔘 Minimal 6 karakter';
                lengthReq.className = 'requirement-unmet';
            }

            if (hasLetterAndNumber) {
                letterReq.innerHTML = '✅ Huruf & angka';
                letterReq.className = 'requirement-met';
            } else {
                letterReq.innerHTML = '🔘 Huruf & angka';
                letterReq.className = 'requirement-unmet';
            }

            return isValidLength && hasLetterAndNumber;
        }

        function validateConfirmPassword() {
            const password = passwordInput.value;
            const confirm = confirmInput.value;
            return password === confirm && password !== '';
        }

        function updateSubmitButton() {
            const isPasswordValid = validatePassword();
            const isConfirmValid = validateConfirmPassword();

            if (isPasswordValid && isConfirmValid) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            } else {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.6';
                submitBtn.style.cursor = 'not-allowed';
            }
        }

        passwordInput.addEventListener('input', function () {
            validatePassword();
            updateSubmitButton();
        });

        confirmInput.addEventListener('input', function () {
            updateSubmitButton();
        });

        // Form validation before submit
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            if (!validatePassword() || !validateConfirmPassword()) {
                e.preventDefault();
                alert('⚠️ Silakan lengkapi persyaratan password dengan benar');
            }
        });

        // Initial button state
        updateSubmitButton();

        // Auto-hide alerts after 4 seconds
        setTimeout(function () {
            var alerts = document.querySelectorAll('.alert-custom');
            alerts.forEach(function (alert) {
                alert.style.animation = 'slideOut 0.3s ease forwards';
                setTimeout(function () {
                    alert.style.display = 'none';
                }, 300);
            });
        }, 4000);

        // Add slideOut animation
        var style = document.createElement('style');
        style.textContent = `
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>

</body>

</html>