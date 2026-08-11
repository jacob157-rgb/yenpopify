<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'customer_id',
        'tanggal_transaksi',
        'no_hp',
        'total_harga',
        'status',
        'catatan',
        'metode_pengiriman',
        'ongkir',
        'alamat_pengiriman',
        'status_pembayaran',
        'latitude',
        'longitude',
        'jarak_km',
        'ongkir',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
    public function files()
{
    return $this->hasMany(TransaksiFile::class);
}

}
