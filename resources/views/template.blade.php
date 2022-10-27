<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="https://picsum.photos/200" type="image/x-icon">
    <style>
      .border_hover{
        transition: 0.3s;
      }
      .border_hover:hover{
        border-color:green;
      }
      @media(max-width:992px){
        .table_responsive{
          width: 100%;
          overflow-x:scroll
        }
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-white py-4 shadow sticky-top px-3 px-lg-0">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><b class="text-success" style="font-size: 25px; font-weight:800;"><i class="bi bi-journals me-2"></i>Transaksi</b></a>
        <button class="navbar-toggler border-0" type="button" style="box-shadow: none" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link {{ ($title == 'Tambah Transaksi') ? 'active' : '' }}" href="{{ route('form.index') }}">Tambah Transaksi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ ($title == 'Daftar Transaksi') ? 'active' : '' }}" href="{{ route('transaksi') }}">Daftar Transaksi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ ($title == 'Data Barang') ? 'active' : '' }}" href="{{ route('barang.index') }}">Data Barang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ ($title == 'Data Customer') ? 'active' : '' }}" href="{{ route('customer.index') }}">Data Customer</a>
            </li>
          </ul>
          <div class="dropdown ms-auto">
            <button class="btn dropdown-toggle px-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ auth()->user()->name }}
            </button>
            <ul class="dropdown-menu">
              <li><span class="dropdown-item" style="user-select: none">Role : {{ auth()->user()->role }}</span></li>
              <li><a class="btn dropdown-item" href="{{ route('logout') }}">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    @yield('body')
    <br><br>
    <div class="container-fluid text-center p-3 bg-light">Pembukuan Transaksi</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
          Swal.fire(
          'Berhasil !',
          '{{ session('success') }}',
          'success'
          )
        </script>
    @endif
    @if (session('error'))
        <script>
          Swal.fire(
          'Gagal !',
          '{{ session('error') }}',
          'error'
          )
        </script>
    @endif
    <script>
      $(document).ready(function () {
        $('#myTable').DataTable({
          scrollX:true
        });
      });

    </script>
  </body>
</html>