<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperationalController extends Controller
{
    public function PendapatanPerTanggal() {
        return view('operational.pendapatan_pertanggal');
    }

    public function HistoryStatlement() {
        return view('operational.history_statlement');
    }

    public function PendapatanSummary() {
        return view('operational.pendapatan_summary');
    }

    public function TransaksiKendaraanMasuk() {
        return view('operational.transaksi_kendaraan_masuk');
    }

    public function TransaksiKendaraanKeluar() {
        return view('operational.transaksi_kendaraan_keluar');
    }
}
