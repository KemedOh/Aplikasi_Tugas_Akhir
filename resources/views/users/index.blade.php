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
            <div class="w-full md:w-12/12">
<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Export Data</h3>
    <div class="flex flex-wrap gap-6 items-end">
        <!-- Filter Form Excel -->
        <form action="{{ route('users.exportExcel') }}" method="GET" class="flex flex-wrap gap-6 w-full sm:w-auto">
        <div class="w-full sm:w-auto">
            <label for="start_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Urut
                Mulai</label>
            <input type="number" name="start_number" id="excel_start_number" min="1"
                class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500"
                value="{{ old('start_number') }}" onchange="adjustExcelEndNumber()" />
        </div>
        
        <div class="w-full sm:w-auto">
            <label for="end_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Urut Akhir</label>
            <input type="number" name="end_number" id="excel_end_number" min="1"
                class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500"
                value="{{ old('end_number') }}" onchange="adjustExcelEndNumber()" />
        </div>


            <!-- Nama -->
            <div class="w-full sm:w-auto">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                <input type="text" name="name" id="name" placeholder="Masukkan Nama"
                    class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500" />
            </div>

            <!-- Jenis Kelamin -->
            <div class="w-full sm:w-auto">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                    Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin"
                    class="mt-1 border rounded px-3 py-2 w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <!-- Tanggal Mulai -->
            <div class="w-full sm:w-auto">
                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
                    Mulai</label>
                <input type="date" name="start_date" id="start_date"
                    class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500" />
            </div>

            <!-- Tanggal Akhir -->
            <div class="w-full sm:w-auto">
                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
                    Akhir</label>
                <input type="date" name="end_date" id="end_date"
                    class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500" />
            </div>

            <!-- Tombol Export -->
            <div class="w-full sm:w-auto mt-4">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow-md w-full sm:w-auto">
                    Export Excel
                </button>
            </div>
        </form>

        <!-- Export Semua Excel -->
        <a href="{{ route('users.export.excel') }}"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow-md w-full sm:w-auto">
            Export Semua Excel
        </a>

<form action="{{ route('users.export.pdf.filtered') }}" method="GET" class="flex flex-wrap gap-6 w-full sm:w-auto">
        <div class="w-full sm:w-auto">
            <label for="start_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Urut
                Mulai</label>
            <input type="number" name="start_number" id="pdf_start_number" min="1"
                class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500"
                value="{{ old('start_number') }}" onchange="adjustPdfEndNumber()" />
        </div>
        
        <div class="w-full sm:w-auto">
            <label for="end_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Urut Akhir</label>
            <input type="number" name="end_number" id="pdf_end_number" min="1"
                class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500"
                value="{{ old('end_number') }}" onchange="adjustPdfEndNumber()" />
        </div>

    <!-- Nama -->
    <div class="w-full sm:w-auto">
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
        <input type="text" name="name" id="name" placeholder="Masukkan Nama"
            class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500" />
    </div>

    <!-- Jenis Kelamin -->
    <div class="w-full sm:w-auto">
        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
            Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin"
            class="mt-1 border rounded px-3 py-2 w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <!-- Tanggal Mulai -->
    <div class="w-full sm:w-auto">
        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
            Mulai</label>
        <input type="date" name="start_date" id="start_date"
            class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500" />
    </div>

    <!-- Tanggal Akhir -->
    <div class="w-full sm:w-auto">
        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
            Akhir</label>
        <input type="date" name="end_date" id="end_date"
            class="mt-1 border border-gray-300 p-2 rounded-lg w-full sm:w-auto dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-green-500" />
    </div>

    <!-- Tombol Export -->
    <div class="w-full sm:w-auto mt-4">
        <button type="submit"
            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow-md w-full sm:w-auto">
            Export Pdf
        </button>
    </div>
</form>
        <!-- Export Semua PDF -->
        <a href="{{ route('users.export.pdf') }}"
            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded shadow-md w-full sm:w-auto">
            Export Semua PDF
        </a>
    </div>
