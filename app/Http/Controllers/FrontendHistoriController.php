<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiFile;
use Illuminate\Http\Request;

class FrontendHistoriController extends Controller
{
    public function index()
    {
        $histori = Transaksi::where('customer_id', auth()->id())
            ->latest()
            ->get();

        return view('frontend.histori.index', compact('histori'));
    }

    public function uploadFile(Request $request, $id)
    {
        $request->validate([
            'files'   => 'required',
            'files.*' => 'mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $transaksi = Transaksi::where('customer_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        foreach ($request->file('files') as $file) {
            $path = $file->store('transaksi_files', 'public');

            TransaksiFile::create([
                'transaksi_id' => $transaksi->id,
                'file_path'    => $path,
            ]);
        }

        return back()->with('success', 'File berhasil diupload!');
    }

public function deleteFile($id)
{
    $file = TransaksiFile::find($id);

    if (!$file) {
        return response()->json([
            'success' => false,
            'message' => 'File tidak ditemukan'
        ], 404);
    }

    // Hapus file dari storage/public
    if (\Storage::disk('public')->exists($file->file_path)) {
        \Storage::disk('public')->delete($file->file_path);
    }

    // Hapus record database
    $file->delete();

    return response()->json(['success' => true], 200);
}

}
