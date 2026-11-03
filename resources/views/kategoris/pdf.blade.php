<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Kategori {{ $kategori->kode }} - {{ $kategori->nama }}</title>
    <style>
        @page {
            margin: 20mm 15mm 20mm 15mm;
        }
        body {
            font-family: DejaVu Sans, Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333333;
            line-height: 1.4;
        }
        .header {
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header h2 {
            margin: 0;
            color: #0d6efd;
            font-size: 18px;
            text-transform: uppercase;
        }
        .header p {
            margin: 2px 0 0 0;
            color: #666;
            font-size: 11px;
        }
        .info-box {
            width: 100%;
            margin-bottom: 18px;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 10px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 3px 6px;
            vertical-align: top;
        }
        .info-label {
            font-weight: bold;
            width: 130px;
            color: #495057;
        }
        .badge {
            background-color: #6c757d;
            color: #ffffff;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .content-title {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #212529;
            border-left: 3px solid #0d6efd;
            padding-left: 8px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table th, .data-table td {
            border: 1px solid #dee2e6;
            padding: 6px 8px;
            font-size: 10px;
        }
        .data-table th {
            background-color: #e9ecef;
            color: #333;
            text-align: left;
            font-weight: bold;
        }
        .data-table tr:nth-child(even) {
            background-color: #fdfdfd;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        footer {
            position: fixed;
            bottom: -12mm;
            left: 0px;
            right: 0px;
            height: 10mm;
            font-size: 9px;
            color: #777777;
            border-top: 1px solid #dddddd;
            padding-top: 5px;
        }
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        .footer-table td {
            padding: 0;
            font-size: 9px;
            color: #777;
        }
    </style>
</head>
<body>

    <footer>
        <table class="footer-table">
            <tr>
                <td style="text-align: left;">
                    Medify - Sistem Manajemen Master Item
                </td>
                <td style="text-align: right;">
                    <strong>Waktu Cetak:</strong> {{ $printed_at }}
                </td>
            </tr>
        </table>
    </footer>

    <div class="header">
        <h2>Laporan Data Kategori & Master Items</h2>
        <p>Dokumen Resmi Hasil Ekspor Master Kategori</p>
    </div>

    <div class="info-box">
        <table class="info-table">
            <tr>
                <td class="info-label">Kode Kategori</td>
                <td style="width: 10px;">:</td>
                <td><span class="badge">{{ $kategori->kode }}</span></td>
                <td class="info-label">Total Item</td>
                <td style="width: 10px;">:</td>
                <td><strong>{{ $kategori->items->count() }} Item</strong></td>
            </tr>
            <tr>
                <td class="info-label">Nama Kategori</td>
                <td>:</td>
                <td colspan="4"><strong style="font-size: 13px; color: #0d6efd;">{{ $kategori->nama }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="content-title">Daftar Item dalam Kategori Ini</div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;" class="text-center">No</th>
                <th style="width: 12%;">Kode</th>
                <th style="width: 25%;">Nama Item</th>
                <th style="width: 12%;">Jenis</th>
                <th style="width: 14%;" class="text-right">Harga Beli</th>
                <th style="width: 8%;" class="text-center">Laba</th>
                <th style="width: 14%;" class="text-right">Harga Jual</th>
                <th style="width: 10%;">Supplier</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori->items as $index => $item)
                @php
                    $harga_jual = $item->harga_beli + ($item->harga_beli * $item->laba / 100);
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->kode }}</td>
                    <td><strong>{{ $item->nama }}</strong></td>
                    <td>{{ $item->jenis }}</td>
                    <td class="text-right">Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $item->laba }}%</td>
                    <td class="text-right">Rp {{ number_format($harga_jual, 0, ',', '.') }}</td>
                    <td>{{ $item->supplier }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 15px; color: #888;">
                        Tidak ada item yang terhubung dengan kategori ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>

