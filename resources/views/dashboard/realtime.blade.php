@extends('layout.template')
@section('title')
    Dashboard -> Realtime
@endsection

@section('content')
    <div class="m-4 p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <h5>Pendaptan Hari ini {{date('Y-m-d')}}</h5>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Lokasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Polisi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jenis Kendaraan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Waktu Masuk
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Waktu Keluar
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nilai Transaksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $real)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $real->kode_lokasi}}
                            </th>
                            <td class="px-6 py-4">
                                {{$real->platnomor}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $real->kode_cus_in}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $real->waktu_in }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $real->waktu_out }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($real->biayatotal), 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
