<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::with('kategori')->get();
        return view('v_produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('v_produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk_gambar', 'public');
        }

        Produk::create([
            'kategori_id' => $request->kategori_id,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        return view('v_produk.edit', compact('produk', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && file_exists(storage_path('app/public/' . $produk->gambar))) {
                unlink(storage_path('app/public/' . $produk->gambar));
            }
            $gambarPath = $request->file('gambar')->store('produk_gambar', 'public');
            $produk->gambar = $gambarPath;
        }

        $produk->update([
            'kategori_id' => $request->kategori_id,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk updated successfully.');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar && file_exists(storage_path('app/public/' . $produk->gambar))) {
            unlink(storage_path('app/public/' . $produk->gambar));
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk deleted successfully.');
    }

}
