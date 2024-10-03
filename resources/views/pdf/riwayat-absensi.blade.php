<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Absensi</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body class="bg-white">
    <h2 class="text-2xl font-bold mb-4">Riwayat Absensi</h2>
    <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
    <p><strong>NPM:</strong> {{ $mahasiswa->npm }}</p>
    <p><strong>Asal Instansi:</strong> {{ $mahasiswa->instansi }}</p>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4">No</th>
                <th class="py-2 px-4">Nama</th>
                <th class="py-2 px-4">Instansi</th>
                <th class="py-2 px-4">Status</th>
                <th class="py-2 px-4">Waktu</th>
                <th class="py-2 px-4">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $absensi)
                <tr>
                    <td class="py-2 px-4">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4">{{ $absensi->nama }}</td>
                    <td class="py-2 px-4">{{ $absensi->instansi }}</td>
                    <td class="py-2 px-4">{{ $absensi->status }}</td>
                    <td class="py-2 px-4">{{ $absensi->waktu }}</td>
                    <td class="py-2 px-4">{{ $absensi->tanggal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
