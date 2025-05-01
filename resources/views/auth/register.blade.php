<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="max-w-6xl w-full bg-[#E6EEFF] rounded-3xl flex flex-col overflow-hidden">

            <!-- Left side form container -->
            <div class="bg-white p-8 sm:p-12 rounded-t-3xl">
                <p class="text-xs font-semibold text-[#4B4B6B] uppercase mb-2 tracking-wide">
                    DAFTAR SEKARANG
                </p>
                <h1 class="text-3xl font-extrabold text-[#0B0B3B] mb-3 leading-tight">
                    Segera Daftar di JuruAI Politeknik LP3I Kampus Tasikmalaya
                </h1>

                <div class="space-y-6">
                    <!-- Name and Email fields in row -->
                    <div class="flex space-x-6">
                        <div class="flex-1">
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="name">
                                Nama
                            </label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}"
                                class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]"
                                required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex-1">
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="email">
                                E-Mail
                            </label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}"
                                class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]"
                                required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Password and Confirm Password fields in row -->
                    <div class="flex space-x-6">
                        <div class="flex-1">
                            <label for="password"
                                class="block text-sm font-semibold text-[#00426D] mb-1 flex items-center gap-1">
                                Password <span id="passwordStar" class="text-red-500 text-lg"></span>
                            </label>
                            <div class="relative">
                                <input id="password" name="password" type="password" placeholder="****************"
                                    autocomplete="new-password" required
                                    class="w-full border border-[#D9D9E3] rounded-lg py-3 px-4 pr-12 placeholder-[#A3A3B7] text-[#000000] focus:outline-none focus:ring-2 focus:ring-[#00AEB6]" />
                                <button type="button" id="togglePassword"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600">
                                    <i id="toggleIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex-1">
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-[#00426D] mb-1 flex items-center gap-1">
                                Konfirmasi Password <span id="confirmPasswordStar" class="text-red-500 text-lg"></span>
                            </label>
                            <div class="relative">
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    placeholder="****************" autocomplete="new-password" required
                                    class="w-full border border-[#D9D9E3] rounded-lg py-3 px-4 pr-12 placeholder-[#A3A3B7] text-[#000000] focus:outline-none focus:ring-2 focus:ring-[#00AEB6]" />
                                <button type="button" id="toggleConfirmPassword"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-600">
                                    <i id="toggleConfirmIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Role selection (hidden) -->
                    <div class="hidden">
                        <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="role_id">
                            Role
                        </label>
                        <select id="role_id" name="role_id"
                            class="block mt-1 w-full border-[#A9B0D6] focus:border-[#3B4BFF] focus:ring-[#3B4BFF] rounded-md shadow-sm text-black"
                            required>
                            <option value="1" {{ old('role_id') == 1 ? 'selected' : '' }}>Mahasiswa</option>
                        </select>
                        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                    </div>

                    <!-- Conditional Fields (shown when Role is 'Mahasiswa') -->
                    <div id="additional_fields" class="hidden">
                        <div class="space-y-6">
                            <!-- Date of Birth and Gender -->
                            <div class="flex space-x-6">
                                <div class="flex-1">
                                    <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="tanggal_lahir">
                                        Tanggal Lahir
                                    </label>
                                    <input id="tanggal_lahir" name="tanggal_lahir" type="date"
                                        value="{{ old('tanggal_lahir') }}"
                                        class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                                    <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                                </div>

                                <div class="flex-1">
                                    <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="jenis_kelamin">
                                        Jenis Kelamin
                                    </label>
                                    <select id="jenis_kelamin" name="jenis_kelamin"
                                        class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]">
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-Laki
                                        </option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                    <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                                </div>
                            </div>

                            <!-- School and Phone number -->
                            <div class="flex space-x-6">
                                <div class="flex-1">
                                    <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="asal_sekolah">
                                        Asal Sekolah
                                    </label>
                                    <input id="asal_sekolah" name="asal_sekolah" type="text"
                                        value="{{ old('asal_sekolah') }} "
                                        class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                                    <x-input-error :messages="$errors->get('asal_sekolah')" class="mt-2" />
                                </div>

                                <div class="flex-1">
                                    <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="nomor_telepon">
                                        Nomor Telepon
                                    </label>
                                    <input id="nomor_telepon" name="nomor_telepon" type="text"
                                        value="{{ old('nomor_telepon') }}"
                                        class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                                    <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Parent Names and Phone Number -->
                            <div class="flex space-x-6">
                                <div class="flex-1">
                                    <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="nama_ayah">
                                        Nama Ayah
                                    </label>
                                    <input id="nama_ayah" name="nama_ayah" type="text" value="{{ old('nama_ayah') }} "
                                        class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                                    <x-input-error :messages="$errors->get('nama_ayah')" class="mt-2" />
                                </div>
                                <div class="flex-1">
                                    <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="nama_ibu">
                                        Nama Ibu
                                    </label>
                                    <input id="nama_ibu" name="nama_ibu" type="text" value="{{ old('nama_ibu') }}"
                                        class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                                    <x-input-error :messages="$errors->get('nama_ibu')" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex space-x-12">
                                <div class="flex-1">
                                    <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="nomor_telepon_ortu">
                                        Nomor Telepon Orang Tua
                                    </label>
                                    <input id="nomor_telepon_ortu" name="nomor_telepon_ortu" type="text" value="{{ old('nomor_telepon_ortu') }}"
                                        class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                                    <x-input-error :messages="$errors->get('nomor_ibu')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Submit Button -->
        <div class="flex flex-col md:flex-row items-center justify-between mt-6 gap-4 w-full">
            <x-primary-button class="w-full md:flex-1 flex items-center justify-center px-6 py-2">
                {{ __('Daftar') }}
            </x-primary-button>
        
            <p class="w-full md:flex-1 text-sm text-[#ffffff] text-center md:text-right">
                Kamu Sudah Memiliki Akun?
                <a class="text-[#484848] font-semibold hover:underline" href="{{ route('login') }}">
                    Login Sekarang
                </a>
            </p>
        </div>

    </form>
