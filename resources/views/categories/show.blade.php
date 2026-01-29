@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <div>
      <h5 class="mb-0">{{ $category->nama }}</h5>
      <small class="text-muted">Kode: {{ $category->kode }}</small>
    </div>
    <div>
      <a href="{{ route('categories.pdf', $category) }}" class="btn btn-danger btn-sm">
        Export PDF
      </a>
      <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
        Kembali
      </a>
    </div>
  </div>

  <div class="card-body p-0">
    <table class="table table-striped table-bordered mb-0">
      <thead class="table-light">
        <tr>
          <th style="width:5%">#</th>
          <th>Nama Item</th>
          <th style="width:25%">Harga</th>
        </tr>
      </thead>
      <tbody>
        @forelse($category->items as $i => $item)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $item->nama }}</td>
            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="text-center text-muted">
              Belum ada item di kategori ini.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
