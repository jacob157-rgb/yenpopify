<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::with('customer', 'detail.produk')->latest()->get();
        return view('v_transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = User::where('role', 'user')->get();
        $produks = Produk::all();
        return view('v_transaksi.create', compact('customers', 'produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'tanggal_transaksi' => 'required|date',
            'no_hp' => 'required|string|max:15',
            'status' => 'required|string|in:pending,completed,cancelled',
            'produk_id.*' => 'required|exists:produk,id',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Hitung total harga
            $total_harga = 0;
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $total_harga += $produk->harga * $request->jumlah[$index];
            }

            // Simpan transaksi utama
            $transaksi = Transaksi::create([
                'customer_id' => $request->customer_id,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'no_hp' => $request->no_hp,
                'total_harga' => $total_harga,
                'status' => $request->status,
                'catatan' => $request->catatan ?? null,
            ]);

            // Simpan detail transaksi
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produkId,
                    'jumlah' => $request->jumlah[$index],
                    'harga_satuan' => $produk->harga,
                    'subtotal' => $produk->harga * $request->jumlah[$index],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $transaksi = Transaksi::with('customer', 'detail.produk', 'files')->findOrFail($id);
    return view('v_transaksi.show', compact('transaksi'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::with('detail.produk')->findOrFail($id);
        $customers = User::where('role', 'user')->get();
        $produks = Produk::all();

        return view('v_transaksi.edit', compact('transaksi', 'customers', 'produks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'tanggal_transaksi' => 'required|date',
            'no_hp' => 'required|string|max:15',
            'status' => 'required|string',
            'produk_id.*' => 'required|exists:produk,id',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::findOrFail($id);

            // Hitung ulang total harga
            $total_harga = 0;
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $total_harga += $produk->harga * $request->jumlah[$index];
            }

            // Update transaksi utama
            $transaksi->update([
                'customer_id' => $request->customer_id,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'no_hp' => $request->no_hp,
                'total_harga' => $total_harga,
                'status' => $request->status,
            ]);

            // Hapus detail lama dan buat ulang
            $transaksi->detail()->delete();

            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produkId,
                    'jumlah' => $request->jumlah[$index],
                    'harga_satuan' => $produk->harga,
                    'subtotal' => $produk->harga * $request->jumlah[$index],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

public function approve($id)
{
    $transaksi = Transaksi::findOrFail($id);

    $transaksi->status_pembayaran = 'lunas';
    $transaksi->status = 'diproses';

    $transaksi->save();

    return back()->with('success', 'Pembayaran dikonfirmasi');
}

public function reject($id)
{
    $transaksi = Transaksi::findOrFail($id);

    $transaksi->status_pembayaran = 'ditolak';

    $transaksi->save();

    return back()->with('error', 'Pembayaran ditolak');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->detail()->delete();
        $transaksi->delete();

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
    public function cetak($id)
    {
        $transaksi = Transaksi::with([
            'customer',
            'detail.produk'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('v_transaksi.nota', compact('transaksi'))
                    ->setPaper('A5','portrait');

        return $pdf->stream('nota-'.$transaksi->id.'.pdf');
    }
}
