<!DOCTYPE html>
<html>

<head>
    <title>Data Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2 align="center">Data Users</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Asal Sekolah</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>No. Telepon</th>
                <th>No. Telepon Ortu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Menampilkan nomor urut -->
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->tanggal_lahir }}</td>
                    <td>{{ $user->jenis_kelamin }}</td>
                    <td>{{ $user->asal_sekolah }}</td>
                    <td>{{ $user->nama_ayah }}</td>
                    <td>{{ $user->nama_ibu }}</td>
                    <td>{{ $user->nomor_telepon }}</td>
                    <td>{{ $user->nomor_telepon_ortu }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>