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
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-200 px-4 py-2">
                        <h3 class="font-semibold text-lg">{{ __('Daftar Pengguna') }}</h3>
                    </div>
                    <div class="p-4">
                        <a href="#" id="openModal"
                            class="inline-block bg-blue-600 text-white text-sm font-semibold py-2 px-4 rounded hover:bg-blue-500">
                            Tambah User
                        </a>
                        <a href="{{ route('users.export.excel') }}"
                            class="inline-block bg-green-600 text-white text-sm font-semibold py-2 px-4 rounded hover:bg-green-500">
                            Export Excel
                        </a>

                        <a href="{{ route('users.export.pdf') }}"
                            class="inline-block bg-red-600 text-white text-sm font-semibold py-2 px-4 rounded hover:bg-red-500">
                            Export PDF
                        </a>

                        <!-- Tabel dengan scroll horizontal untuk responsif -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full mt-4 bg-white border border-gray-300" id="usersTable">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border-b border-gray-300 px-4 py-2">No</th>
                                        <th class="border-b border-gray-300 px-4 py-2">Nama</th>
                                        <th class="border-b border-gray-300 px-4 py-2">Email</th>
                                        <th class="border-b border-gray-300 px-4 py-2">Role</th>
                                        <th class="border-b border-gray-300 px-4 py-2">Tanggal Lahir</th>
                                        <th class="border-b border-gray-300 px-4 py-2">Jenis Kelamin</th>
                                        <th class="border-b border-gray-300 px-4 py-2">Asal Sekolah</th>
                                        <th class="border-b border-gray-300 px-4 py-2">Telepon</th>
                                        <th class="border-b border-gray-300 px-4 py-2">Orang Tua</th>
                                        <th class="border-b border-gray-300 px-4 py-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $index => $user)
                                        <tr class="hover:bg-gray-100">
                                            <td class="border-b border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2">{{ $user->role->role }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2">{{ $user->tanggal_lahir }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2">{{ $user->jenis_kelamin }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2">{{ $user->asal_sekolah }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2">{{ $user->nomor_telepon }}</td>
                                            <td class="border-b border-gray-300 px-4 py-2">
                                                {{ $user->nama_ayah }} & {{ $user->nama_ibu }}<br>
                                                <small class="text-gray-500">{{ $user->nomor_telepon_ortu }}</small>
                                            </td>
                                            <td class="border-b border-gray-300 px-4 py-2">
                                                <a href="#" class="edit-user-link inline-block bg-yellow-500 text-white text-sm font-semibold py-1 px-3 rounded hover:bg-yellow-400" data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}" data-role-id="{{ $user->role_id }}" data-asal-sekolah="{{ $user->asal_sekolah }}"
                                                    data-tanggal-lahir="{{ $user->tanggal_lahir }}" data-nomor-telepon="{{ $user->nomor_telepon }}"
                                                    data-nama-ayah="{{ $user->nama_ayah }}" data-nama-ibu="{{ $user->nama_ibu }}"  data-nomor-telepon-ortu="{{ $user->nomor_telepon_ortu }}">
                                                    Edit
                                                </a>

                                                <a href="#"
                                                    class="delete-user-link inline-block bg-red-500 text-white text-sm font-semibold py-1 px-3 rounded hover:bg-red-400"
                                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                                    Hapus
                                                </a>
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

    <!-- Modal Tambah User -->
    <div id="userModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-semibold mb-4">Tambah Pengguna</h2>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" required
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" id="email" name="email" required
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Password Confirmation</label>
                    <input type="password_confirmation" id="password_confirmation" name="password_confirmation" required
                        class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="role_id" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role_id" name="role_id" class="block mt-1 w-full" required>
                        <option value="" disabled selected>Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" id="closeModal" class="mr-2 px-4 py-2 border rounded-md">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div id="editUserModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Edit User</h2>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
    
                <input type="hidden" id="editUserId" name="id">
    
                <!-- Nama -->
                <div class="mb-4">
                    <label for="editName" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="editName" name="name" class="block mt-1 w-full border rounded p-2" required>
                </div>
    
                <!-- Email -->
                <div class="mb-4">
                    <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="editEmail" name="email" class="block mt-1 w-full border rounded p-2" required>
                </div>
    
                <!-- Role (Dropdown dari Database) -->
                <div class="mb-4">
                    <label for="editRole" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="editRole" name="role_id" class="block mt-1 w-full border rounded p-2" required>
                        <option value="" disabled>Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>
    
                <!-- Field Tambahan untuk Mahasiswa -->
                <div id="extraFieldsMahasiswa" class="hidden">
                    <div class="mb-4">
                        <label for="editAsalSekolah" class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
                        <input type="text" id="editAsalSekolah" name="asal_sekolah"
                            class="block mt-1 w-full border rounded p-2">
                    </div>
    
                    <div class="mb-4">
                        <label for="editTanggalLahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" id="editTanggalLahir" name="tanggal_lahir"
                            class="block mt-1 w-full border rounded p-2">
                    </div>
    
                    <div class="mb-4">
                        <label for="editNomorTelepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" id="editNomorTelepon" name="nomor_telepon"
                            class="block mt-1 w-full border rounded p-2">
                    </div>
    
                    <div class="mb-4">
                        <label for="editNamaAyah" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                        <input type="text" id="editNamaAyah" name="nama_ayah" class="block mt-1 w-full border rounded p-2">
                    </div>
    
                    <div class="mb-4">
                        <label for="editNamaIbu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                        <input type="text" id="editNamaIbu" name="nama_ibu" class="block mt-1 w-full border rounded p-2">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="editNomorTeleponOrtu" class="block text-sm font-medium text-gray-700">Nomor Telepon Orang Tua</label>
                    <input type="text" id="editNomorTeleponOrtu" name="nomor_telepon_ortu" class="block mt-1 w-full border rounded p-2">
                </div>
    
                <!-- Tombol Submit -->
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Update</button>
    
                <!-- Tombol Batal -->
                <button type="button" id="closeEditModal"
                    class="w-full mt-2 bg-gray-400 text-white py-2 rounded">Batal</button>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteUserModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-semibold mb-4">Hapus Pengguna</h2>
            <p>Apakah kamu yakin ingin menghapus <strong id="deleteUserName"></strong>?</p>
            <form id="deleteUserForm" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" id="deleteUserId">
                <div class="flex justify-end mt-4">
                    <button type="button" id="closeDeleteModal" class="mr-2 px-4 py-2 border rounded-md">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('openModal').addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById('userModal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function () {
            document.getElementById('userModal').classList.add('hidden');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editUserModal');
            const editForm = document.getElementById('editUserForm');
            const editRole = document.getElementById('editRole');
            const extraFieldsMahasiswa = document.getElementById('extraFieldsMahasiswa');

            // Event ketika klik tombol Edit
            document.querySelectorAll('.edit-user-link').forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();

                    // Ambil data user
                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name');
                    const userEmail = this.getAttribute('data-email');
                    const userRole = this.getAttribute('data-role-id');

                    // Isi form modal
                    document.getElementById('editUserId').value = userId;
                    document.getElementById('editName').value = userName;
                    document.getElementById('editEmail').value = userEmail;
                    document.getElementById('editRole').value = userRole;

                    // Cek apakah role adalah Mahasiswa (ID 3, sesuaikan dengan database)
                    toggleMahasiswaFields(userRole);

                    // Isi field Mahasiswa jika ada
                    document.getElementById('editAsalSekolah').value = this.getAttribute('data-asal-sekolah') || '';
                    document.getElementById('editTanggalLahir').value = this.getAttribute('data-tanggal-lahir') || '';
                    document.getElementById('editNomorTelepon').value = this.getAttribute('data-nomor-telepon') || '';
                    document.getElementById('editNamaAyah').value = this.getAttribute('data-nama-ayah') || '';
                    document.getElementById('editNamaIbu').value = this.getAttribute('data-nama-ibu') || '';
                    document.getElementById('editNomorTeleponOrtu').value = this.getAttribute('data-nomor-telepon-ortu') || '';

                    // Set action pada form
                    editForm.action = `/users/${userId}`;

                    // Tampilkan modal
                    editModal.classList.remove('hidden');
                });
            });

            // Event listener untuk perubahan role
            editRole.addEventListener('change', function () {
                toggleMahasiswaFields(this.value);
            });

            // Fungsi untuk menampilkan field Mahasiswa jika role Mahasiswa dipilih
            function toggleMahasiswaFields(roleId) {
                if (roleId === '1') {
                    extraFieldsMahasiswa.classList.remove('hidden');
                } else {
                    extraFieldsMahasiswa.classList.add('hidden');
                }
            }

            // Event untuk menutup modal
            document.getElementById('closeEditModal').addEventListener('click', function () {
                editModal.classList.add('hidden');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal = document.getElementById('deleteUserModal');
            // Event untuk Hapus User
            document.querySelectorAll('.delete-user-link').forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault(); // Mencegah halaman reload

                    const userId = this.getAttribute('data-id');
                    const userName = this.getAttribute('data-name');

                    document.getElementById('deleteUserId').value = userId;
                    document.getElementById('deleteUserName').textContent = userName;

                    deleteModal.classList.remove('hidden');
                });
            });

            document.getElementById('closeDeleteModal').addEventListener('click', function () {
                deleteModal.classList.add('hidden');
            });

            document.getElementById('deleteUserForm').addEventListener('submit', function (event) {
                event.preventDefault();

                const userId = document.getElementById('deleteUserId').value;

                fetch(`/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    }
                }).then(response => response.json())
                    .then(data => {
                        alert('User berhasil dihapus!');
                        location.reload();
                    }).catch(error => {
                        alert('Terjadi kesalahan.');
                    });
            });
        });
    </script>


    <script>
        new DataTable('#usersTable');
    </script>
</x-app-layout>