</x-guest-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let roleSelect = document.getElementById("role_id");
        let additionalFields = document.getElementById("additional_fields");

        function toggleRoleFields() {
            let selectedRole = roleSelect.options[roleSelect.selectedIndex].text.toLowerCase();
            if (selectedRole === "mahasiswa") {
                additionalFields.classList.remove("hidden");
            } else {
                additionalFields.classList.add("hidden");
            }
        }

        roleSelect.addEventListener("change", toggleRoleFields);
        toggleRoleFields(); // Ensure fields are toggled on initial load
    });
</script>
<script>
    // Toggle password visibility
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIcon");

    togglePassword.addEventListener("click", () => {
        const type = passwordInput.type === "password" ? "text" : "password";
        passwordInput.type = type;
        toggleIcon.classList.toggle("fa-eye");
        toggleIcon.classList.toggle("fa-eye-slash");
    });

    // Toggle confirm password
    const toggleConfirm = document.getElementById("toggleConfirmPassword");
    const confirmInput = document.getElementById("password_confirmation");
    const toggleConfirmIcon = document.getElementById("toggleConfirmIcon");

    toggleConfirm.addEventListener("click", () => {
        const type = confirmInput.type === "password" ? "text" : "password";
        confirmInput.type = type;
        toggleConfirmIcon.classList.toggle("fa-eye");
        toggleConfirmIcon.classList.toggle("fa-eye-slash");
    });

    // Visual error if empty
    const requiredInputs = [passwordInput, confirmInput];
    requiredInputs.forEach(input => {
        input.addEventListener("blur", () => {
            if (!input.value.trim()) {
                input.classList.add("border-red-500", "ring-red-500");
            } else {
                input.classList.remove("border-red-500", "ring-red-500");
            }
        });
    });
</script>


