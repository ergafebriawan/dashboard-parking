<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class ExportPendapatanSummary implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(string $from_date, string $to_date)
    {
        // $this->from_date = $from_date;
        // $this->to_date = $to_date;
    }

    public function collection()
    {
        return DB::table('t_rekap_dx')->get();
    }

    public function headings(): array{
        return [
            'Tanggal',
            'Lokasi',
            'Jam Masuk',
            'Jam Keluar',
            'Durasi',
            'Biaya Parkir',
            'Total Bayar'
        ];
    }

    public function map($pend):array{
        return [
            $pend->tanggal,
            $pend->lokasi,
            $pend->jam_masuk,
            $pend->jam_keluar,
            $pend->durasi,
            $pend->biaya_parkir,
            $pend->total_bayar
        ];
    }

    public function query(){

    }
}
