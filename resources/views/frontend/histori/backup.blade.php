<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Histori Pesanan</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --bg: #f4f6fb;
            --card: #ffffff;
            --border: #e5e7eb;
            --text: #0f172a;
            --muted: #64748b;
            --primary: #0f172a;
            --accent: #2563eb;
            --success: #16a34a;
            --warning: #f59e0b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            font-family: "Poppins", system-ui, sans-serif;
            color: var(--text);
        }

        .container {
            max-width: 920px;
            margin: 32px auto 80px;
            padding: 16px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid var(--border);
            text-decoration: none;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 18px;
        }

        h2 {
            text-align: center;
            margin-bottom: 28px;
            font-weight: 700;
        }

        /* CARD */
        .card {
            background: var(--card);
            border-radius: 20px;
            padding: 22px;
            margin-bottom: 22px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        }

        /* HEADER */
        .trx-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .trx-left {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .trx-id {
            font-weight: 700;
            font-size: 15px;
        }

        .date {
            font-size: 13px;
            color: var(--muted);
        }

        /* STATUS */
        .badge {
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-warning {
            background: rgba(245, 158, 11, .15);
            color: var(--warning);
        }

        .badge-success {
            background: rgba(22, 163, 74, .15);
            color: var(--success);
        }

        /* BUTTON */
        .btn {
            padding: 10px 18px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--primary);
        }

        hr {
            border: none;
            border-top: 1px dashed var(--border);
            margin: 18px 0;
        }

        /* INFO GRID */
        .info-grid {
            display: grid;
            gap: 10px;
            font-size: 14px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
        }

        .info-row span {
            color: var(--muted);
        }

        .total-row {
            margin-top: 6px;
            padding-top: 10px;
            border-top: 1px solid var(--border);
            font-size: 15px;
        }

        .total-row strong {
            color: var(--accent);
            font-size: 16px;
        }

        /* UPLOAD */
        .dropzone {
            margin-top: 18px;
            border: 2px dashed var(--border);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            background: #fafafa;
            transition: .2s;
            position: relative;
        }

        .dropzone.dragover {
            border-color: var(--accent);
            background: #eef4ff;
        }

        .dropzone input {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .preview-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .preview-item {
            width: 90px;
            height: 90px;
            border-radius: 12px;
            overflow: hidden;
            background: #e5e7eb;
            position: relative;
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-remove {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(0, 0, 0, .6);
            color: #fff;
            width: 20px;
            height: 20px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* UPLOADED */
        .uploaded-item {
            width: 110px;
            height: 110px;
            border-radius: 14px;
            overflow: hidden;
            position: relative;
            border: 1px solid var(--border);
        }

        .uploaded-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .delete-upload-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 22px;
            height: 22px;
            background: #ef4444;
            color: #fff;
            border-radius: 50%;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="/" class="back-btn">← Kembali</a>
        <h2>Histori Pesanan</h2>

        @forelse ($histori as $item)
            <div class="card">
                <div class="trx-header">
                    <div class="trx-left">
                        <div class="trx-id">Transaksi #{{ $item->id }}</div>
                        <div class="date">{{ $item->tanggal_transaksi }}</div>
                    </div>

                    <div style="display:flex; gap:10px; flex-wrap:wrap;">

                        {{-- STATUS PESANAN --}}
                        @if ($item->status == 'pending')
                            <span class="badge badge-warning">
                                Pesanan: Pending
                            </span>
                        @elseif ($item->status == 'diproses')
                            <span class="badge" style="background: rgba(59,130,246,.15); color:#2563eb;">
                                Pesanan: Diproses
                            </span>
                        @else
                            <span class="badge badge-success">
                                Pesanan: Selesai
                            </span>
                        @endif

                        {{-- STATUS PEMBAYARAN --}}
                        @if ($item->status_pembayaran == 'unpaid')
                            <span class="badge badge-danger">
                                Pembayaran: Belum Bayar
                            </span>
                        @elseif ($item->status_pembayaran == 'paid')
                            <span class="badge" style="background: rgba(234,179,8,.2); color:#b45309;">
                                Pembayaran: Menunggu Verifikasi
                            </span>
                        @else
                            <span class="badge badge-success">
                                Pembayaran: Lunas
                            </span>
                        @endif

                    </div>

                    @if ($item->status_pembayaran == 'unpaid')
                        <a href="{{ route('frontend.pembayaran.show', $item->id) }}" class="btn btn-primary">
                            Bayar Sekarang
                        </a>
                    @endif
                </div>

                <hr>

                <div class="info-grid">
                    <div class="info-row">
                        <span>Subtotal Produk</span>
                        <strong>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</strong>
                    </div>

                    <div class="info-row">
                        <span>Metode Pengiriman</span>
                        <span style="text-transform:capitalize">
                            {{ $item->metode_pengiriman ?? 'Ambil Toko' }}
                        </span>
                    </div>

                    @if (($item->ongkir ?? 0) > 0)
                        <div class="info-row">
                            <span>Ongkir</span>
                            <strong>Rp {{ number_format($item->ongkir, 0, ',', '.') }}</strong>
                        </div>
                    @endif

                    <div class="info-row total-row">
                        <span>Total Bayar</span>
                        <strong>
                            Rp {{ number_format($item->total_harga + ($item->ongkir ?? 0), 0, ',', '.') }}
                        </strong>
                    </div>
                </div>

                {{-- Informasi ketika pembayaran masih diverifikasi --}}
                @if ($item->status_pembayaran == 'paid')
                    <div
                        style="
            margin-top:18px;
            padding:16px 18px;
            border-radius:14px;
            background:#fff8e6;
            border:1px solid #fde68a;
            color:#92400e;
            display:flex;
            align-items:flex-start;
            gap:12px;
        ">
                        <div style="font-size:22px;">⏳</div>
                        <div>
                            <strong>Menunggu Persetujuan Pembayaran</strong><br>
                            <small>
                                Form upload file akan muncul ketika admin sudah menyetujui pembayaran Anda.
                            </small>
                        </div>
                    </div>
                @endif

                {{-- Informasi jika pembayaran ditolak --}}
                @if ($item->status_pembayaran == 'ditolak')
                    <div
                        style="
            margin-top:18px;
            padding:16px 18px;
            border-radius:14px;
            background:#fef2f2;
            border:1px solid #fecaca;
            color:#991b1b;
            display:flex;
            align-items:flex-start;
            gap:12px;
        ">
                        <div style="font-size:22px;">❌</div>
                        <div>
                            <strong>Pembayaran Ditolak</strong><br>
                            <small>
                                Mohon maaf, admin menolak pembayaran Anda karena dianggap tidak sesuai.
                                Silakan hubungi admin di
                                <a href="https://wa.me/6288216095472"
                                    style="color:#dc2626;font-weight:600;text-decoration:none;">
                                    0882-1609-5472
                                </a>.
                            </small>
                        </div>
                    </div>
                @endif

                {{-- Form upload muncul setelah pembayaran disetujui --}}
                @if ($item->status_pembayaran == 'lunas')
                    <form action="{{ route('frontend.histori.upload', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="dropzone" id="dropzone-{{ $item->id }}">
                            <p>Pilih atau drag file ke sini</p>
                            <small>(jpg, png, pdf - max 5MB)</small>
                            <input type="file" name="files[]" multiple
                                onchange="previewFiles(event, {{ $item->id }})">
                        </div>

                        <div class="preview-container" id="preview-{{ $item->id }}"></div>

                        <button type="submit" class="btn btn-primary" style="margin-top:10px;">
                            Upload File
                        </button>
                    </form>
                @endif
                @if ($item->files && $item->files->count())
                    <div class="preview-container">
                        @foreach ($item->files as $file)
                            @php
                                $ext = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                            @endphp

                            <div class="uploaded-item">
                                @if ($isImage)
                                    <img src="{{ asset('storage/' . $file->file_path) }}">
                                @else
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                        <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png">
                                    </a>
                                @endif

                                <div class="delete-upload-btn" onclick="deleteFile({{ $file->id }})">
                                    ×
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="card">Belum ada transaksi.</div>
        @endforelse
    </div>
    <script>
        function deleteFile(id) {
            Swal.fire({
                title: 'Hapus file?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/histori/file/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                }
            });
        }
    </script>
    <script>
        function previewFiles(event, id) {
            const container = document.getElementById('preview-' + id);
            container.innerHTML = "";

            const files = event.target.files;
            const maxSize = 5 * 1024 * 1024; // 5MB

            // ❗ VALIDASI SIZE
            for (let i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {

                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar!',
                        text: 'Ukuran file tidak boleh lebih dari 5 MB'
                    });

                    // reset input
                    event.target.value = '';
                    return;
                }
            }

            // lanjut preview kalau aman
            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();

                const div = document.createElement('div');
                div.classList.add('preview-item');

                const remove = document.createElement('div');
                remove.classList.add('preview-remove');
                remove.innerHTML = '×';
                remove.onclick = () => {
                    div.remove();
                };

                if (file.type.startsWith('image/')) {
                    reader.onload = function(e) {
                        div.innerHTML = `<img src="${e.target.result}">`;
                        div.appendChild(remove);
                    };
                    reader.readAsDataURL(file);
                } else {
                    div.innerHTML = `
                <div style="padding:10px; font-size:12px;">
                    📄 ${file.name}
                </div>
            `;
                    div.appendChild(remove);
                }

                container.appendChild(div);
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
