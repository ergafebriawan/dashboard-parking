@extends('layout.template')
@section('title')
    Pendapatan Summary
@endsection

@section('content')
    <div class="m-4 p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <form action="" method="post">
            @csrf
            <div class="p-4 bg-gray-200 rounded-lg shadow-lg mb-8 grid grid-cols-6 gap-8">
                <div class="inline-block">
                    <label for="lokasi" class="mx-2">Perusahaan</label>
                    <select id="lokasi" name="lokasi"
                        class="bg-gray-50 border mt-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Pilih Perusahaan</option>
                        @foreach ($m_perusahaan as $peru)
                            @if (isset($perusahaan) && $perusahaan == $peru->nama)
                                <option value="{{ $peru->nama }}" selected>{{ $peru->nama }}</option>
                            @else
                                <option value="{{ $peru->nama }}">{{ $peru->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="inline-block">
                    <label for="lokasi" class="mx-2">Lokasi</label>
                    <select id="lokasi" name="lokasi"
                        class="bg-gray-50 border mt-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Pilih Lokasi</option>
                        @foreach ($m_lokasi as $lok)
                            @if (isset($lokasi) && $lokasi == $lok->nama)
                                <option value="{{ $lok->nama }}" selected>{{ $lok->nama }}</option>
                            @else
                                <option value="{{ $lok->nama }}">{{ $lok->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="inline-block">
                    <label for="lokasi" class="mx-2">Periode</label>
                    <div class="relative max-w-sm mt-2">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker id="from" name="from_date" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date" @if (isset($tgl_awal)) value="{{ $tgl_awal }}" @endif>
                    </div>
                </div>

                <div class="flex items-end">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker id="to" name="to_date" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date" @if (isset($tgl_awal)) value="{{ $tgl_awal }}" @endif>
                    </div>
                </div>

                <div class="flex items-end">
                    <button type="submit" name="filter"
                        class="bg-gray-800 text-gray-200 py-2 font-semibold rounded-lg shadow-md px-8 hover:bg-slate-900 cursor-pointer">
                        Tampilkan
                    </button>
                </div>
                <div class="flex items-end justify-end">
                    <a href="/export/pendapatan-summary"
                        class="bg-gray-800 text-gray-200 py-2 font-semibold rounded-lg shadow-md px-8 hover:bg-gray-900 cursor-pointer">
                        Export Excel
                    </a>
                </div>
            </div>
        </form>
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div>
                <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio"
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">
                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                    </svg>
                    Last 30 days
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownRadio"
                    class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
                    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownRadioButton">
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-1" type="radio" value="" name="filter-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-1"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                                    day</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input checked="" id="filter-radio-example-2" type="radio" value=""
                                    name="filter-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-2"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                                    7 days</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-3" type="radio" value="" name="filter-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-3"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                                    30 days</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-4" type="radio" value="" name="filter-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-4"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                                    month</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-5" type="radio" value="" name="filter-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-5"
                                    class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Last
                                    year</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Perusahaan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lokasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Shift 1
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Shift 2
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Shift 3
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kend. Masuk
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Motor Keluar
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mobil Keluar
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Kend. Keluar
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jml ON
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jml ON (%)
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jml Tiket Hilang
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jml Pemb. Tiket
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pend. Motor
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pend. Mobil
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pendapatan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Belum Setor
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nil. TM
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Set (+/-)
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pend. Member
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pemb. Member
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pend. Cashless
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pend. Cashless By Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pend. TManual
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Pendapatan
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekap as $pend)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                -
                            </th>
                            <td class="px-6 py-4">
                                {{ $pend->lokasi }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pend->tgl }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->shift1), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->shift2), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->shift3), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($pend->kend_masuk), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($pend->motor_keluar), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($pend->mobil_keluar), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($pend->motor_keluar) + intval($pend->mobil_keluar), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pend->jum_on }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pend->jum_on }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($pend->tiket_hilang), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($pend->card), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->pend_motor), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->pend_mobil), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->pend_motor) + intval($pend->pend_mobil), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($pend->belum_setor), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pend->nil_tm }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pend->set_plus_minus }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->pend_member), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->jumpemb_member), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->cash_less), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->cash_less), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->cash), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($pend->cash_less), 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($total as $t)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                TOTAL
                            </th>
                            <td class="px-6 py-4">
                                
                            </td>
                            <td class="px-6 py-4">
                                
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_shift1), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_shift2), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_shift3), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($t->t_kend_masuk), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($t->t_motor_keluar), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($t->t_mobil_keluar), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($t->t_motor_keluar) + intval($t->t_mobil_keluar), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($t->t_jum_on), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($t->t_jum_on), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($t->t_tiket_hilang), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($t->t_card), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_pend_motor), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_pend_mobil), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_pend_motor) + intval($t->t_pend_mobil), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($t->t_belum_setor), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($t->t_nil_tm), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format(intval($t->t_set_plus_minus), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_pend_member), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_jumpemb_member), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_cash_less), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_cash_less), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_cash), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp{{ number_format(intval($t->t_cash), 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="pagination mt-4">
            {{ $rekap->links() }}
        </div>

    </div>
@endsection
