<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class FrontendPembayaranController extends Controller
{
    public function show(Transaksi $transaksi)
    {
        if ($transaksi->status !== 'pending') {
            return redirect()
                ->route('frontend.histori.index')
                ->with('error', 'Transaksi sudah selesai.');
        }

        $qrData = implode('|', [
            'YENPHOTO',
            'TRX-' . str_pad($transaksi->id, 5, '0', STR_PAD_LEFT),
            'TOTAL-' . $transaksi->total_harga,
            'QRIS-SIMULASI'
        ]);

        $qrCode = QrCode::size(300)
            ->margin(2)
            ->generate($qrData);

        return view('frontend.pembayaran.qris', compact('transaksi', 'qrCode'));
    }

    public function confirm(Request $request, $id)
{
    $request->validate([
        'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120'
    ]);

    $transaksi = Transaksi::findOrFail($id);

    if ($request->hasFile('bukti')) {
        $file = $request->file('bukti');
        $filename = time() . '_' . $file->getClientOriginalName();

        $path = $file->storeAs('bukti_pembayaran', $filename, 'public');

        $transaksi->bukti = $path;
    }

$transaksi->status_pembayaran = 'paid';
$transaksi->save();

    return redirect()->route('frontend.histori.index')
        ->with('success', 'Bukti pembayaran berhasil dikirim, menunggu verifikasi admin');
}
}
