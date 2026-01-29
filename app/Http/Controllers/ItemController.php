<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ItemsExport;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('categories');

        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->harga_min);
        }

        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        $items = $query->get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'       => 'required',
            'harga'      => 'required|numeric',
            'laba'       => 'required|numeric',
            'foto'       => 'required|image',
            'categories' => 'required|array'
        ]);

        // 👉 HITUNG HARGA JUAL
        $data['harga_jual'] = $data['harga'] + $data['laba'];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/items'), $name);
            $data['foto'] = $name;
        }

        $item = Item::create($data);

        if ($request->categories) {
            $item->categories()->sync($request->categories);
        }

        return redirect()->route('items.index')
            ->with('success','Item berhasil ditambahkan');
    }


    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item','categories'));
    }

    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'nama'       => 'required',
            'harga'      => 'required|numeric',
            'laba'       => 'required|numeric',
            'foto'       => 'nullable|image',   // 👈 tidak wajib saat update
            'categories' => 'required|array'
        ]);

        // 👉 HITUNG HARGA JUAL
        $data['harga_jual'] = $data['harga'] + $data['laba'];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $name = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/items'), $name);
            $data['foto'] = $name;
        }

        $item->update($data);
        $item->categories()->sync($request->categories ?? []);

        return redirect()->route('items.index')
            ->with('success','Item berhasil diupdate');
    }


    public function destroy(Item $item)
    {
        $item->delete();
        return back()->with('success','Item dihapus');
    }

    public function exportExcel()
    {
        return Excel::download(new ItemsExport, 'master_items.xlsx');
    }

}
