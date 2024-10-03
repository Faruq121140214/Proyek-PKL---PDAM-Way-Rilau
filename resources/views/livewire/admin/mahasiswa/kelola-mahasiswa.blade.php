@section('title', 'Kelola Mahasiswa')

<div x-data="{ isModalOpen: false, isUpdateModalOpen: @entangle('isUpdateModalOpen')}" x-cloak>
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-gray-700">
        <ol class="list-reset flex">
            <li><p class="text-black-500 font-bold text-2xl">Data Mahasiswa</p></li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between mb-10">
            <div>
                <input type="text" wire:model.live.debounce.1000ms="search" placeholder="Cari nama mahasiswa..." class="w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <button @click="isModalOpen = true" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-md">
                    <i class="fa-solid fa-user-plus"></i> Tambah
                </button>
            </div>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4">No</th>
                    <th class="py-2 px-4">Nama</th>
                    <th class="py-2 px-4">Nomor Induk</th>
                    <th class="py-2 px-4">Asal Instansi</th>
                    <th class="py-2 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $mahasiswa)
                    <tr class="text-center">
                        <td class="py-2 px-4">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4">{{ $mahasiswa->nama }}</td>
                        <td class="py-2 px-4">{{ $mahasiswa->npm }}</td>
                        <td class="py-2 px-4">{{ $mahasiswa->instansi }}</td>
                        <td class="py-2 px-4">
                            <button wire:click="edit({{ $mahasiswa->id }})" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-md">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                            <button wire:click="confirmDelete({{ $mahasiswa->id }})" class="bg-gray-200 text-gray-600 px-4 py-2 rounded-md">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- modal create -->
    <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0
    bg-gray-900 bg-opacity-50 flex items-center justify-center z-40">
        <div @click.away="isModalOpen = false" class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded-2xl shadow-lg overflow-y-auto z-50">
            <div class="modal-content py-4 text-left px-8">
                <div class="flex justify-between items-center pb-6">
                    <p class="text-3xl font-bold">Tambah Mahasiswa</p>
                    <div class="modal-close cursor-pointer z-50" @click="isModalOpen = false">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 3.47a.75.75 0 0 0-1.06-1.06L9 6.94 4.53 2.47a.75.75 0 0 0-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 0 0 1.06 1.06L9
                            11.06l4.47 4.47a.75.75 0 0 0 1.06-1.06L10.06 9l4.47-4.47z" />
                        </svg>
                    </div>
                </div>
                <form wire:submit.prevent="store">
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Lengkap<span class="text-red-500">*</span></label>
                        <input type="text" wire:model="nama"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline"
                            placeholder="Masukan nama">
                            @error('nama')
                                <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="flex space-x-4 mb-4">
                        <div class="w-1/2">
                            <label for="username" class="block text-gray-700 font-bold mb-2">Username<span class="text-red-500">*</span></label>
                            <input type="text" wire:model="username"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan username">
                                @error('username')
                                    <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="w-1/2">
                            <label for="password" class="block text-gray-700 font-bold mb-2">Password<span class="text-red-500">*</span></label>
                            <input type="text" wire:model="password"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan Password">
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                    <div class="flex space-x-4 mb-4">
                        <div class="w-1/2">
                            <label for="npm" class="block text-gray-700 font-bold mb-2">Nomor Induk<span class="text-red-500">*</span></label>
                            <input type="text" wire:model="npm"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan Nomor induk">
                                @error('npm')
                                    <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="w-1/2">
                            <label for="instansi" class="block text-gray-700 font-bold mb-2">Asal Instanasi<span class="text-red-500">*</span></label>
                            <input type="text" wire:model="instansi"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan Asal Instansi">
                                @error('instansi')
                                    <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                    <div class="flex items-center justify-start space-x-4">
                        <button @click="isModalOpen = false" id="closeModalButton" class="bg-white text-black border border-gray-300 px-4 py-2 rounded-lg
                        mb-6 mt-2 hover:bg-gray-100" type="button">Batal</button>
                        <button class="bg-black text-white px-4 py-2 rounded-lg mb-6 mt-2 hover:bg-gray-800" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal update -->
    <div x-show="isUpdateModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900
    bg-opacity-50 flex items-center justify-center z-40">
        <div @click.away="isUpdateModalOpen = false" class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded-2xl shadow-lg overflow-y-auto z-50">
            <div class="modal-content py-4 text-left px-8">
                <div class="flex justify-between items-center pb-6">
                    <p class="text-3xl font-bold">Update Mahasiswa</p>
                    <div class="modal-close cursor-pointer z-50" @click="isUpdateModalOpen = false">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 3.47a.75.75 0 0 0-1.06-1.06L9 6.94 4.53 2.47a.75.75 0 0 0-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 0 0 1.06 1.06L9 11.06l4.47
                            4.47a.75.75 0 0 0 1.06-1.06L10.06 9l4.47-4.47z" />
                        </svg>
                    </div>
                </div>
                <form wire:submit.prevent="update">
                    <div class="mb-4">
                        <label for="namaUpdate" class="block text-gray-700 font-bold mb-2">Nama Lengkap<span class="text-red-500">*</span></label>
                        <input type="text" wire:model="namaUpdate"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline"
                            placeholder="Masukan nama">
                            @error('namaUpdate')
                                <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="mb-4">
                        <label for="usernameUpdate" class="block text-gray-700 font-bold mb-2">Username<span class="text-red-500">*</span></label>
                        <input type="text" wire:model="usernameUpdate"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline"
                            placeholder="Masukan username">
                            @error('usernameUpdate')
                                <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="flex space-x-4 mb-4">
                        <div class="w-1/2">
                            <label for="npmUpdate" class="block text-gray-700 font-bold mb-2">Nomor Induk<span class="text-red-500">*</span></label>
                            <input type="text" wire:model="npmUpdate"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan nomor induk">
                                @error('npmUpdate')
                                    <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="w-1/2">
                            <label for="instansiUpdate" class="block text-gray-700 font-bold mb-2">Asal Instansi<span class="text-red-500">*</span></label>
                            <input type="text" wire:model="instansiUpdate"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan asal instansi">
                                @error('instansiUpdate')
                                    <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                    <div class="flex space-x-4 mb-4">
                        <div class="w-1/2">
                            <label for="password_lama" class="block text-gray-700 font-bold mb-2">Password Lama (optional)</label>
                            <input type="password" wire:model="password_lama"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan password lama">
                                @error('password_lama')
                                    <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="w-1/2">
                            <label for="password_baru" class="block text-gray-700 font-bold mb-2">Password Baru (optional)</label>
                            <input type="password" wire:model="password_baru"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:shadow-outline"
                                placeholder="Masukkan password baru">
                                @error('password_baru"')
                                    <p class="mt-2 text-sm text-red-600 peer-invalid:block">{{ $message }}</p>
                                @enderror
                        </div>
                    </div>
                    <div class="flex items-center justify-start space-x-4">
                        <button @click="isUpdateModalOpen = false" id="closeModalButton" class="bg-white text-black border border-gray-300
                        px-4 py-2 rounded-lg mb-6 mt-2 hover:bg-gray-100" type="button">Batal</button>
                        <button class="bg-black text-white px-4 py-2 rounded-lg mb-6 mt-2 hover:bg-gray-800" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

