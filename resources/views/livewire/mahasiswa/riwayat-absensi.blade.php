@section('title', 'Riwayat Absensi')

<div>
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-gray-700">
        <ol class="list-reset flex">
            <li><p class="text-black-500 font-bold text-2xl">Riwayat Absensi</p></li>
        </ol>
    </nav>

    <!-- Main Content -->

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-end mb-4">
            <a href="{{ route('mahasiswa.riwayat-absensi.print') }}" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded">
                <i class="fa-solid fa-print"></i> Cetak PDF
            </a>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100">
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
                    <tr class="text-center">
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
    </div>
</div>
