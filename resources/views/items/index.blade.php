@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Master Items</h5>
    <div>
      <a href="{{ route('items.excel') }}" class="btn btn-success btn-sm me-2">
        Export Excel
      </a>
      <a href="{{ route('items.create') }}" class="btn btn-primary btn-sm">
        + Tambah Item
      </a>
    </div>
  </div>

  <div class="card-body">
    <form class="row g-2 mb-3" method="GET" action="{{ route('items.index') }}">
      <div class="col">
        <input class="form-control" name="harga_min" placeholder="Harga Min" value="{{ request('harga_min') }}">
      </div>
      <div class="col">
        <input class="form-control" name="harga_max" placeholder="Harga Max" value="{{ request('harga_max') }}">
      </div>
      <div class="col-auto">
        <button class="btn btn-secondary">Filter</button>
      </div>
    </form>

    <table class="table table-bordered table-striped align-middle">
      <thead class="table-light">
        <tr>
          <th>Nama</th>
          <th>Harga</th>
          <th>Kategori</th>
          <th>Foto</th>
          <th style="width: 160px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $item)
        <tr>
          <td>{{ $item->nama }}</td>
          <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
          <td>{{ $item->categories->pluck('nama')->implode(', ') }}</td>
          <td>
            @if($item->foto)
              <img src="{{ asset('uploads/items/'.$item->foto) }}" width="60" class="rounded">
            @else
              <span class="text-muted">-</span>
            @endif
          </td>
          <td>
            <a class="btn btn-warning btn-sm" href="{{ route('items.edit',$item) }}">Edit</a>
            <form class="d-inline" method="POST" action="{{ route('items.destroy',$item) }}">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus item ini?')">
                Hapus
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center text-muted">
            Belum ada data item.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
