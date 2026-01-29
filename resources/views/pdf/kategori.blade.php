<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Kategori</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 6px; }
        th { background: #eee; }
        .footer { margin-top: 20px; font-size: 10px; text-align: right; }
    </style>
</head>
<body>

<h2>Detail Kategori</h2>

<p><strong>Nama:</strong> {{ $category->nama }}</p>
<p><strong>Kode:</strong> {{ $category->kode }}</p>

<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th>Nama Item</th>
            <th style="width:25%">Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($category->items as $i => $item)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $item->nama }}</td>
            <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    Dicetak: {{ now()->format('d-m-Y H:i') }}
</div>

</body>
</html>
