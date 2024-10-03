@section('title', 'Profile')

<div>
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-gray-700">
        <ol class="list-reset flex">
            <li><p class="text-black-500 font-bold text-2xl">Profile</p></li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-2xl">
            <span class="mr-5 font-bold">
                Nama
            </span>
            <span class="mr-5 font-semibold">
                :
            </span>
            <span class="font-semibold">
                {{ $profil->name }}
            </span>
        </div>
    </div>
</div>
