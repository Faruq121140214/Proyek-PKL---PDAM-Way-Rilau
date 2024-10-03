@section('title', 'Beranda')

<div>
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-gray-700">
        <ol class="list-reset flex font-semibold">
            <li><img src="{{ asset('assets/img/icon/beranda.svg') }}" alt="beranda icon" class="w-7"></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="{{ route('admin.dashboard') }}" class="text-black-500">Dashboard</a></li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="bg-white p-6 rounded-lg shadow">
        <p class="text-black">
            Selamat datang website presensi Praktek Kerja Lapangan (PKL) PDAM Way Rilau.
        </p>
    </div>
</div>
