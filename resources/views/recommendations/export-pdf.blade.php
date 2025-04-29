<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Rekomendasi User</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <h2>Daftar Hasil Rekomendasi User</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Sangat Direkomendasikan</th>
                <th>Cukup Direkomendasikan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->nomor_telepon ?? '-' }}</td>
                    <td>{{ $user->recommendations->where('level', 'sangat_direkomendasikan')->first()?->major?->name ?? '-' }}
                    </td>
                    <td>{{ $user->recommendations->where('level', 'cukup_direkomendasikan')->first()?->major?->name ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>