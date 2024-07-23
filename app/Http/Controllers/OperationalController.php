<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Charts\ParkingChart;
use App\Exports\ExcelPendapatanSummaryTgl;
use Maatwebsite\Excel\Facades\Excel;

class OperationalController extends Controller
{
    public function PendapatanPerTanggal(Request $request)
    {
        $m_lokasi = DB::table('m_lokasi')->select('nama')->get();
        $chartPendapatan = new ParkingChart;
        if ($request->has('filter')) {
            $lokasi = $request->input('lokasi');
            $tanggal_awal = date("Y-m-d", strtotime($request->input('from_date')));
            $tanggal_akhir = date("Y-m-d", strtotime($request->input('to_date')));
            $data = DB::table('t_rekap_dx')
                ->where('lokasi', $lokasi)
                ->whereBetween('tgl', [$tanggal_awal, $tanggal_akhir])
                ->paginate(10);
                $total = DB::select(
                    "SELECT 
                        SUM(shift1) as t_shift1, 
                        SUM(shift2) as t_shift2,
                        SUM(shift3) as t_shift3,
                        SUM(kend_masuk) as t_kend_masuk,
                        SUM(motor_keluar) as t_motor_keluar,
                        SUM(mobil_keluar) as t_mobil_keluar,
                        SUM(jum_on) as t_jum_on,
                        SUM(pembatalan_tiket) as t_pembatalan_tiket,
                        SUM(pend_motor) as t_pend_motor,
                        SUM(pend_mobil) as t_pend_mobil,
                        SUM(card) as t_card,
                        SUM(nil_tm) as t_nil_tm,
                        SUM(set_plus_minus) as t_set_plus_minus,
                        SUM(pend_member) as t_pend_member,
                        SUM(pend_helm) as t_pend_helm,
                        SUM(pend_trans_manual) as t_pend_trans_manual,
                        SUM(pend_kartu) as t_pens_kartu,
                        SUM(pend_valet) as t_valet,
                        SUM(pend_slot) as t_pend_slot,
                        SUM(jumpemb_member) as t_jumpemb_member,
                        SUM(belum_setor) as t_belum_setor,
                        SUM(cash_less) as t_cash_less,
                        SUM(cash) as t_cash,
                        SUM(tiket_hilang) as t_tiket_hilang
                    FROM t_rekap_dx
                    WHERE tgl BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"
                );
            return view('operational.pendapatan_pertanggal', 
                        [
                            'rekap' => $data,
                            'lokasi' => $lokasi,
                            'tanggal_awal' => $tanggal_awal,
                            'tanggal_akhir' => $tanggal_akhir,
                            'm_lokasi' => $m_lokasi,
                            'total' => $total,
                        ]);
        } else {
            // $chartPendapatan->labels([]);
            $data = DB::table('t_rekap_dx')->paginate(10);
            $total = DB::select(
                "SELECT 
                    SUM(shift1) as t_shift1, 
                    SUM(shift2) as t_shift2,
                    SUM(shift3) as t_shift3,
                    SUM(kend_masuk) as t_kend_masuk,
                    SUM(motor_keluar) as t_motor_keluar,
                    SUM(mobil_keluar) as t_mobil_keluar,
                    SUM(jum_on) as t_jum_on,
                    SUM(pembatalan_tiket) as t_pembatalan_tiket,
                    SUM(pend_motor) as t_pend_motor,
                    SUM(pend_mobil) as t_pend_mobil,
                    SUM(card) as t_card,
                    SUM(nil_tm) as t_nil_tm,
                    SUM(set_plus_minus) as t_set_plus_minus,
                    SUM(pend_member) as t_pend_member,
                    SUM(pend_helm) as t_pend_helm,
                    SUM(pend_trans_manual) as t_pend_trans_manual,
                    SUM(pend_kartu) as t_pens_kartu,
                    SUM(pend_valet) as t_valet,
                    SUM(pend_slot) as t_pend_slot,
                    SUM(jumpemb_member) as t_jumpemb_member,
                    SUM(belum_setor) as t_belum_setor,
                    SUM(cash_less) as t_cash_less,
                    SUM(cash) as t_cash,
                    SUM(tiket_hilang) as t_tiket_hilang
                FROM t_rekap_dx"
            );
            return view(
                'operational.pendapatan_pertanggal',
                [
                    'rekap' => $data,
                    'm_lokasi' => $m_lokasi,
                    'total' => $total
                ]
            );
        }
    }

    public function ExportPendSummary()
    {
        return (new ExcelPendapatanSummaryTgl("2024-06-03", "2024-06-07"))->download('pendapatan-summary.xlsx');
    }

    public function HistoryStatlement(Request $request)
    {
        $m_lokasi = DB::table('m_lokasi')->select('nama')->get();
        $m_perusahaan = DB::table('m_perusahaan')->select('nama')->get();
        if ($request->has('filter')) {
            $lokasi = $request->input('lokasi');
            $tanggal_awal = date("Y-m-d", strtotime($request->input('from_date')));
            $tanggal_akhir = date("Y-m-d", strtotime($request->input('to_date')));
            $perusahaan = $request->input('perusahaan');
            $data = DB::table('thistori_setle')
                ->whereBetween('tanggal_settel', [$tanggal_awal, $tanggal_akhir])
                ->paginate(10);
            return view(
                'operational.history_statlement',
                [
                    'history' => $data,
                    'm_lokasi' => $m_lokasi,
                    'm_perusahaan' => $m_perusahaan,
                    'tgl_awal' => date('m/d/Y', strtotime($tanggal_awal)),
                    'tgl_akhir' => date('m/d/Y', strtotime($tanggal_akhir))
                ]
            );
        } else {
            $data = DB::table('thistori_setle')->paginate(10);
            $total = DB::select(
                "SELECT
                SUM(jumlah_amount) as t_jml_trx,
                SUM(bca) as t_bca,
                SUM(mdr) as t_mdr
                FROM thistori_setle"
            );
            return view(
                'operational.history_statlement',
                [
                    'history' => $data,
                    'm_lokasi' => $m_lokasi,
                    'm_perusahaan' => $m_perusahaan,
                    'total' => $total
                ]
            );
        }
    }

