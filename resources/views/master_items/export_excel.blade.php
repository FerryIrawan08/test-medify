<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Master Items Export</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th {
            background-color: #2E75B6;
            color: #FFFFFF;
            font-weight: bold;
            text-align: center;
            border: 1px solid #000000;
            padding: 8px 12px;
            font-size: 11pt;
        }
        td {
            border: 1px solid #D9D9D9;
            padding: 6px 10px;
            font-size: 10pt;
            vertical-align: middle;
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .number-format {
            mso-number-format: "\#\,\#\#0";
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama kategori</th>
                <th>Nama items</th>
                <th>Nama supplier</th>
                <th>Harga</th>
                <th>Laba</th>
                <th>Harga jual</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $item)
                @php
                    $kategoriNames = $item->kategoris->pluck('nama')->implode(', ');
                    $harga_jual = $item->harga_beli + ($item->harga_beli * $item->laba / 100);
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-left">{{ $kategoriNames ?: '-' }}</td>
                    <td class="text-left">{{ $item->nama }}</td>
                    <td class="text-left">{{ $item->supplier }}</td>
                    <td class="text-right number-format">{{ $item->harga_beli }}</td>
                    <td class="text-center">{{ $item->laba }}%</td>
                    <td class="text-right number-format">{{ round($harga_jual) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Data master items kosong</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
