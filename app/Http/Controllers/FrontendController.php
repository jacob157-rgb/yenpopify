<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class FrontendController extends Controller
{
    public function index()
    {
        $produks = Produk::latest()->get();
        $kategoris = Kategori::with('produks')->get();
        $produkRandom = Produk::inRandomOrder()->limit(2)->get();
        $bestseller = Produk::withSum('transaksiDetail as total_terjual', 'jumlah')
        ->orderByDesc('total_terjual')
        ->limit(3)
        ->get();

        return view('frontend.index', compact('produks', 'kategoris', 'produkRandom', 'bestseller'));
    }

    public function show($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        $kategoris = Kategori::withCount('produks')->get();
        $cart = session()->get('cart', []);

        return view('frontend.produk_detail', compact('produk', 'kategoris', 'cart'));
    }

    public function add(Request $request)
    {
        $productId = $request->product_id;
        $qty = $request->qty ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += $qty;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'qty' => $qty
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart,
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'produk_id' => 'required',
        'no_hp' => 'required',
        'tanggal_transaksi' => 'required|date',
        'total' => 'required|numeric',
    ]);

    Transaksi::create([
        'customer_id' => auth()->id(),
        'produk_id' => $request->produk_id,
        'no_hp' => $request->no_hp,
        'tanggal_transaksi' => now(),
        'total_harga' => $request->total,
        'status' => 'pending',
        'catatan' => $request->catatan ?? null,
    ]);

    return response()->json(['success' => true]);
}




}
