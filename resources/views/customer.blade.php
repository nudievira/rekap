@extends('template')
@section('body')
    <div class="container mt-5 p-3 pt-5 p-lg-5 shadow">
      
       <div class="p-3">
        <div class="d-flex justify-content-center justify-content-lg-start">
          <a class="btn btn-sm btn-success rounded-0 mb-4" data-bs-toggle="modal" data-bs-target="#tambahCustomer">+ Tambah</a>
        </div>
        <table id="myTable" class="table table-bordered" style="width:100%">
            <thead class="bg-light">
                <tr>
                    <th class="text-nowrap">No</th>
                    <th class="text-nowrap">kode</th>
                    <th class="text-nowrap">Nama</th>
                    <th class="text-nowrap">telp</th>
                    <th class="text-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
              @php
                  $no = 0;
              @endphp
               @foreach ($customer as $item)
               @php
                   $no++;
               @endphp
               <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->telp }}</td>
                <td class="text-nowrap d-flex">
                  <a class="btn btn-sm btn-warning rounded-0 me-2" onclick="editCustomer('{{ route('customer.show',$item->id) }}')"><i class="bi bi-pencil me-2"></i>Edit</a>
                  <form action="{{ route('customer.destroy',$item->id) }}" method="post">
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

    <div class="modal fade" id="tambahCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <form action="{{ route('customer.store') }}" method="post" class="modal-content">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah customer</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <label>kode</label>
              <input type="text" class="form-control mt-1" name="kode" value="{{ 'CUS-'.time() }}" readonly required>
              <label class="mt-3">Nama <span class="text-danger">*</span></label>
              <input type="text" class="form-control mt-1" name="name" required>
              <label class="mt-3">telp <span class="text-danger">*</span></label>
              <input type="number" class="form-control mt-1" name="telp" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-sm rounded-0">Tambah</button>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="editCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <form method="post" id="actionCustomer" class="modal-content">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Customer</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <label>kode</label>
              <input type="text" class="form-control mt-1" value="" id="kodeCustomer" readonly>
              <label class="mt-3">Nama <span class="text-danger">*</span></label>
              <input type="text" class="form-control mt-1" value="" name="name" id="nameCustomer">
              <label class="mt-3">telp <span class="text-danger">*</span></label>
              <input type="number" class="form-control mt-1" value="" name="telp" id="telpCustomer">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-sm rounded-0">Simpan</button>
          </div>
        </form>
      </div>
    </div>

    <script>
      function editCustomer(endpoint){
        $.ajax({
          url:endpoint,
          method:'get',
          success:function(response){
            if(response){
              $('#actionCustomer').attr('action','{{ url("/dashboard/customer") }}/'+response['id']);
              $('#kodeCustomer').val(response['kode']);
              $('#nameCustomer').val(response['name']);
              $('#telpCustomer').val(response['telp']);
              const editCustomer = new bootstrap.Modal('#editCustomer')
              editCustomer.show();
            }
          }
        })
      }
    </script>
@endsection