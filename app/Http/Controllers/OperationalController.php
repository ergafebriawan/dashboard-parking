<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationalController extends Controller
{
    public function PendapatanPerTanggal(Request $request) {
        if($request->has('filter')){
            $lokasi = $request->input('lokasi');
            $tanggal_awal = date("Y-m-d", strtotime($request->input('from_date')));
            $tanggal_akhir = date("Y-m-d", strtotime($request->input('to_date')));
            $data = DB::table('t_rekap_dx')
                ->where('lokasi', $lokasi)
                ->whereBetween('tgl', [$tanggal_awal, $tanggal_akhir])
                ->paginate(10);
            return view('operational.pendapatan_pertanggal', ['rekap' => $data]);
        }else{
            $data = DB::table('t_rekap_dx')->paginate(10);
            return view('operational.pendapatan_pertanggal', ['rekap' => $data]);
        }
    }

    public function ExportPendapatanPerTanggal(){
        
    }

    public function HistoryStatlement() {
        $data = DB::table('thistori_setle')->paginate(10);
        // dd($data);
        return view('operational.history_statlement', ['history' => $data]);
    }

    public function PendapatanSummary(Request $request) {
        if($request->has('filter')){
            $lokasi = $request->input('lokasi');
            $tanggal_awal = date("Y-m-d", strtotime($request->input('from_date')));
            $tanggal_akhir = date("Y-m-d", strtotime($request->input('to_date')));
            $data = DB::table('t_rekap_dx')
                ->where('lokasi', $lokasi)
                ->whereBetween('tgl', [$tanggal_awal, $tanggal_akhir])
                ->paginate(10);
            return view('operational.pendapatan_summary', ['rekap' => $data]);
        }else{
            $data = DB::table('t_rekap_dx')->paginate(10);
            return view('operational.pendapatan_summary', ['rekap' => $data]);
        }
    }

    public function TransaksiKendaraanMasuk() {
        $data = DB::table('t_kendaraanmasuk')->paginate(10);
        return view('operational.transaksi_kendaraan_masuk', ['masuk' => $data]);
    }

    public function TransaksiKendaraanKeluar() {
        $data = DB::table('t_kendaraankeluar')->paginate(10);
        return view('operational.transaksi_kendaraan_keluar', ['keluar' => $data]);
    }
}
