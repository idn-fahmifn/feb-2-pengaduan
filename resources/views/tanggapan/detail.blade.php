<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Progress Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- area judul dan button kiri kanan -->
                <div class="md:flex justify-between items-center mb-6">
                    <div>
                        <h5 class="text-lg font-semibold dark:text-white">Pengaduan saya</h5>
                        <span class="font-md text-sm dark:text-white">Progress pengaduan {{ $data->judul_pengaduan }}.</span>
                    </div>
                    <div>
                        @if ($data->status == 'pending')
                        <span class="bg-gray-300 py-2 px-6 font-semibold text-xs rounded-md">Pending</span>
                        @elseif($data->status == 'proses')
                        <span class="bg-green-300 py-2 px-6 font-semibold text-xs rounded-md">Sedang Diproses</span>
                        @elseif($data->status == 'selesai')
                        <span class="bg-green-700 py-2 px-6 font-semibold text-xs rounded-md">Selesai</span>
                        @else
                        <span class="bg-red-700 py-2 px-6 font-semibold text-xs rounded-md">Pengaduan Ditolak</span>
                        @endif
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg">
                        <tr class="w-full">
                            <th class="text-start dark:text-white py-2 px-3">Judul Pengaduan</th>
                            <td class="dark:text-white py-2 px-3">{{ $data->judul_pengaduan }}</td>
                            <td rowspan="3">
                                <img src="{{ asset('storage/images/pengaduan/'.$data->gambar) }}" width="150" alt="Bukti Laporan">
                            </td>
                        </tr>
                        <tr class="w-full">
                            <th class="text-start dark:text-white py-2 px-3">Dibuat Pada</th>
                            <td class="dark:text-white py-2 px-3">{{ $data->tanggal_pengaduan->format('D, d M Y h:i:s') }}</td>
                        </tr>
                        <tr class="w-full">
                            <th class="text-start dark:text-white py-2 px-3">Detail Pengaduan</th>
                            <td class="dark:text-white py-2 px-3">{{ $data->isi }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center">
                    <h4 class="text-lg font-semibold dark:text-white">
                        Buat Tanggapan
                    </h4>
                </div>
                <form method="post" action="{{ route('tanggapan.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="status" :value="__('Ubah status')" />
                        <select name="status" id="status" class="mt-1 block w-full bg-transparent dark:text-white rounded-md">
                            <option value="{{ $data->status }}">{{ $data->status }}</option>
                            <option value="proses">diproses</option>
                            <option value="selesai">selesai</option>
                            <option value="ditolak">ditolak</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>

                    <div>
                        <x-input-label for="judul_tanggapan" :value="__('Judul Tanggapan')" />
                        <x-text-input id="judul_tanggapan" name="judul_tanggapan" type="text" class="mt-1 block w-full" required />
                        <x-text-input id="id_tanggapan" name="id_pengaduan" value="{{ $data->id }}" type="hidden" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('judul_tanggapan')" />
                    </div>

                    <div>
                        <x-input-label for="isi_tanggapan" :value="__('Isi Tanggapan')" />
                        <textarea name="isi_tanggapan" class="mt-1 block w-full bg-transparent rounded-md dark:text-white"></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('isi_tanggapan')" />
                    </div>
                    <button type="submit" class="bg-red-700 hover:bg-red-500 text-white px-6 py-2 rounded-md">Buat Laporan</button>
                </form>
            </div>
        </div>

        @if (!$tanggapan)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="py-6 dark:text-white ">
                    Pengaduan belum ditanggapi.
                </div>
            </div>
        </div>
        @else
        <!-- area Progress -->
            @foreach ($tanggapan as $item)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-semibold dark:text-white">
                            {{ $item->judul_tanggapan }}
                        </h4>
                        <span class="text-sm font-md dark:text-white">
                            {{ $item->tanggal_tanggapan->diffForHumans() }}
                        </span>
                    </div>
                    <div class="py-6 dark:text-white ">
                        {{ $item->isi_tanggapan }}
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</x-app-layout>