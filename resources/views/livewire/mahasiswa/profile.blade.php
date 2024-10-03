@section('title', 'Profile')

<div>
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-gray-700">
        <ol class="list-reset flex">
            <li><p class="text-black-500 font-bold text-2xl">Profile</p></li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="bg-white p-6 mb-3 shadow">
        <div class="text-xl flex items-center">
            <span class="mr-5 font-bold flex-shrink-0 w-40">
                Nama
            </span>
            <span class="mr-5 font-semibold">
                :
            </span>
            <span class="font-semibold">
                {{ $mahasiswa->nama }}
            </span>
        </div>
    </div>

    <div class="bg-white p-6 mb-3 shadow">
        <div class="text-xl flex items-center">
            <span class="mr-5 font-bold flex-shrink-0 w-40">
                Nomor Induk
            </span>
            <span class="mr-5 font-semibold">
                :
            </span>
            <span class="font-semibold">
                {{ $mahasiswa->npm }}
            </span>
        </div>
    </div>

    <div class="bg-white p-6 mb-3 shadow">
        <div class="text-xl flex items-center">
            <span class="mr-5 font-bold flex-shrink-0 w-40">
                Asal Instansi
            </span>
            <span class="mr-5 font-semibold">
                :
            </span>
            <span class="font-semibold">
                {{ $mahasiswa->instansi }}
            </span>
        </div>
    </div>
</div>
