<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renata | Masuk</title>

    <!-- Logo WEB TAB -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/assets/Logo Tanpa Tulisan.png') }}" />

    <!-- CSS Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font-awesome -->
    <script src="https://kit.fontawesome.com/637575c4e9.js" crossorigin="anonymous"></script>

    <!-- My CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/auth-style.css') }}">
</head>

<body>
    <!-- navbar -->
    <nav>
        <div class="container">
            <div class="flex-nav">
                <div>
                    <!-- <p>halo</p> -->
                </div>
                <div>
                    <img src="{{ asset('assets/frontend/assets/logo.png') }}" alt="">
                </div>
                <div class="gambar-telkom">
                    <div class="garis-verical"></div>
                    <img class="nav-link" src="{{ asset('assets/frontend/assets/image 5.png') }}" alt="">
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Form Auth -->
    <div class="form-card">
        <div class="header-form">
            <i onclick="window.location.href='{{ route('main') }}'" class="fa-solid fa-arrow-left"></i>
            <h2>Masuk</h2>
            <a href="{{ route('register') }}">Daftar</a>
        </div>
        <!-- Form Login -->
        <form action="{{ route('login-ol') }}" method="post">
            @csrf
            <label for="">Alamat Email</label>
            <input type="email" name="email" required>
            <label for="">Password</label>
            <div class="password-input">
                <input type="password" name="password" id="password" required>
                <i class="fa-solid fa-eye-slash" id="togglePassword"></i>
            </div>

            <button class="button-submit" type="submit">
                <p></p>
                <p>Masuk</p>
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <p class="forgot-password">Lupa Password? <a href="#">Atur Ulang Password Disini</a></p>
        </form>
    </div>

    <!-- Akhir Form Auth -->


    <!-- Footer -->
    <div class="copyright">
        <p>© Renata 2023. All Right Reserved.</p>
    </div>
    <!-- Akhir Footer -->

    <!-- Script Blind Password -->
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("fa-eye");
        });
    </script>
</body>

</html>
