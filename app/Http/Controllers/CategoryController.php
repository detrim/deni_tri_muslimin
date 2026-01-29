<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('nama')) {
            $query->where('nama','like','%'.$request->nama.'%');
        }
        if ($request->filled('kode')) {
            $query->where('kode','like','%'.$request->kode.'%');
        }

        $categories = $query->with('items')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:categories'
        ]);

        Category::create($data);
        return redirect()->route('categories.index')->with('success','Kategori ditambahkan');
    }

    public function show(Category $category)
    {
        $category->load('items');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:categories,kode,'.$category->id
        ]);

        $category->update($data);
        return redirect()->route('categories.index')->with('success','Kategori diupdate');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success','Kategori dihapus');
    }

        public function exportPdf(Category $category)
    {
        $category->load('items');

        $pdf = Pdf::loadView('pdf.kategori', compact('category'));
        return $pdf->download('kategori-'.$category->kode.'.pdf');
    }
}
