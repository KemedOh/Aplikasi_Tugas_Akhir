<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Politeknik LP3I Tasikmalaya - Login</title>

    <!-- ✅ Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ✅ Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#00426D] min-h-screen flex items-center justify-center p-4">
    <div class="bg-[#E9F0FF] rounded-[24px] max-w-5xl w-full flex flex-col md:flex-row overflow-hidden">
        <div class="md:w-1/2 p-6 md:p-10 flex flex-col justify-start items-start gap-6">
            <!-- Logo tetap di atas -->
            <img alt="Politeknik LP3I Tasikmalaya Logo" class="w-32 md:w-40 lg:w-48 h-auto"
                src="{{ asset('images/logoLP3Iwarna.png') }}" />
        
            <!-- Foto lebih besar -->
            <img alt="Illustration of Politeknik campus" class="w-full h-[300px] object-cover rounded-xl shadow-xl"
                src="{{ asset('images/fotosementara.jpg') }}" />
        </div>
        <div class="md:w-1/2 bg-white rounded-tr-[24px] rounded-br-[24px] p-6 md:p-10 flex flex-col justify-center">
            <p class="text-xs font-semibold text-[#00426D] mb-1 tracking-widest">
                MASUKKAN AKUN ANDA
            </p>
            <h1 class="text-3xl font-extrabold text-[#0B0B3B] mb-2">
                Login ke JuruAI Politeknik LP3I Kampus Tasikmalaya
            </h1>
            <p class="text-sm text-[#8B8B9A] mb-8">
                Belum punya akun?
                <a class="text-[#00426D] font-semibold hover:underline" href="{{ route('register') }}">
                    Daftar Sekarang.
                </a>
            </p>

            <form id="loginForm" class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div id="emailContainer">
                    <label for="email" class="block text-sm font-semibold text-[#00426D] mb-1 flex items-center gap-1">
                        E-Mail <span id="emailStar" class="text-red-500 text-lg"></span>
                    </label>
                    <div class="relative">
                        <input id="email" name="email" type="email" placeholder="youremail@lp3i.ac.id"
                            autocomplete="username" value="{{ old('email') }}"
                            class="w-full border border-[#D9D9E3] rounded-lg py-3 px-4 pr-12 placeholder-[#A3A3B7] text-[#000000] focus:outline-none focus:ring-2 focus:ring-[#00AEB6]" />
                        <i class="fa-solid fa-envelope absolute right-4 top-1/2 -translate-y-1/2 text-[#A3A3B7]"></i>
                    </div>
                </div>

                <!-- Password -->
                <div id="passwordContainer">
                    <label for="password"
                        class="block text-sm font-semibold text-[#00426D] mb-1 flex items-center gap-1">
                        Password <span id="passwordStar" class="text-red-500 text-lg"></span>
                    </label>
                    <div class="relative">
                        <input id="password" name="password" type="password" placeholder="****************"
                            autocomplete="current-password"
                            class="w-full border border-[#D9D9E3] rounded-lg py-3 px-4 pr-12 placeholder-[#A3A3B7] text-[#000000] focus:outline-none focus:ring-2 focus:ring-[#00AEB6]" />
                        <button type="button" id="togglePassword" class="absolute right-2 top-1/2 -translate-y-1/2">
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit -->
                <button
                    class="w-full bg-[#00426D] text-white font-semibold tracking-widest py-3 rounded-lg hover:bg-[#00AEB6] transition-colors"
                    type="submit">
                    MASUK
                </button>
            </form>

            <p class="text-[10px] text-[#A3A3B7] mt-8 max-w-[280px]">
                Dengan mengklik tombol Masuk, Anda setuju dengan Kebijakan Privasi kami.
            </p>
        </div>
    </div>

    <!-- ✅ SweetAlert untuk error login -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->has('email'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: '{{ $errors->first('email') }}',
                confirmButtonColor: '#00426D'
            });
        </script>
    @endif

    <!-- ✅ Script validasi input -->
    <script>
        const loginForm = document.getElementById('loginForm');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const emailStar = document.getElementById('emailStar');
        const passwordStar = document.getElementById('passwordStar');
        const emailInput = document.querySelector('#emailContainer input');
        const passwordInput = document.querySelector('#passwordContainer input');

        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();

            let valid = true;

            // Reset state
            emailStar.textContent = '';
            passwordStar.textContent = '';
            emailInput.classList.remove('border-red-500');
            passwordInput.classList.remove('border-red-500');
            emailInput.classList.add('border-[#D9D9E3]');
            passwordInput.classList.add('border-[#D9D9E3]');

            // Validasi email
            if (email.value.trim() === '') {
                emailStar.textContent = '✱';
                emailInput.classList.remove('border-[#D9D9E3]');
                emailInput.classList.add('border-red-500');
                valid = false;
            }

            // Validasi password
            if (password.value.trim() === '') {
                passwordStar.textContent = '✱';
                passwordInput.classList.remove('border-[#D9D9E3]');
                passwordInput.classList.add('border-red-500');
                valid = false;
            }

            if (valid) {
                loginForm.submit();
            }
        });

        // ✅ Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const toggleIcon = document.getElementById('toggleIcon');

        togglePassword.addEventListener('click', function () {
            const isPassword = password.getAttribute('type') === 'password';
            password.setAttribute('type', isPassword ? 'text' : 'password');

            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>