    public function PendapatanSummary(Request $request)
    {
        $m_lokasi = DB::table('m_lokasi')->select('nama')->get();
        $m_perusahaan = DB::table('m_perusahaan')->select('nama')->get();
        if ($request->has('filter')) {
            $lokasi = $request->input('lokasi');
            $tanggal_awal = date("Y-m-d", strtotime($request->input('from_date')));
            $tanggal_akhir = date("Y-m-d", strtotime($request->input('to_date')));
            $data = DB::table('t_rekap_dx')
                ->where('lokasi', $lokasi)
                ->whereBetween('tgl', [$tanggal_awal, $tanggal_akhir])
                ->paginate(10);
            $total = DB::select(
                "SELECT 
                        SUM(shift1) as t_shift1, 
                        SUM(shift2) as t_shift2,
                        SUM(shift3) as t_shift3,
                        SUM(kend_masuk) as t_kend_masuk,
                        SUM(motor_keluar) as t_motor_keluar,
                        SUM(mobil_keluar) as t_mobil_keluar,
                        SUM(jum_on) as t_jum_on,
                        SUM(pembatalan_tiket) as t_pembatalan_tiket,
                        SUM(pend_motor) as t_pend_motor,
                        SUM(pend_mobil) as t_pend_mobil,
                        SUM(card) as t_card,
                        SUM(nil_tm) as t_nil_tm,
                        SUM(set_plus_minus) as t_set_plus_minus,
                        SUM(pend_member) as t_pend_member,
                        SUM(pend_helm) as t_pend_helm,
                        SUM(pend_trans_manual) as t_pend_trans_manual,
                        SUM(pend_kartu) as t_pens_kartu,
                        SUM(pend_valet) as t_valet,
                        SUM(pend_slot) as t_pend_slot,
                        SUM(jumpemb_member) as t_jumpemb_member,
                        SUM(belum_setor) as t_belum_setor,
                        SUM(cash_less) as t_cash_less,
                        SUM(cash) as t_cash,
                        SUM(tiket_hilang) as t_tiket_hilang
                    FROM 
                    t_rekap_dx
                    WHERE tgl BETWEEN '$tanggal_awal' AND '$tanggal_akhir';"
            );
            return view(
                'operational.pendapatan_summary',
                [
                    'rekap' => $data,
                    'total' => $total,
                    'lokasi' => $lokasi,
                    'tgl_awal' => date('m/d/Y', strtotime($tanggal_awal)),
                    'tgl_akhir' => date('m/d/Y', strtotime($tanggal_akhir)),
                    'm_lokasi' => $m_lokasi,
                    'm_perusahaan' => $m_perusahaan
                ]
            );
        } else {
            $data = DB::table('t_rekap_dx')->paginate(10);
            $total = DB::select(
                "SELECT 
                                SUM(shift1) as t_shift1, 
                                SUM(shift2) as t_shift2,
                                SUM(shift3) as t_shift3,
                                SUM(kend_masuk) as t_kend_masuk,
                                SUM(motor_keluar) as t_motor_keluar,
                                SUM(mobil_keluar) as t_mobil_keluar,
                                SUM(jum_on) as t_jum_on,
                                SUM(pembatalan_tiket) as t_pembatalan_tiket,
                                SUM(pend_motor) as t_pend_motor,
                                SUM(pend_mobil) as t_pend_mobil,
                                SUM(card) as t_card,
                                SUM(nil_tm) as t_nil_tm,
                                SUM(set_plus_minus) as t_set_plus_minus,
                                SUM(pend_member) as t_pend_member,
                                SUM(pend_helm) as t_pend_helm,
                                SUM(pend_trans_manual) as t_pend_trans_manual,
                                SUM(pend_kartu) as t_pens_kartu,
                                SUM(pend_valet) as t_valet,
                                SUM(pend_slot) as t_pend_slot,
                                SUM(jumpemb_member) as t_jumpemb_member,
                                SUM(belum_setor) as t_belum_setor,
                                SUM(cash_less) as t_cash_less,
                                SUM(cash) as t_cash,
                                SUM(tiket_hilang) as t_tiket_hilang
                            FROM 
                            `t_rekap_dx`;"
            );
            return view(
                'operational.pendapatan_summary',
                [
                    'rekap' => $data,
                    'total' => $total,
                    'm_lokasi' => $m_lokasi,
                    'm_perusahaan' => $m_perusahaan
                ]
            );
        }
    }

    public function TransaksiKendaraanMasuk()
    {
        $data = DB::table('t_kendaraanmasuk')->paginate(10);
        return view('operational.transaksi_kendaraan_masuk', ['masuk' => $data]);
    }

    public function TransaksiKendaraanKeluar()
    {
        $data = DB::table('t_kendaraankeluar')->paginate(10);
        return view('operational.transaksi_kendaraan_keluar', ['keluar' => $data]);
    }
}
