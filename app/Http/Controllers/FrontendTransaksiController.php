<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class FrontendTransaksiController extends Controller
{
    public function store(Request $request)
    {
        // =========================
        // VALIDASI
        // =========================
        $request->validate([
            'no_hp' => 'required|string|max:20',
            'produk' => 'required|array|min:1',

            'produk.*.id' => 'required|exists:produk,id',
            'produk.*.qty' => 'required|integer|min:1',

            'metode_pengiriman' => 'required|in:ambil_toko,gosend',
            'alamat_pengiriman' => 'required_if:metode_pengiriman,gosend',
            'ongkir' => 'required_if:metode_pengiriman,gosend|integer|min:0',

            'latitude'  => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'jarak_km'     => 'nullable|numeric',
        ]);

        // =========================
        // CEK LOGIN
        // =========================
        $customerId = Auth::id();
        if (!$customerId) {
            return response()->json([
                'success' => false,
                'message' => 'Harus login terlebih dahulu.',
            ], 401);
        }

        DB::beginTransaction();

        try {
            $subtotal = 0;

            // =========================
            // HITUNG SUBTOTAL PRODUK
            // =========================
            foreach ($request->produk as $item) {
                $produk = Produk::findOrFail($item['id']);
                $subtotal += $produk->harga * $item['qty'];
            }

            // =========================
            // ONGKIR
            // =========================
            $ongkir = 0;
            if ($request->metode_pengiriman === 'gosend') {
                $ongkir = (int) $request->ongkir;
            }

            $total_harga = $subtotal + $ongkir;

            // =========================
            // SIMPAN TRANSAKSI
            // =========================
            $transaksi = Transaksi::create([

                'customer_id'       => $customerId,
                'tanggal_transaksi' => now(),
                'no_hp'             => $request->no_hp,

                'subtotal'          => $subtotal,
                'ongkir'            => $ongkir,
                'total_harga'       => $total_harga,

                'metode_pengiriman' => $request->metode_pengiriman,

                'alamat_pengiriman' => $request->metode_pengiriman == 'gosend'
                                        ? $request->alamat_pengiriman
                                        : null,

                'latitude'          => $request->latitude,
                'longitude'         => $request->longitude,
                'jarak_km'          => $request->jarak_km,

                'status'            => 'pending',
                'catatan'           => $request->catatan,

            ]);

            // =========================
            // SIMPAN DETAIL TRANSAKSI
            // =========================
            foreach ($request->produk as $item) {
                $produk = Produk::findOrFail($item['id']);

                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id'    => $produk->id,
                    'jumlah'       => $item['qty'],
                    'harga_satuan' => $produk->harga,
                    'subtotal'     => $produk->harga * $item['qty'],
                ]);
            }

            DB::commit();

            // =========================
            // RESPONSE SUKSES
            // =========================
            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil disimpan.',
                'transaksi_id' => $transaksi->id,
                'redirect_url' => route('frontend.pembayaran.show', $transaksi->id),
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem.',
                'error'   => $e->getMessage(), // hapus di production jika perlu
            ], 500);
        }
    }
}
