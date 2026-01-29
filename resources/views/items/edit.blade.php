@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">Edit Item</div>
  <div class="card-body">
    <form method="POST" enctype="multipart/form-data" action="{{ route('items.update',$item) }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label>Nama</label>
        <input class="form-control @error('nama') is-invalid @enderror"
               name="nama"
               value="{{ old('nama', $item->nama) }}">
        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="mb-3">
        <label>Harga</label>
        <input class="form-control @error('harga') is-invalid @enderror"
               name="harga"
               value="{{ old('harga', (int)$item->harga) }}">
        @error('harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="mb-3">
        <label>Laba</label>
        <input class="form-control @error('laba') is-invalid @enderror"
               name="laba"
               value="{{ old('laba', (int)$item->laba) }}">
        @error('laba')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="mb-3">
        <label>Kategori</label>
        <select class="form-select @error('categories') is-invalid @enderror" name="categories[]" multiple>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
              {{ collect(old('categories', $item->categories->pluck('id')->toArray()))->contains($cat->id) ? 'selected' : '' }}>
              {{ $cat->nama }}
            </option>
          @endforeach
        </select>
        @error('categories')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="mb-3">
        <label>Foto (kosongkan jika tidak diganti)</label><br>
        @if($item->foto)
          <img src="{{ asset('uploads/items/'.$item->foto) }}" width="80" class="mb-2 rounded">
        @endif
        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <button class="btn btn-success">Update</button>
      <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>
@endsection
