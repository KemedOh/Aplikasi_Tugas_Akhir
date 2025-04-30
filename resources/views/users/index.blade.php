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
                        <a href="#" id="openAddModalButton"
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
<div id="addUserModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div
        class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-6 rounded-xl w-full max-w-lg relative shadow-lg transition-all duration-300">

        <button onclick="closeAddUserModal()" class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-xl">
            &times;
        </button>

        <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Tambah User Baru</h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 dark:bg-red-200 text-red-800 px-4 py-2 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.store') }}" class="space-y-3">
            @csrf

            <input type="text" name="name" placeholder="Nama Lengkap"
                class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>

            <input type="email" name="email" placeholder="Email"
                class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>

            <input type="password" name="password" placeholder="Password"
                class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>

            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>

            <select id="addRole" name="role_id"
                class="w-full p-2 border rounded-md bg-white dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
                <option value="">-- Pilih Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                @endforeach
            </select>

            <div id="addFields" class="hidden">
                <input type="date" name="tanggal_lahir"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>

                <select name="jenis_kelamin" class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600"
                    required>
                    <option value="">-- Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>

                <input type="text" name="asal_sekolah" placeholder="Asal Sekolah"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>

                <input type="text" name="nomor_telepon" placeholder="No. Telepon"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>

                <input type="text" name="nama_ayah" placeholder="Nama Ayah"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>
                <input type="text" name="nama_ibu" placeholder="Nama Ibu"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>
                <input type="text" name="nomor_telepon_ortu" placeholder="No. Telepon Ortu"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addModal = document.getElementById('addUserModal');
        const openAddModalButton = document.getElementById('openAddModalButton');
        const addRole = document.getElementById('addRole');
        const addFields = document.getElementById('addFields');

        // Buka modal
        openAddModalButton.addEventListener('click', () => {
            addModal.classList.remove('hidden');
        });

        // Tutup modal via tombol (X)
        window.closeAddUserModal = function () {
            addModal.classList.add('hidden');
        };

        // Tampilkan field tambahan jika role = Mahasiswa
        function toggleAddFields() {
            const selectedText = addRole.options[addRole.selectedIndex].text.toLowerCase();
            if (selectedText === 'mahasiswa') {
                addFields.classList.remove('hidden');
            } else {
                addFields.classList.add('hidden');
            }
        }

        addRole.addEventListener('change', toggleAddFields);
        toggleAddFields(); // trigger saat load awal
    });
</script>

</x-app-layout>