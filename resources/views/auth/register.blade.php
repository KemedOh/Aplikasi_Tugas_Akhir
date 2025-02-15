<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role_id" :value="__('Role')" />
            <select id="role_id" name="role_id"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required>
                <option value="">Pilih Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->role) }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
        </div>

        <!-- Tanggal Lahir -->
        <div id="tanggal_lahir_container" class="mt-4 hidden">
            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
            <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir"
                :value="old('tanggal_lahir')" />
            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
        </div>

        <!-- Jenis Kelamin -->
        <div id="jenis_kelamin_container" class="mt-4 hidden">
            <x-input-label :value="__('Jenis Kelamin')" />
            <div class="flex items-center gap-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}
                        class="form-radio text-indigo-600">
                    <span class="ml-2">Laki-Laki</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}
                        class="form-radio text-indigo-600">
                    <span class="ml-2">Perempuan</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
        </div>

        <!-- Asal Sekolah -->
        <div id="asal_sekolah_container" class="mt-4 hidden">
            <x-input-label for="asal_sekolah" :value="__('Asal Sekolah')" />
            <x-text-input id="asal_sekolah" class="block mt-1 w-full" type="text" name="asal_sekolah"
                :value="old('asal_sekolah')" />
            <x-input-error :messages="$errors->get('asal_sekolah')" class="mt-2" />
        </div>

        <!-- Nama Ayah -->
        <div id="nama_ayah_container" class="mt-4 hidden">
            <x-input-label for="nama_ayah" :value="__('Nama Ayah')" />
            <x-text-input id="nama_ayah" class="block mt-1 w-full" type="text" name="nama_ayah" :value="old('nama_ayah')" />
            <x-input-error :messages="$errors->get('nama_ayah')" class="mt-2" />
        </div>

        <!-- Nama Ibu -->
        <div id="nama_ibu_container" class="mt-4 hidden">
            <x-input-label for="nama_ibu" :value="__('Nama Ibu')" />
            <x-text-input id="nama_ibu" class="block mt-1 w-full" type="text" name="nama_ibu" :value="old('nama_ibu')" />
            <x-input-error :messages="$errors->get('nama_ibu')" class="mt-2" />
        </div>

        <!-- Nomor Telepon -->
        <div id="nomor_telepon_container" class="mt-4 hidden">
            <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" />
            <x-text-input id="nomor_telepon" class="block mt-1 w-full" type="text" name="nomor_telepon" :value="old('nomor_telepon')" />
            <x-input-error :messages="$errors->get('nomor_telepon')" class="mt-2" />
        </div>

        <!-- Nomor Telepon Orang Tua -->
        <div id="nomor_telepon_ortu_container" class="mt-4 hidden">
            <x-input-label for="nomor_telepon_ortu" :value="__('Nomor Telepon Orang Tua')" />
            <x-text-input id="nomor_telepon_ortu" class="block mt-1 w-full" type="text" name="nomor_telepon_ortu" :value="old('nomor_telepon_ortu')" />
            <x-input-error :messages="$errors->get('nomor_telepon_ortu')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let roleSelect = document.getElementById("role_id");
        let tanggalLahirContainer = document.getElementById("tanggal_lahir_container");
        let jenisKelaminContainer = document.getElementById("jenis_kelamin_container");
        let asalSekolahContainer = document.getElementById("asal_sekolah_container");
        let namaAyahContainer = document.getElementById("nama_ayah_container");
        let namaIbuContainer = document.getElementById("nama_ibu_container");
        let nomorTeleponContainer = document.getElementById("nomor_telepon_container");
        let nomorTeleponOrtuContainer = document.getElementById("nomor_telepon_ortu_container");

        function toggleMahasiswaFields() {
            let selectedRole = roleSelect.options[roleSelect.selectedIndex].text.toLowerCase();
            if (selectedRole === "mahasiswa") {
                tanggalLahirContainer.classList.remove("hidden");
                jenisKelaminContainer.classList.remove("hidden");
                asalSekolahContainer.classList.remove("hidden");
                namaAyahContainer.classList.remove("hidden");
                namaIbuContainer.classList.remove("hidden");
                nomorTeleponContainer.classList.remove("hidden");
                nomorTeleponOrtuContainer.classList.remove("hidden");
            } else {
                tanggalLahirContainer.classList.add("hidden");
                jenisKelaminContainer.classList.add("hidden");
                asalSekolahContainer.classList.add("hidden");
                namaAyahContainer.classList.add("hidden");
                namaIbuContainer.classList.add("hidden");
                nomorTeleponContainer.classList.add("hidden");
                nomorTeleponOrtuContainer.classList.add("hidden");
            }
        }

        roleSelect.addEventListener("change", toggleMahasiswaFields);
        toggleMahasiswaFields(); // Panggil sekali saat halaman dimuat
    });
</script>