@section('title', 'Absensi')

<div>
    @if (session()->has('error'))
        <div class="h-screen flex justify-center items-center">
            <p class="text-2xl font-bold">
                Absensi hanya dapat dilakukan di jam 07:00 - 07:59 WIB
            </p>
        </div>
    @else
        <!-- Breadcrumb -->
        <nav class="flex mb-6 text-gray-700">
            <ol class="list-reset flex">
                <li><p class="text-black-500 font-bold text-2xl">Absensi</p></li>
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

        <div class="bg-white p-6 mb-3 shadow">
            <div class="text-xl flex items-center">
                <span class="mr-5 font-bold flex-shrink-0 w-40">
                    Tanggal
                </span>
                <span class="mr-5 font-semibold">
                    :
                </span>
                <span class="font-semibold">
                    {{ $today }}
                </span>
            </div>
        </div>

        <div class="bg-white p-6 mb-10 shadow">
            <div class="text-xl flex items-center">
                <span class="mr-5 font-bold flex-shrink-0 w-40">
                    Status
                </span>
                <span class="mr-5 font-semibold">
                    :
                </span>
                @if ($status == "belum absen")

                    <span class="bg-red-600 text-white py-2 px-4 rounded-full">
                        Belum Absen
                    </span>

                @elseif ($status == "hadir")

                    <span class="bg-green-600 text-white py-2 px-4 rounded-full">
                        Hadir
                    </span>

                @elseif ($status == "izin")

                    <span class="bg-orange-600 text-white py-2 px-4 rounded-full">
                        Izin
                    </span>

                @elseif ($status == "tidak hadir")

                    <span class="bg-red-600 text-white py-2 px-4 rounded-full">
                        Tidak Hadir
                    </span>

                @endif
            </div>
        </div>

        @if ($status == "belum absen")
            <div>
                <button wire:click="absen" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fa-solid fa-floppy-disk"></i> Absen
                </button>
            </div>
        @endif
    
    @endif
    
</div>