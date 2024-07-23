<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelPendapatanSummaryTgl implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    private $from_date;
    private $to_date;

    public function __construct(string $from_date, string $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function collection()
    {
        return DB::table('t_rekap_dx')->whereBetween('tgl', [$this->from_date, $this->to_date])->get();
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
            $pend->tgl,
            $pend->lokasi,
            $pend->shift1,
            $pend->shift2,
            $pend->shift3
        ];
    }

}
