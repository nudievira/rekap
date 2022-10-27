@extends('template')
@section('body')
    <div class="container mt-5 p-3 pt-5 p-lg-5 shadow">
      
       <div class="p-3">
        <div class="d-flex justify-content-center justify-content-lg-start">
          <a class="btn btn-sm btn-success rounded-0 mb-4" data-bs-toggle="modal" data-bs-target="#tambahBarang">+ Tambah</a>
        </div>
        <table id="myTable" class="table table-bordered" style="width:100%">
            <thead class="bg-light">
                <tr>
                    <th class="text-nowrap">No</th>
                    <th class="text-nowrap">Kode</th>
                    <th class="text-nowrap">Nama</th>
                    <th class="text-nowrap">Harga</th>
                    <th class="text-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
              @php
                  $no = 0;
              @endphp
               @foreach ($barang as $item)
               @php
                   $no++;
               @endphp
               <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->nama }}</td>
                <td>Rp {{ number_format($item->harga) }}</td>
                <td class="text-nowrap d-flex">
                  <a class="btn btn-sm btn-warning rounded-0 me-2" onclick="editBarang('{{ route('barang.show',$item->id) }}')"><i class="bi bi-pencil me-2"></i>Edit</a>
                  <form action="{{ route('barang.destroy',$item->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger rounded-0"><i class="bi bi-trash3 me-2"></i>Hapus</button>
                  </form>
              </td>
            </tr>
               @endforeach
        </table>
      
       </div>
    </div>

    <div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <form action="{{ route('barang.store') }}" method="post" class="modal-content">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <label>Kode</label>
              <input type="text" class="form-control mt-1" name="code" value="{{ 'BRG-'.time() }}" readonly required>
              <label class="mt-3">Nama <span class="text-danger">*</span></label>
              <input type="text" class="form-control mt-1" name="nama" required>
              <label class="mt-3">Harga <span class="text-danger">*</span></label>
              <input type="number" class="form-control mt-1" name="harga" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-sm rounded-0">Tambah</button>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="editBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <form method="post" id="actionBarang" class="modal-content">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Barang</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <label>Kode</label>
              <input type="text" class="form-control mt-1" value="" id="codeBarang" readonly>
              <label class="mt-3">Nama <span class="text-danger">*</span></label>
              <input type="text" class="form-control mt-1" value="" name="nama" id="namaBarang">
              <label class="mt-3">Harga <span class="text-danger">*</span></label>
              <input type="number" class="form-control mt-1" value="" name="harga" id="hargaBarang">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-sm rounded-0">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <script>
      function editBarang(endpoint){
        $.ajax({
          url:endpoint,
          method:'get',
          success:function(response){
            if(response){
              $('#actionBarang').attr('action','{{ url("/dashboard/barang") }}/'+response['id']);
              $('#codeBarang').val(response['code']);
              $('#namaBarang').val(response['nama']);
              $('#hargaBarang').val(response['harga']);
              const editBarang = new bootstrap.Modal('#editBarang')
              editBarang.show();
            }
          }
        })
      }
    </script>
@endsection