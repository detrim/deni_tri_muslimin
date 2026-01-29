@extends('layouts.app')
@section('content')

<div class="card">
 <div class="card-header d-flex justify-content-between">
   <h5>Kategori</h5>
   <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
 </div>

 <div class="card-body">
  <form class="row g-2 mb-3">
    <div class="col">
      <input class="form-control" name="nama" placeholder="Nama">
    </div>
    <div class="col">
      <input class="form-control" name="kode" placeholder="Kode">
    </div>
    <div class="col-auto">
      <button class="btn btn-secondary">Filter</button>
    </div>
  </form>

  <table class="table table-bordered">
    <tr><th>Nama</th><th>Kode</th><th>Items</th><th>Aksi</th></tr>
    @foreach($categories as $c)
    <tr>
      <td>{{ $c->nama }}</td>
      <td>{{ $c->kode }}</td>
      <td>{{ $c->items->count() }}</td>
      <td>
       <a href="{{ route('categories.show',$c) }}" class="btn btn-info btn-sm">Detail</a>
      </td>
    </tr>
    @endforeach
  </table>
 </div>
</div>
@endsection
