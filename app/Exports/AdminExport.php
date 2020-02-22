<?php

namespace App\Exports;

use App\Penumpang;
use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Pemesanan;
use App\Tiket;

class AdminExport implements FromView
{
    public function collection()
    {
        return Penumpang::all();
    }
    use Exportable;
    public function view(): View
    {
        $start = Carbon::now()->subWeek()->addDay()->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::now()->format('Y-m-d') . ' 23:59:00';
        return view('report.report_admin', [
            'today' => Carbon::now(),
            'petugas' => User::count(),
            'user' => Penumpang::count(),
            'user1' => Penumpang::wherebetween('created_at',[$start,$end])->count(),
            'pems1' => Pemesanan::where('status','sukses')->wherebetween('created_at',[$start,$end])->count(),
            'pemg1' => Pemesanan::where('status','batal')->wherebetween('created_at',[$start,$end])->count(),
            'pemst' => Pemesanan::where('status','sukses')->count(),
            'pemsg' => Pemesanan::where('status','batal')->count(),
            'pems' => Pemesanan::count(),
            'tik1' => Tiket::where('status','sukses')->wherebetween('created_at',[$start,$end])->count(),
            'tikg1' => Tiket::where('status','batal')->wherebetween('created_at',[$start,$end])->count(),
            'tikt' => Tiket::where('status','sukses')->count(),
            'tikg' => Tiket::where('status','batal')->count(),
            'tik' => Tiket::count()
        ]);
    }
}
