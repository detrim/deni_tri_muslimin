<!DOCTYPE html>
<html>
<head>
    <title>Medify Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="{{ route('items.index') }}">Medify Test</a>
    <div>
      <a class="btn btn-light btn-sm me-2" href="{{ route('items.index') }}">Master Items</a>
      <a class="btn btn-outline-light btn-sm" href="{{ route('categories.index') }}">Kategori</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>
