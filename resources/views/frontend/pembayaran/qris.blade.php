<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran QRIS | YEN PHOTO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary: #e53935;
            --primary-dark: #c62828;
            --secondary: #1565c0;
            --dark: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
            --soft-bg: #f8fafc;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 28px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Poppins", Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(229, 57, 53, 0.12), transparent 35%),
                radial-gradient(circle at bottom right, rgba(21, 101, 192, 0.13), transparent 38%),
                #f4f7fb;
        }

        .payment-card {
            width: 100%;
            max-width: 460px;
            overflow: visible;
            border-radius: 26px;
            background: var(--white);
            box-shadow: 0 22px 60px rgba(15, 23, 42, 0.16);
        }

        .payment-header {
            position: relative;
            overflow: hidden;
            padding: 30px 26px 78px;
            text-align: center;
            color: var(--white);
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

        .payment-header::before,
        .payment-header::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.10);
        }

        .payment-header::before {
            width: 180px;
            height: 180px;
            top: -95px;
            left: -55px;
        }

        .payment-header::after {
            width: 140px;
            height: 140px;
            right: -45px;
            bottom: -75px;
        }

        .brand-logo {
            position: relative;
            z-index: 1;
            width: 78px;
            height: 78px;
            object-fit: contain;
            padding: 8px;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.18);
        }

        .brand-name {
            position: relative;
            z-index: 1;
            margin: 14px 0 4px;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .brand-subtitle {
            position: relative;
            z-index: 1;
            margin: 0;
            font-size: 14px;
            opacity: 0.88;
        }

        .payment-body {
            margin-top: -45px;
            padding: 0 24px 26px;
            position: relative;
            z-index: 2;
        }

        .total-card {
            padding: 20px;
            text-align: center;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 20px;
            background: var(--white);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
        }

        .total-label {
            display: block;
            margin-bottom: 6px;
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
        }

        .total-price {
            margin: 0;
            color: var(--dark);
            font-size: 28px;
            font-weight: 800;
        }

        .qris-section {
            margin-top: 24px;
            padding: 20px;
            text-align: center;
            border: 1px dashed #cbd5e1;
            border-radius: 20px;
            background: var(--soft-bg);
        }

        .qris-title {
            margin: 0 0 14px;
            color: var(--dark);
            font-size: 15px;
            font-weight: 700;
        }

        .qris-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            border-radius: 16px;
            background: var(--white);
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
        }

        .qris-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            margin-bottom: 15px;
            border-radius: 50px;
            background: #e8f5e9;
            color: #2e7d32;
            font-size: 13px;
            font-weight: 600;
        }

        .qris-wrapper svg,
        .qris-wrapper img {
            width: 210px !important;
            max-width: 100%;
            height: auto !important;
        }

        .qris-info {
            margin: 15px 0 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .payment-methods {
            margin-top: 25px;
        }

        .method-title {
            margin-bottom: 15px;
            font-size: 15px;
            font-weight: 700;
            color: var(--dark);
        }

        .method-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .method-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            transition: .3s;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .05);
        }

        .method-card:hover {
            border-color: #1565c0;
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(21, 101, 192, .15);
        }

        .method-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .method-logo {
            width: 52px;
            height: 52px;
            object-fit: contain;
            border-radius: 12px;
            background: #fff;
            padding: 6px;
            border: 1px solid #edf2f7;
        }

        .method-name {
            font-weight: 700;
            color: #1e293b;
        }

        .method-desc {
            font-size: 12px;
            color: #64748b;
            margin-top: 3px;
        }

        .method-arrow {
            font-size: 22px;
            color: #94a3b8;
        }

        .method-detail {
            display: none;
            margin-top: 12px;
            padding: 16px;
            border-top: 1px solid #e2e8f0;
            animation: fadeDown .3s ease;
        }

        .method-detail.active {
            display: block;
        }

        .method-detail {
            display: none;
            margin-top: 12px;
            animation: fadeDown .35s ease;
        }

        .method-detail.active {
            display: block;
        }

        .rekening-box {
            background: linear-gradient(135deg, #f8fbff, #eef5ff);
            border: 1px solid #dbeafe;
            border-radius: 16px;
            padding: 18px;
            box-shadow: 0 10px 25px rgba(21, 101, 192, .08);
        }

        .rekening-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .rekening-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: #1565c0;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .rekening-title {
            font-weight: 700;
            color: #1e293b;
        }

        .rekening-label {
            color: #64748b;
            font-size: 12px;
        }

        .rekening-number {
            font-size: 24px;
            font-weight: 800;
            color: #1565c0;
            margin: 12px 0;
            letter-spacing: 1px;
        }

        .rekening-name {
            color: #334155;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .copy-btn {
            width: 100%;
            border: none;
            padding: 12px;
            border-radius: 12px;
            background: linear-gradient(135deg, #1565c0, #0d47a1);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: .3s;
        }

        .copy-btn:hover {
            transform: translateY(-2px);
        }

        .rekening-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 14px;
            text-align: center;
        }

        .rekening-label {
            font-size: 12px;
            color: #64748b;
        }

        .rekening-number {
            font-size: 22px;
            font-weight: 700;
            color: #1565c0;
            margin: 8px 0;
            letter-spacing: 1px;
        }

        .rekening-name {
            font-size: 14px;
            color: #1e293b;
            margin-bottom: 15px;
        }

        .copy-btn {
            border: none;
            background: #1565c0;
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: .3s;
        }

        .copy-btn:hover {
            background: #0d47a1;
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .payment-footer {
            padding: 24px;
            border-top: 1px solid var(--border);
            background: #ffffff;
        }

        .upload-label {
            display: block;
            margin-bottom: 9px;
            color: var(--dark);
            font-size: 14px;
            font-weight: 700;
            text-align: left;
        }

        .upload-description {
            display: block;
            margin-top: -4px;
            margin-bottom: 12px;
            color: var(--muted);
            font-size: 12px;
            text-align: left;
        }

        .upload-box {
            position: relative;
            width: 100%;
            min-height: 180px;

            border: 2px dashed #d7dce5;
            border-radius: 18px;

            background: #f8fafc;

            display: flex;
            justify-content: center;
            align-items: center;

            transition: .3s;
            overflow: hidden;

            cursor: pointer;
        }

        .upload-box:hover {
            border-color: #e53935;
            background: #fff5f5;
        }

        .upload-box input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .upload-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .upload-icon {
            width: 70px;
            height: 70px;

            border-radius: 50%;
            background: #ffffff;

            display: flex;
            justify-content: center;
            align-items: center;

            font-size: 32px;

            box-shadow: 0 10px 20px rgba(0, 0, 0, .08);

            margin-bottom: 18px;
        }

        .upload-content h4 {
            margin: 0;
            font-size: 18px;
            color: #1e293b;
        }

        .upload-content p {
            margin-top: 10px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
        }

        .upload-text {
            color: var(--dark);
            font-size: 13px;
            font-weight: 600;
        }

        .upload-limit {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 11px;
        }

        #preview-bukti {
            margin-top: 20px;
        }

        .preview-image {
            width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 15px;
            border: 1px solid #e2e8f0;
        }

        .preview-file {
            display: flex;
            align-items: center;
            gap: 15px;

            padding: 15px;

            background: #f1f5f9;

            border-radius: 15px;
        }

        .btn {
            width: 100%;
            padding: 14px 16px;
            border: none;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .btn-primary {
            margin-top: 20px;
            color: var(--white);
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 10px 20px rgba(229, 57, 53, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 25px rgba(229, 57, 53, 0.32);
        }

        .btn-secondary {
            margin-top: 11px;
            color: var(--dark);
            background: #eef2f7;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        @media (max-width: 480px) {
            body {
                padding: 16px 12px;
            }

            .payment-header {
                padding: 25px 20px 72px;
            }

            .payment-body,
            .payment-footer {
                padding-left: 18px;
                padding-right: 18px;
            }

            .total-price {
                font-size: 24px;
            }

            .qris-wrapper svg,
            .qris-wrapper img {
                width: 185px !important;
            }
        }
    </style>
</head>

<body>

    <div class="payment-card">

        <div class="payment-header">
            <img src="{{ asset('Frontend/img/yen.png') }}" alt="Logo YEN PHOTO" class="brand-logo">

            <h1 class="brand-name">YEN PHOTO</h1>
            <p class="brand-subtitle">Pembayaran QRIS</p>
        </div>

        <div class="payment-body">

            <div class="total-card">
                <span class="total-label">Total Pembayaran</span>
                <h2 class="total-price">
                    Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                </h2>
            </div>

            <div class="qris-section">

                <h3 class="qris-title">
                    Pilih Metode Pembayaran
                </h3>

                <div class="qris-badge">
                    ⭐ Direkomendasikan
                </div>

                <div class="qris-wrapper">
                    {!! $qrCode !!}
                </div>

                <p class="qris-info">
                    QRIS merupakan metode pembayaran yang direkomendasikan.
                    Anda juga dapat memilih transfer bank atau e-wallet di bawah.
                </p>

            </div>

            <div class="payment-methods">

                <div class="method-title">
                    Metode Pembayaran Lainnya
                </div>

                <div class="method-list">

                    <div class="method-item">

                        <div class="method-card" onclick="toggleMethod('bca')">

                            <div class="method-left">
                                <img src="{{ asset('Frontend/img/bca.png') }}" class="method-logo">

                                <div>
                                    <div class="method-name">
                                        Bank BCA
                                    </div>

                                    <div class="method-desc">
                                        Transfer melalui Mobile Banking / ATM
                                    </div>
                                </div>
                            </div>

                            <div class="method-arrow">
                                ▼
                            </div>

                        </div>

                        <div class="method-detail" id="bca">

                            <div class="rekening-box">

                                <div class="rekening-header">

                                    <div class="rekening-icon">
                                        🏦
                                    </div>

                                    <div>
                                        <div class="rekening-title">
                                            Transfer Bank BCA
                                        </div>

                                        <div class="rekening-label">
                                            Nomor Rekening
                                        </div>
                                    </div>

                                </div>

                                <div class="rekening-number">
                                    1234567890
                                </div>

                                <div class="rekening-name">
                                    a.n. YEN PHOTO
                                </div>

                                <button class="copy-btn" onclick="copyRekening(event,'1234567890')">
                                    📋 Salin Nomor Rekening
                                </button>

                            </div>

                        </div>

                    </div>

                    <div class="method-item">

                        <div class="method-card" onclick="toggleMethod('bri')">

                            <div class="method-left">
                                <img src="{{ asset('Frontend/img/bri.png') }}" class="method-logo">

                                <div>
                                    <div class="method-name">
                                        Bank BRI
                                    </div>

                                    <div class="method-desc">
                                        Transfer melalui Mobile Banking / ATM
                                    </div>
                                </div>
                            </div>

                            <div class="method-arrow">
                                ▼
                            </div>

                        </div>

                        <div class="method-detail" id="bri">

                            <div class="rekening-box">

                                <div class="rekening-header">

                                    <div class="rekening-icon">
                                        🏦
                                    </div>

                                    <div>
                                        <div class="rekening-title">
                                            Transfer Bank BRI
                                        </div>

                                        <div class="rekening-label">
                                            Nomor Rekening
                                        </div>
                                    </div>

                                </div>

                                <div class="rekening-number">
                                    1234567890
                                </div>

                                <div class="rekening-name">
                                    a.n. YEN PHOTO
                                </div>

                                <button class="copy-btn" onclick="copyRekening(event,'1234567890')">
                                    📋 Salin Nomor Rekening
                                </button>

                            </div>

                        </div>

                    </div>

                    <div class="method-item">

                        <div class="method-card" onclick="toggleMethod('dana')">

                            <div class="method-left">
                                <img src="{{ asset('Frontend/img/dana.png') }}" class="method-logo">

                                <div>
                                    <div class="method-name">
                                        Dana
                                    </div>

                                    <div class="method-desc">
                                        Transfer melalui Mobile Banking / ATM
                                    </div>
                                </div>
                            </div>

                            <div class="method-arrow">
                                ▼
                            </div>

                        </div>

                        <div class="method-detail" id="dana">

                            <div class="rekening-box">

                                <div class="rekening-header">

                                    <div class="rekening-icon">
                                        🏦
                                    </div>

                                    <div>
                                        <div class="rekening-title">
                                            Transfer Dana
                                        </div>

                                        <div class="rekening-label">
                                            Nomor Rekening
                                        </div>
                                    </div>

                                </div>

                                <div class="rekening-number">
                                    1234567890
                                </div>

                                <div class="rekening-name">
                                    a.n. YEN PHOTO
                                </div>

                                <button class="copy-btn" onclick="copyRekening(event,'1234567890')">
                                    📋 Salin Nomor Rekening
                                </button>

                            </div>

                        </div>

                    </div>

                    <div class="method-item">

                        <div class="method-card" onclick="toggleMethod('seabank')">

                            <div class="method-left">
                                <img src="{{ asset('Frontend/img/seabank.png') }}" class="method-logo">

                                <div>
                                    <div class="method-name">
                                        Bank SeaBank
                                    </div>

                                    <div class="method-desc">
                                        Transfer melalui Mobile Banking / ATM
                                    </div>
                                </div>
                            </div>

                            <div class="method-arrow">
                                ▼
                            </div>

                        </div>

                        <div class="method-detail" id="seabank">

                            <div class="rekening-box">

                                <div class="rekening-header">

                                    <div class="rekening-icon">
                                        🏦
                                    </div>

                                    <div>
                                        <div class="rekening-title">
                                            Transfer Bank SeaBank
                                        </div>

                                        <div class="rekening-label">
                                            Nomor Rekening
                                        </div>
                                    </div>

                                </div>

                                <div class="rekening-number">
                                    1234567890
                                </div>

                                <div class="rekening-name">
                                    a.n. YEN PHOTO
                                </div>

                                <button class="copy-btn" onclick="copyRekening(event,'1234567890')">
                                    📋 Salin Nomor Rekening
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="payment-footer">
            <form id="confirmForm" action="{{ route('frontend.pembayaran.confirm', $transaksi->id) }}" method="POST"
                enctype="multipart/form-data">

                @csrf

                <label class="upload-label">Bukti Pembayaran</label>
                <span class="upload-description">
                    Upload screenshot atau file bukti pembayaran Anda.
                </span>

                <label class="upload-box">
                    <input type="file" name="bukti" id="bukti" accept="image/*,.pdf"
                        onchange="previewBukti(event)">

                    <div class="upload-content">
                        <div class="upload-icon">
                            📤
                        </div>

                        <h4>Klik untuk memilih file</h4>

                        <p>
                            Format JPG, PNG atau PDF<br>
                            Maksimal ukuran 5 MB
                        </p>
                    </div>
                </label>

                <div id="preview-bukti"></div>

                <button type="submit" class="btn btn-primary">
                    ✓ Saya Sudah Bayar
                </button>
            </form>

            <button class="btn btn-secondary" onclick="window.location='{{ route('frontend.histori.index') }}'">
                ← Kembali ke Histori
            </button>
        </div>

    </div>

    <script>
        function previewBukti(event) {
            const file = event.target.files[0];
            const preview = document.getElementById("preview-bukti");

            preview.innerHTML = "";

            if (!file) return;

            const maxSize = 5 * 1024 * 1024;

            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Terlalu Besar',
                    text: 'Ukuran file maksimal adalah 5 MB.',
                    confirmButtonColor: '#e53935'
                });

                event.target.value = "";
                return;
            }

            if (file.type.startsWith("image/")) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML = `
                        <img src="${e.target.result}" class="preview-image" alt="Preview bukti pembayaran">
                    `;
                };

                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = `
                    <div class="preview-file">
                        <span style="font-size:22px;">📄</span>
                        <div>
                            <strong>File PDF dipilih</strong><br>
                            <span style="color:#64748b;">${file.name}</span>
                        </div>
                    </div>
                `;
            }
        }

        document.getElementById("confirmForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const file = document.getElementById("bukti").files.length;

            if (!file) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Upload Bukti Pembayaran',
                    text: 'Silakan upload bukti pembayaran terlebih dahulu.',
                    confirmButtonColor: '#e53935'
                });

                return;
            }

            Swal.fire({
                title: "Konfirmasi Pembayaran",
                text: "Pastikan Anda sudah melakukan pembayaran sebelum melanjutkan.",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Ya, Sudah Bayar",
                cancelButtonText: "Batal",
                confirmButtonColor: "#e53935",
                cancelButtonColor: "#64748b"
            }).then(result => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });

        function toggleMethod(id) {

            const details = document.querySelectorAll(".method-detail");

            details.forEach(item => {

                if (item.id !== id) {
                    item.classList.remove("active");
                }

            });

            document.getElementById(id).classList.toggle("active");
        }

        function copyRekening(event, nomor) {

            event.stopPropagation();

            navigator.clipboard.writeText(nomor);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Nomor rekening berhasil disalin.',
                timer: 1800,
                showConfirmButton: false
            });

        }
    </script>

</body>

</html>
