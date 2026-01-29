<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Item::with('categories')->get()->map(function ($item, $i) {
            return [
                $i + 1,
                $item->categories->pluck('nama')->implode(', '),
                $item->nama,
                $item->harga,
                $item->laba,
                $item->harga_jual,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Kategori',
            'Nama Item',
            'Harga',
            'Laba',
            'Harga Jual',
        ];
    }
}
