@extends('template')
@section('body')
    <div class="container mt-5 p-3 pt-5 p-lg-5 shadow">
      
       <div class="p-3">
        <div class="d-flex justify-content-center justify-content-lg-start">
        <a href="{{ route('form.index') }}" class="btn btn-sm btn-success rounded-0 mb-4">Buat Transaksi</a>
        </div>
        <table id="myTable" class="table table-bordered" style="width:100%">
            <thead class="bg-light">
                <tr>
                    <th class="text-nowrap">No</th>
                    <th class="text-nowrap">No Transaksi</th>
                    <th class="text-nowrap">Nama Customer</th>
                    <th class="text-nowrap">Jumlah Barang</th>
                    <th class="text-nowrap">Sub Total</th>
                    <th class="text-nowrap">Diskon</th>
                    <th class="text-nowrap">Ongkir</th>
                    <th class="text-nowrap">Total</th>
                    <th class="text-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                    $grand_total = 0;
                @endphp
                @foreach ($data as $item)
                @php
                    $no++;
                    $jumlah_barang = 0;
                    foreach ($item->sales_details as $sd) {
                        $jumlah_barang += $sd->kuantitas;
                    }
                    $grand_total += $item->total_bayar;
                @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->customer->name }}</td>
                    <td>{{ number_format($jumlah_barang) }}</td>
                    <td>Rp {{ number_format($item->sub_total,2) }}</td>
                    <td>Rp {{ number_format($item->diskon,2) }}</td>
                    <td>Rp {{ number_format($item->ongkir) }}</td>
                    <td>Rp {{ number_format($item->total_bayar,2) }}</td>
                    <td>
                        <a href="{{ route('delete-transaksi',$item->id) }}" class="btn btn-sm btn-danger rounded-0"><i class="bi bi-trash3 me-2"></i>Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-light">
               <tr>
                   <td colspan="7"><b>Grand Total :</b></td>
                   <td colspan="2"><b>Rp {{ number_format($grand_total,2) }}</b></td>
               </tr>
              </tfoot>
        </table>
      
       </div>
    </div>

@endsection