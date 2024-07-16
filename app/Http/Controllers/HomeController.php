<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\ParkingChart;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $chartBar = new ParkingChart;
        $chartDonut = new ParkingChart;
        $chartBar->labels([
            'January', 'February', 'March', 'April', 'May', 'June'
        ])->dataset(
            'Parking', 
            'bar', 
            [100, 200, 300, 400, 500, 600]
        )->backgroundColor([
            'rgba(75, 192, 192, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 205, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)'
        ])->options([
            'responsive' => true,
            'maintainAspectRatio' => true,
            'legend' => [
                'display' => false,
                'position' => 'bottom',
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => false,
                ],
            ],
            'title' => [
                'display' => true,
                'text' => 'Parking Chart',
            ],
        ]);

        $chartDonut->labels([
            'pendapatan online', 'pendapatan manual'
        ])->dataset(
            'Pendapatan', 'doughnut', [123, 154]
        )->backgroundColor([
            'rgba(75, 192, 192, 0.7)',
            'rgba(255, 99, 132, 0.7)'
        ])->options([
            'responsive' => true,
            'maintainAspectRatio' => true,
            'legend' => [
                'display' => true,
                'position' => 'bottom',
            ],
            'title' => [
                'display' => true,
                'text' => 'Pendapatan Chart',
            ],
        ]);
        return view('home', ['chartBar' => $chartBar, 'chartDonut' => $chartDonut]);
    }

    public function DashboardPendapatan(){
        $pendCasual = DB::table('t_setorankasir')->sum('jumlah_setoran_tunai');
        $pendMember = DB::table('t_setorankasir')->sum('jumlah_setoran_kredit');
        $pendParkir = $pendCasual + $pendMember;

        $data = [
            'pendCasual' => $pendCasual,
            'pendMember' => $pendMember,
            'pendParkir' => $pendParkir
        ];

        return view('dashboard.pendapatan', ['data' => $data]);
    }

    public function DashboardMembership(){
        return view('dashboard.membership');
    }

    public function DashboardVolume(){
        return view('dashboard.volume');
    }

    public function DashboardRealtime(){
        $today = date('Y-m-d');
        $data = DB::table('t_parkir')->get();
        return view('dashboard.realtime', ['data' => $data]);
    }

    public function DashboardSlide(){
        return view('dashboard.slide');
    }
}
