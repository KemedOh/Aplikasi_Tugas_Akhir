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
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="inline-block bg-yellow-500 text-white text-sm font-semibold py-1 px-3 rounded hover:bg-yellow-400">
                                                    Edit
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display: inline"
                                                    onsubmit="return confirm('Apakah kamu yakin ingin menghapus {{ $user->name }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-block bg-red-500 text-white text-sm font-semibold py-1 px-3 rounded hover:bg-red-400">
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
        new DataTable('#usersTable');
    </script>
</x-app-layout>