<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();

        $totalCustomer = User::where('role', 'user')->count();

        $totalTransaksi = Transaksi::count();

        $pendapatanHariIni = Transaksi::whereDate(
            'tanggal_transaksi',
            Carbon::today()
        )
        ->where('status_pembayaran','lunas')
        ->sum('total_harga');

        $pendingPembayaran = Transaksi::where('status_pembayaran','unpaid')->count();

        $transaksiTerbaru = Transaksi::latest()
                        ->take(5)
                        ->get();

        $produkTerlaris = TransaksiDetail::select(
                    'produk_id',
                    DB::raw('SUM(jumlah) as total')
                )
                ->with('produk')
                ->groupBy('produk_id')
                ->orderByDesc('total')
                ->take(5)
                ->get();

        return view('admin.dashboard.index', compact(
            'totalProduk',
            'totalKategori',
            'totalCustomer',
            'totalTransaksi',
            'pendapatanHariIni',
            'pendingPembayaran',
            'transaksiTerbaru',
            'produkTerlaris'
        ));
    }
}
