@section('title', 'Beranda')

<div x-data="{ isModalOpen: false, isUpdateModalOpen: @entangle('isUpdateModalOpen')}">
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-gray-700">
        <ol class="list-reset flex">
            <li><p class="text-black-500 font-bold text-2xl">Absensi Mahasiswa</p></li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="bg-white p-6 rounded-lg shadow mb-5" x-data="{ isUpdateModalOpen: @entangle('isUpdateModalOpen') }" x-cloak>
        <form wire:submit.prevent="search">
            <div class="flex justify-center items-center gap-28 px-24">
                <div class="flex gap-5 justify-center items-center">
                    <label for="namaSearch" class="block text-gray-700 font-bold">Nama</label>
                    <input type="text" wire:model="namaSearch" placeholder="nama mahasiswa..." class="w-full px-4 py-2 border
                    border-gray-300 rounded-md">
                    @error('namaSearch')
                        <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-5 justify-center items-center">
                    <label for="tanggalAwal" class="block text-gray-700 font-bold w-44">Tanggal Awal</label>
                    <input type="date" wire:model="tanggalAwal" placeholder="nama mahasiswa..." class="w-full px-4 py-2 border
                    border-gray-300 rounded-md">
                    @error('tanggalAwal')
                        <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-5 justify-center items-center">
                    <label for="tanggalAkhir" class="block text-gray-700 font-bold w-52">Tanggal Akhir</label>
                    <input type="date" wire:model="tanggalAkhir" placeholder="nama mahasiswa..." class="w-full px-4 py-2 border
                    border-gray-300 rounded-md">
                    @error('tanggalAkhir')
                        <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end mt-5">
                <button type="submit" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-md"><i class="fa-solid fa-magnifying-glass">
                    </i> Cari
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-start mb-10" x-data="{ showButtonClear: @entangle('showButtonClear')}" x-cloak>
            <div>
                <button wire:click="clearSearch" x-show="showButtonClear" class="bg-red-600 text-white px-4 py-2 rounded-md">
                    Clear
                </button>
            </div>
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
                    <th class="py-2 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $absensi)
                    <tr class="text-center">
                        <td class="py-2 px-4">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4">{{ $absensi->nama }}</td>
                        <td class="py-2 px-4">{{ $absensi->instansi }}</td>
                        <td class="py-2 px-4">
                            @if ($absensi->status == "belum absen")

                                <span class="bg-red-600 text-white py-2 px-4 rounded-full">
                                    Belum Absen
                                </span>

                            @elseif ($absensi->status == "hadir")

                                <span class="bg-green-600 text-white py-2 px-4 rounded-full">
                                    Hadir
                                </span>

                            @elseif ($absensi->status == "izin")

                                <span class="bg-orange-600 text-white py-2 px-4 rounded-full">
                                    Izin
                                </span>

                            @elseif ($absensi->status == "tidak hadir")

                                <span class="bg-red-600 text-white py-2 px-4 rounded-full">
                                    Tidak Hadir
                                </span>

                            @endif
                        </td>
                        <td class="py-2 px-4">{{ $absensi->waktu }}</td>
                        <td class="py-2 px-4">{{ $absensi->tanggal }}</td>
                        <td class="py-2 px-4">
                            <button wire:click="edit({{ $absensi->id }})" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-md">
                                <i class="fa-solid fa-pen-to-square"></i> Ubah Status
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- modal update -->
    <div x-show="isUpdateModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-40">
        <div @click.away="isUpdateModalOpen = false" class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded-2xl shadow-lg overflow-y-auto z-50">
            <div class="modal-content py-4 text-left px-8">
                <div class="flex justify-between items-center pb-6">
                    <p class="text-3xl font-bold">Update Status</p>
                    <div class="modal-close cursor-pointer z-50" @click="isUpdateModalOpen = false">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 3.47a.75.75 0 0 0-1.06-1.06L9 6.94 4.53 2.47a.75.75 0 0 0-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 0 0 1.06 1.06L9
                            11.06l4.47 4.47a.75.75 0 0 0 1.06-1.06L10.06 9l4.47-4.47z" />
                        </svg>
                    </div>
                </div>
                <form wire:submit.prevent="update">
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 font-bold mb-2">Status<span class="text-red-500">*</span></label>
                        <select wire:model="status" id="status" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline">
                            <option value="">Pilih Status</option>
                            <option value="hadir">Hadir</option>
                            <option value="izin">Izin</option>
                            <option value="tidak hadir">Tidak Hadir</option>
                        </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="flex items-center justify-start space-x-4">
                        <button @click="isUpdateModalOpen = false" id="closeModalButton" class="bg-white text-black border border-gray-300 px-4 py-2 rounded-lg
                        mb-6 mt-2 hover:bg-gray-100" type="button">Batal</button>
                        <button class="bg-black text-white px-4 py-2 rounded-lg mb-6 mt-2 hover:bg-gray-800" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
