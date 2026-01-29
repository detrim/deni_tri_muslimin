@extends('layouts.app')

@section('content')
<div class="card">
 <div class="card-header">Tambah Kategori</div>
 <div class="card-body">
  <form method="POST" action="{{ route('categories.store') }}">
   @csrf

   <div class="mb-3">
    <label>Nama</label>
    <input class="form-control" name="nama" required>
   </div>

   <div class="mb-3">
    <label>Kode</label>
    <input class="form-control" name="kode" required>
   </div>

   <button class="btn btn-success">Simpan</button>
   <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
 </div>
</div>
@endsection
