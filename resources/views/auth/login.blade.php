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
        <div class="md:w-1/2 p-6 md:p-10 flex flex-col justify-center relative">
            <img alt="Politeknik LP3I Tasikmalaya Logo" class="w-32 md:w-40 lg:w-48 h-auto mb-8"
                src="{{ asset('images/logoLP3Iwarna.png') }}" />

            <img alt="Illustration of Politeknik campus" class="w-full max-w-[420px] object-contain"
                src="https://storage.googleapis.com/a1aa/image/0493f928-7f91-46bc-2f53-6579c2f211d2.jpg" />
        </div>

        <div class="md:w-1/2 bg-white rounded-tr-[24px] rounded-br-[24px] p-6 md:p-10 flex flex-col justify-center">
            <p class="text-xs font-semibold text-[#00426D] mb-1 tracking-widest">
                MASUKKAN AKUN ANDA
            </p>
            <h1 class="text-3xl font-extrabold text-[#0B0B3B] mb-2">
                Login ke JuruAI Politeknik LP3I Tasikmalaya
            </h1>
            <p class="text-sm text-[#8B8B9A] mb-8">
                Belum punya akun?
                <a class="text-[#00426D] font-semibold hover:underline" href="{{ route('register') }}">
                    Daftar Sekarang.
                </a>
            </p>
            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-[#00426D] mb-1" for="email">E-Mail</label>
                    <div class="relative">
                        <input
                            class="w-full border border-[#D9D9E3] rounded-lg py-3 px-4 pr-12 text-[#000000] placeholder-[#A3A3B7] focus:outline-none focus:ring-2 focus:ring-[#00AEB6]"
                            id="email" placeholder="youremail@lp3i.ac.id" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <i class="fa-solid fa-envelope absolute right-4 top-1/2 -translate-y-1/2 text-[#A3A3B7]"></i>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-[#00426D] mb-1" for="password">Password</label>
                    <div class="relative">
                        <input
                            class="w-full border border-[#D9D9E3] rounded-lg py-3 px-4 pr-12 text-[#000000] placeholder-[#A3A3B7] focus:outline-none focus:ring-2 focus:ring-[#00AEB6]"
                            id="password" placeholder="****************" type="password" name="password" required
                            autocomplete="current-password" />

                        <!-- Tombol Toggle -->
                        <button type="button" id="togglePassword" class="absolute right-2 top-1/2 -translate-y-1/2">
                            <i class="fas fa-eye" id="toggleIcon"></i>
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

    <!-- ✅ Toggle Password -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');
        const toggleIcon = document.querySelector('#toggleIcon');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordField.getAttribute('type') === 'password';
            passwordField.setAttribute('type', isPassword ? 'text' : 'password');

            // Ganti icon
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>