</div>


                <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
                    <div class="bg-gray-200 dark:bg-gray-700 px-4 py-2">
                        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">{{ __('Daftar Pengguna') }}
                        </h3>
                    </div>
                    <div class="p-4">

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
                                            Timestamp</th>
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
                                                {{ $user->created_at ? $user->created_at->format('Y-m-d H:i:s') : '-' }}
                                            </td>
                                            <td class="border-b border-gray-300 px-4 py-2 text-gray-700 dark:text-gray-200">
                                                <button data-user='@json($user)' onclick="openEditModal(this)"
                                                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded">
                                                    Edit
                                                </button>                                              <form action="{{ route('users.destroy', $user->id) }}" method="POST"
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
<!-- Modal Edit User -->
<div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div
        class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-6 rounded-xl w-full max-w-lg relative shadow-lg transition-all duration-300">

        <button onclick="closeEditModal()" class="absolute top-3 right-3 text-gray-400 hover:text-red-500 text-xl">
            &times;
        </button>

        <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Edit User</h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 dark:bg-red-200 text-red-800 px-4 py-2 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}" class="space-y-3">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" id="editUserId">

            <!-- Nama -->
            <input type="text" name="name" id="editName" placeholder="Nama Lengkap"
                class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>

            <!-- Email -->
            <input type="email" name="email" id="editEmail" placeholder="Email"
                class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>

            <!-- Password -->
            <input type="password" name="password" placeholder="Password Lama atau Buat Baru"
                class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <!-- Konfirmasi Password -->
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <!-- Role -->
            <select id="editRole" name="role_id"
                class="w-full p-2 border rounded-md bg-white dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
                <option value="">-- Pilih Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                @endforeach
            </select>

            <!-- Field Tambahan Mahasiswa -->
            <div id="editMahasiswaFields" class="hidden">
                <input type="date" name="tanggal_lahir" id="editTanggalLahir"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>

                <select name="jenis_kelamin" id="editJenisKelamin"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>
                    <option value="">-- Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>

                <input type="text" name="asal_sekolah" id="editAsalSekolah" placeholder="Asal Sekolah"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>

                <input type="text" name="nomor_telepon" id="editNomorTelepon" placeholder="No. Telepon"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>

                <input type="text" name="nama_ayah" id="editNamaAyah" placeholder="Nama Ayah"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>

                <input type="text" name="nama_ibu" id="editNamaIbu" placeholder="Nama Ibu"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>

                <input type="text" name="nomor_telepon_ortu" id="editNomorTeleponOrtu" placeholder="No. Telepon Ortu"
                    class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600" required>
            </div>

            <!-- Button -->
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
<script>
    const editModal = document.getElementById('editModal');
    const editRole = document.getElementById('editRole');
    const editMahasiswaFields = document.getElementById('editMahasiswaFields');

    function openEditModal(button) {
        const user = JSON.parse(button.getAttribute('data-user'));

        // Mengisi data di form
        document.getElementById('editUserId').value = user.id;
        document.getElementById('editName').value = user.name;
        document.getElementById('editEmail').value = user.email;
        document.getElementById('editRole').value = user.role_id;

        // Untuk field mahasiswa
        document.getElementById('editTanggalLahir').value = user.tanggal_lahir || '';
        document.getElementById('editJenisKelamin').value = user.jenis_kelamin || '';
        document.getElementById('editAsalSekolah').value = user.asal_sekolah || '';
        document.getElementById('editNomorTelepon').value = user.nomor_telepon || '';
        document.getElementById('editNamaAyah').value = user.nama_ayah || '';
        document.getElementById('editNamaIbu').value = user.nama_ibu || '';
        document.getElementById('editNomorTeleponOrtu').value = user.nomor_telepon_ortu || '';

        // Menyesuaikan tampilan field Mahasiswa
        toggleMahasiswaFieldsEdit();

        // Tampilkan modal
        editModal.classList.remove('hidden');
    }

    function closeEditModal() {
        editModal.classList.add('hidden');
    }

    function toggleMahasiswaFieldsEdit() {
        const role = editRole.value;
        // Misalkan ID untuk 'Mahasiswa' adalah 1, kamu bisa sesuaikan dengan ID yang ada di database
        if (role === '1') { // Sesuaikan dengan ID 'Mahasiswa' di database
            editMahasiswaFields.classList.remove('hidden');
        } else {
            editMahasiswaFields.classList.add('hidden');
        }
    }
</script>
<script>
    function adjustExcelEndNumber() {
        let start = parseInt(document.getElementById("excel_start_number").value);
        let end = parseInt(document.getElementById("excel_end_number").value);
        if (end < start) {
            document.getElementById("excel_end_number").value = start;
        }
    }

    function adjustPdfEndNumber() {
        let start = parseInt(document.getElementById("pdf_start_number").value);
        let end = parseInt(document.getElementById("pdf_end_number").value);
        if (end < start) {
            document.getElementById("pdf_end_number").value = start;
        }
    }
</script>

</x-app-layout>