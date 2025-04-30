<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Pengguna') }}
        </h2>
    </x-slot>

    <!-- Menampilkan pesan error -->
    @if(session('error'))
        <div id="alert-error" class="p-4 rounded-lg mb-4 bg-red-100 border border-red-500 text-red-700 shadow-lg">
            <strong class="font-semibold">Error: </strong>{{ session('error') }}
        </div>
    @endif

    <div class="container mx-auto px-4 mt-4 mb-4">
        <div class="flex justify-center">
            <div class="w-full md:w-10/12">
                <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
                    <div class="bg-gray-200 dark:bg-gray-700 px-4 py-2">
                        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">{{ __('Daftar Pengguna') }}
                        </h3>
                    </div>
                    <div class="p-4">
                        <a href="#" id="openModalButton"
                            class="inline-block bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold py-2 px-4 rounded-xl shadow-md transition-all hover:scale-105">
                            Tambah User
                        </a>
                        <a href="{{ route('users.export.excel') }}"
                            class="inline-block bg-green-600 hover:bg-green-500 text-white text-sm font-semibold py-2 px-4 rounded-xl shadow-md transition-all hover:scale-105">
                            Export Excel
                        </a>

                        <a href="{{ route('users.export.pdf') }}"
                            class="inline-block bg-red-600 hover:bg-red-500 text-white text-sm font-semibold py-2 px-4 rounded-xl shadow-md transition-all hover:scale-105">
                            Export PDF
                        </a>

                        <!-- Tabel dengan scroll horizontal untuk responsif -->
                        <div class="overflow-x-auto">
                            <table
                                class="min-w-full mt-4 bg-white dark:bg-gray-900 border border-gray-200 rounded-xl shadow-sm">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                            No</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                            Nama</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                            Email</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                            Role</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                            Tanggal Lahir</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                            Jenis Kelamin</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                            Asal Sekolah</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                            Telepon</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                            Orang Tua</th>
                                        <th class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $index => $user)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <td class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                                {{ $index + 1 }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                                {{ $user->name }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                                {{ $user->email }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                                {{ $user->role->role }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                                {{ $user->tanggal_lahir }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                                {{ $user->jenis_kelamin }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                                {{ $user->asal_sekolah }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                                {{ $user->nomor_telepon }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                                {{ $user->nama_ayah }} & {{ $user->nama_ibu }}<br>
                                                <small
                                                    class="text-gray-500 dark:text-gray-400">{{ $user->nomor_telepon_ortu }}</small>
                                            </td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                                <a href="#"
                                                    class="edit-user-link inline-block bg-yellow-500 hover:bg-yellow-400 text-white text-sm font-semibold py-1 px-3 rounded-xl shadow-md transition-all hover:scale-105"
                                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}" data-role-id="{{ $user->role_id }}"
                                                    data-asal-sekolah="{{ $user->asal_sekolah }}"
                                                    data-tanggal-lahir="{{ $user->tanggal_lahir }}"
                                                    data-nomor-telepon="{{ $user->nomor_telepon }}"
                                                    data-nama-ayah="{{ $user->nama_ayah }}"
                                                    data-nama-ibu="{{ $user->nama_ibu }}"
                                                    data-nomor-telepon-ortu="{{ $user->nomor_telepon_ortu }}">
                                                    Edit
                                                </a>

                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="delete-user-link inline-block bg-red-500 hover:bg-red-400 text-white text-sm font-semibold py-1 px-3 rounded-xl shadow-md transition-all hover:scale-105">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Add User -->
<div id="addUserModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>
    <div class="modal-container bg-white rounded-lg w-full max-w-lg p-8">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="max-w-6xl w-full bg-[#E6EEFF] rounded-3xl flex flex-col md:flex-row overflow-hidden">

                <!-- Left side form container -->
                <div class="bg-white md:w-1/2 p-8 sm:p-12 rounded-t-3xl md:rounded-tr-none md:rounded-l-3xl">
                    <p class="text-xs font-semibold text-[#4B4B6B] uppercase mb-2 tracking-wide">
                        TAMBAH USER
                    </p>
                    <h1 class="text-3xl font-extrabold text-[#0B0B3B] mb-3 leading-tight">
                        Tambah User Baru
                    </h1>

                    <div class="space-y-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="name">
                                Name
                            </label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}"
                                   class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]"
                                   required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="email">
                                E-Mail
                            </label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}"
                                   class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]"
                                   required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Role -->
                        <div>
                            <label class="block text-[#3B3B5B] font-semibold text-sm mb-1" for="role_id">
                                Role
                            </label>
                            <select id="role_id" name="role_id"
                                    class="block mt-1 w-full border-[#A9B0D6] focus:border-[#3B4BFF] focus:ring-[#3B4BFF] rounded-md shadow-sm text-black"
                                    required>
                                <option value="1" {{ old('role_id') == 1 ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>Admin</option>
                                <option value="3" {{ old('role_id') == 3 ? 'selected' : '' }}>Operator</option>
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
                                       class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
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
                                        <span class="ml-2 text-black">Laki-Laki</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jenis_kelamin" value="P"
                                               {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} class="form-radio text-indigo-600">
                                        <span class="ml-2 text-black">Perempuan</span>
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
                                       class="w-full px-3 py-2 text-[#000000] placeholder-[#A9B0D6] rounded-md focus:outline-none border border-[#A9B0D6] focus-within:ring-2 focus-within:ring-[#3B4BFF]" />
                                <x-input-error :messages="$errors->get('asal_sekolah')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Tambah User') }}
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
    </div>
</div>

    <script>

        // Event listener untuk tombol Edit User
        document.querySelectorAll('.edit-user-link').forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const userId = link.getAttribute('data-id');
                const name = link.getAttribute('data-name');
                const email = link.getAttribute('data-email');
                const roleId = link.getAttribute('data-role-id');
                const asalSekolah = link.getAttribute('data-asal-sekolah');
                const tanggalLahir = link.getAttribute('data-tanggal-lahir');
                const nomorTelepon = link.getAttribute('data-nomor-telepon');
                const namaAyah = link.getAttribute('data-nama-ayah');
                const namaIbu = link.getAttribute('data-nama-ibu');
                const nomorTeleponOrtu = link.getAttribute('data-nomor-telepon-ortu');

                document.getElementById('user_id').value = userId;
                document.getElementById('name').value = name;
                document.getElementById('email').value = email;
                document.getElementById('role').value = roleId;

                document.getElementById('editModal').classList.remove('hidden');
            });
        });
    document.addEventListener("DOMContentLoaded", function () {
            let roleSelect = document.getElementById("role_id");
            let additionalFields = document.getElementById("additional_fields");
            let modal = document.getElementById("addUserModal");

            // Fungsi untuk menampilkan field tambahan saat role mahasiswa dipilih
            function toggleRoleFields() {
                let selectedRole = roleSelect.options[roleSelect.selectedIndex].text.toLowerCase();
                if (selectedRole === "mahasiswa") {
                    additionalFields.classList.remove("hidden");
                } else {
                    additionalFields.classList.add("hidden");
                }
            }

            roleSelect.addEventListener("change", toggleRoleFields);
            toggleRoleFields(); // Memastikan bahwa field tambahan muncul saat pertama kali load

            // Fungsi untuk membuka modal
            document.getElementById("openModalButton").addEventListener("click", function () {
                modal.classList.remove("hidden");
            });

            // Fungsi untuk menutup modal
            modal.querySelector(".modal-overlay").addEventListener("click", function () {
                modal.classList.add("hidden");
            });
        });


        // Close modal edit
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

         // Event listener untuk tombol Delete User
            document.querySelectorAll('.delete-user-link').forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Menanyakan konfirmasi sebelum menghapus
                    if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                        // Ambil URL form penghapusan
                        const form = button.closest('form');
                        const url = form.action;

                        // Gunakan fetch API untuk menghapus user
                        fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ _method: 'DELETE' })
                        })
                            .then(response => response.json()) // Response kosong
                            .then(() => {
                                location.reload(); // Refresh halaman setelah menghapus
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menghapus user.');
                            });
                    }
                });
            });
    </script>
</x-app-layout>