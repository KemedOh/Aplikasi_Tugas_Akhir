<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="max-w-6xl w-full bg-[#E6EEFF] rounded-3xl flex flex-col md:flex-row overflow-hidden">

            <!-- Left side form container -->
            <div class="bg-white md:w-1/2 p-8 sm:p-12 rounded-t-3xl md:rounded-tr-none md:rounded-l-3xl">
                <p class="text-xs font-semibold text-[#4B4B6B] uppercase mb-2 tracking-wide">
                    DAFTAR SEKARANG
                </p>
                <h1 class="text-3xl font-extrabold text-[#0B0B3B] mb-3 leading-tight">
                    Segera Daftar di Politeknik LP3I Tasikmalaya
                </h1>

                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="name">
                            Name
                        </label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                               class="w-full px-3 py-2 text-[#A9B0D6] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]"
                               required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="email">
                            E-Mail
                        </label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}"
                               class="w-full px-3 py-2 text-[#A9B0D6] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]"
                               required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="password">
                            Password
                        </label>
                        <input id="password" name="password" type="password"
                               class="w-full px-3 py-2 text-[#3B4BFF] placeholder-[#3B4BFF] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]"
                               required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="password_confirmation">
                            Confirm Password
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               class="w-full px-3 py-2 text-[#3B4BFF] placeholder-[#3B4BFF] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]"
                               required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="role_id">
                            Role
                        </label>
                        <select id="role_id" name="role_id"
                                class="block mt-1 w-full border-[#A9B0D6] focus:border-[#3B4BFF] focus:ring-[#3B4BFF] rounded-md shadow-sm text-black"
                                required>
                            <option value="">Pilih Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ ucfirst($role->role) }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                    </div>

                    <!-- Conditional Fields (shown when Role is 'Mahasiswa') -->
                    <div id="additional_fields" class="hidden">
                        <!-- Tanggal Lahir -->
                        <div>
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="tanggal_lahir">
                                Tanggal Lahir
                            </label>
                            <input id="tanggal_lahir" name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir') }}"
                                   class="w-full px-3 py-2 text-[#A9B0D6] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1">
                                Jenis Kelamin
                            </label>
                            <div class="flex items-center gap-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="L"
                                           {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} class="form-radio text-indigo-600">
                                    <span class="ml-2">Laki-Laki</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="P"
                                           {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} class="form-radio text-indigo-600">
                                    <span class="ml-2">Perempuan</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                        </div>

                        <!-- Asal Sekolah -->
                        <div>
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="asal_sekolah">
                                Asal Sekolah
                            </label>
                            <input id="asal_sekolah" name="asal_sekolah" type="text" value="{{ old('asal_sekolah') }}"
                                   class="w-full px-3 py-2 text-[#A9B0D6] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                            <x-input-error :messages="$errors->get('asal_sekolah')" class="mt-2" />
                        </div>

                        <!-- Nama Ayah -->
                        <div>
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="nama_ayah">
                                Nama Ayah
                            </label>
                            <input id="nama_ayah" name="nama_ayah" type="text" value="{{ old('nama_ayah') }}"
                                   class="w-full px-3 py-2 text-[#A9B0D6] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                            <x-input-error :messages="$errors->get('nama_ayah')" class="mt-2" />
                        </div>

                        <!-- Nama Ibu -->
                        <div>
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="nama_ibu">
                                Nama Ibu
                            </label>
                            <input id="nama_ibu" name="nama_ibu" type="text" value="{{ old('nama_ibu') }}"
                                   class="w-full px-3 py-2 text-[#A9B0D6] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                            <x-input-error :messages="$errors->get('nama_ibu')" class="mt-2" />
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="nomor_telepon">
                                Nomor Telepon
                            </label>
                            <input id="nomor_telepon" name="nomor_telepon" type="text" value="{{ old('nomor_telepon') }}"
                                   class="w-full px-3 py-2 text-[#A9B0D6] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                            <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2" />
                        </div>

                        <!-- Nomor Telepon Orang Tua -->
                        <div>
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="nomor_telepon_ortu">
                                Nomor Telepon Orang Tua
                            </label>
                            <input id="nomor_telepon_ortu" name="nomor_telepon_ortu" type="text" value="{{ old('nomor_telepon_ortu') }}"
                                   class="w-full px-3 py-2 text-[#A9B0D6] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                            <x-input-error :messages="$errors->get('nomor_telepon_ortu')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200"
                           href="{{ route('login') }}">
                            {{ __('Sudah Punya Akun?') }}
                        </a>

                        <x-primary-button class="ml-4">
                            {{ __('Daftar') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>

            <!-- Right side illustration container -->
            <div class="md:w-1/2 bg-[#E6EEFF] flex flex-col items-center justify-start p-8 sm:p-12 rounded-b-3xl md:rounded-bl-none md:rounded-r-3xl">
                <img class="max-w-full h-auto" src="https://storage.googleapis.com/a1aa/image/39f76a1f-5acf-4a5e-bca0-417fd2a74a44.jpg" alt="Illustration"/>
            </div>
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
