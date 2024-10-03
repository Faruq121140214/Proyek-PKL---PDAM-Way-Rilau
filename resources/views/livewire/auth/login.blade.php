@section('title', 'Sign in to your account')

<div class="grid grid-cols-2 gap-4 h-screen w-full items-center">
    <div class="flex justify-center items-center">
        <img src="{{ asset('assets/img/logo-pdam-way-rilau.png') }}" alt="logo">
    </div>

    <div class="flex flex-col items-center">
        <div class=" bg-gray-300 h-full pt-20 mt-20 w-9/12 rounded-t-xl" style="height: calc(100vh - 6rem);">
            <!-- Bagian Welcome -->
            <div class="flex items-center justify-center h-48 mb-14">
                <h1 class="text-6xl font-bold">WELCOME</h1>
            </div>

            <!-- Bagian Form -->
            <div class="flex items-center justify-center flex-grow px-4">
                <form wire:submit.prevent="authenticate" class="w-full max-w-md">
                    <div class="mt-6">
                        <label for="username" class="block text-xl font-medium text-gray-700 leading-5 mb-3">
                            Username
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input wire:model.lazy="username" id="username" name="username" type="text"
                            placeholder="Masukan username Anda" required autofocus class="appearance-none block w-full px-3 py-5 border
                            border-black placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition
                            duration-150 ease-in-out sm:text-sm sm:leading-5 @error('username') border-red-300 text-red-900
                            placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                        </div>
                        @error('username')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ showPassword: false }" class="mt-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 leading-5 text-xl mb-3">
                            Password
                        </label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <input
                                x-bind:type="showPassword ? 'text' : 'password'"
                                wire:model.lazy="password"
                                id="password"
                                placeholder="Masukan Password Anda"
                                required
                                class="appearance-none block w-full px-3 py-5 border border-black placeholder-gray-400 focus:outline-none
                                focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5
                                @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror"
                            />
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 text-xl"
                            >
                                <i x-bind:class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Button Section -->
                    <div class="mt-6 flex justify-center">
                        <button type="submit" class="w-40 px-3 py-3 text-lg bg-gray-400 text-black">
                            LOGIN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
