<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->enum('metode_pengiriman', ['ambil_toko', 'gosend'])->default('ambil_toko');
            $table->integer('ongkir')->default(0);
            $table->text('alamat_pengiriman')->nullable();
            $table->decimal('latitude',10,7)->nullable()->after('alamat_pengiriman');
            $table->decimal('longitude',10,7)->nullable()->after('latitude');
            $table->decimal('jarak_km',8,2)->nullable()->after('longitude');
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn(['metode_pengiriman', 'ongkir', 'alamat_pengiriman']);
        });
    }

};
