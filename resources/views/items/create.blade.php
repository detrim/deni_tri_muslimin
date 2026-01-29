@extends('layouts.app')
@section('content')

<div class="card">
 <div class="card-header">Tambah Item</div>
 <div class="card-body">
  <form method="POST" enctype="multipart/form-data" action="{{ route('items.store') }}">
   @csrf
   <div class="mb-2">
    <label>Nama</label>
    <input class="form-control" name="nama" required>
   </div>

   <div class="mb-2">
    <label>Harga</label>
    <input class="form-control" name="harga" required>
   </div>

   <div class="mb-2">
    <label>Laba</label>
    <input class="form-control" name="laba" required>
   </div>

   <div class="mb-2">
    <label>Kategori</label>
    <select class="form-select" required name="categories[]" multiple>
     @foreach($categories as $cat)
      <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
     @endforeach
    </select>
   </div>

   <div class="mb-2">
    <label>Foto</label>
    <input type="file" class="form-control" name="foto" required>
   </div>

   <button class="btn btn-success">Simpan</button>
   <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
 </div>
</div>
@endsection
