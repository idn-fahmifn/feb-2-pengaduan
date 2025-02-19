<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- area judul dan button kiri kanan -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h5 class="text-lg font-semibold dark:text-white">Laporan</h5>
                        <span class="font-md text-sm dark:text-white">Daftar laporan saya. Klik pada judul untuk selengkapnya.</span>
                    </div>
                    <div>
                        <a href="#" class="bg-red-700 px-6 py-2 text-white hover:bg-red-500 rounded-md">Tambah Kategori</a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg">
                        <thead class="bg-gray-200 dark:bg-red-700">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-700 dark:text-white uppercase tracking-wider">
                                    Judul Laporan
                                </th>
                                <th scope="col" class="py-3 px-6 text-xs font-medium text-gray-700 text-start dark:text-white uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="py-3 px-6 text-xs font-medium text-gray-700 text-start dark:text-white uppercase tracking-wider">
                                    Dibuat
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>