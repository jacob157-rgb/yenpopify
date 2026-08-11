<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nota</title>

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 13px;
            color: #333;
        }

        .center {
            text-align: center;
        }

        h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 6px;
        }

        .border {
            border-bottom: 1px dashed #999;
            margin: 10px 0;
        }

        .produk th {
            border-bottom: 1px solid #000;
            text-align: left;
        }

        .produk td {
            border-bottom: 1px solid #ddd;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }
    </style>

</head>

<body>

    <div class="center">

        <h2>YEN PHOTO</h2>

        <p>
            Jasa Percetakan & Fotografi
            <br>
            Tegal
        </p>

    </div>

    <div class="border"></div>

    <table>

        <tr>
            <td>No Transaksi</td>
            <td>: {{ $transaksi->id }}</td>
        </tr>

        <tr>
            <td>Tanggal</td>
            <td>:
                {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}
            </td>
        </tr>

        <tr>
            <td>Customer</td>
            <td>: {{ $transaksi->customer->name }}</td>
        </tr>

        <tr>
            <td>No HP</td>
            <td>: {{ $transaksi->no_hp }}</td>
        </tr>

        <tr>
            <td>Pengiriman</td>
            <td>: {{ $transaksi->metode_pengiriman }}</td>
        </tr>

    </table>

    <div class="border"></div>

    <table class="produk">

        <thead>

            <tr>

                <th>Produk</th>

                <th>Harga</th>

                <th>Qty</th>

                <th>Subtotal</th>

            </tr>

        </thead>

        <tbody>

            @foreach ($transaksi->detail as $item)
                <tr>

                    <td>{{ $item->produk->nama_produk }}</td>

                    <td class="right">
                        Rp {{ number_format($item->produk->harga, 0, ',', '.') }}
                    </td>

                    <td class="center">
                        {{ $item->jumlah }}
                    </td>

                    <td class="right">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

    <div class="border"></div>

    <table>

        <tr>

            <td>Subtotal</td>

            <td class="right">

                Rp {{ number_format($transaksi->total_harga - $transaksi->ongkir, 0, ',', '.') }}

            </td>

        </tr>

        <tr>

            <td>Ongkir</td>

            <td class="right">

                Rp {{ number_format($transaksi->ongkir, 0, ',', '.') }}

            </td>

        </tr>

        <tr>

            <td class="bold">TOTAL</td>

            <td class="right bold">

                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}

            </td>

        </tr>

    </table>

    <div class="border"></div>

    <p>

        Status Pembayaran :
        <b>{{ strtoupper($transaksi->status_pembayaran) }}</b>

    </p>

    @if ($transaksi->metode_pengiriman == 'antar')
        <p>

            Alamat :

            <br>

            {{ $transaksi->alamat_pengiriman }}

        </p>
    @endif

    <br><br>

    <div class="center">

        Terima kasih telah berbelanja di

        <b>YEN PHOTO</b>

    </div>

</body>

</html>
