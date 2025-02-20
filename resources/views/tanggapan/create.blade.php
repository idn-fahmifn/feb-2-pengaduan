<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- area judul dan button kiri kanan -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h5 class="text-lg font-semibold dark:text-white">Laporan baru</h5>
                        <span class="font-md text-sm dark:text-white">Buat pengaduan baru di bawah.</span>
                    </div>
                </div>

                <form method="post" action="{{ route('pengaduan.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="judul_pengaduan" :value="__('Judul Pengaduan')" />
                        <x-text-input id="judul_pengaduan" name="judul_pengaduan" type="text" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('judul_pengaduan')" />
                    </div>
                    <div>
                        <x-input-label for="gambar" :value="__('Gambar/Dokumentasi')" />
                        <x-text-input id="gambar" name="gambar" type="file" class="mt-1 block w-full" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('gambar')" />
                    </div>
                    <div>
                        <x-input-label for="isi" :value="__('Isi Laporan')" />
                        <textarea name="isi" class="mt-1 block w-full bg-transparent rounded-md dark:text-white"></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('isi')" />
                    </div>
                    <button type="submit" class="bg-red-700 hover:bg-red-500 text-white px-6 py-2 rounded-md">Buat Laporan</button>
                </form>

            </div>
        </div>
</x-app-layout>