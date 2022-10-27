@extends('template')
@section('body')

    <form method="post" action="{{ route('form.store') }}" class="container mt-5 p-3 pt-5 p-lg-5 shadow">
       @csrf
      <div class="row row-cols-1 row-cols-lg-2 m-0">
           <div class="col">
               <b class="d-block p-2 bg-light border">Transaksi</b>
               <label class="mt-3">No</label>
               <input type="text" class="form-control mt-1 @error('kode') is-invalid @enderror" value="{{date('Ym')}}-0001" name="kode" readonly>
               <label class="mt-3">Tanggal <span class="text-danger">*</span></label>
               <input type="date" class="form-control mt-1  @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ date('Y-m-d',time()) }}">
               
           </div>
           <div class="col mt-5 mt-lg-0">
            <b class="d-block p-2 bg-light border">Customer</b>
            <label class="mt-3">Kode</label>
            <input type="text" class="form-control mt-1" id="codeCustomer" readonly data-bs-toggle="modal" data-bs-target="#pilihCustomer">
            <label class="mt-3">Nama</label>
            <input type="text" class="form-control mt-1" id="namaCustomer" readonly data-bs-toggle="modal" data-bs-target="#pilihCustomer">
            <label class="mt-3">Telp</label>
            <input type="number" class="form-control mt-1" id="teleponCustomer" readonly data-bs-toggle="modal" data-bs-target="#pilihCustomer">
            <input type="hidden" name="cust_id" id="idCustomer">
          </div>
       </div>

       <div class="p-3">
        <button type="button" class="btn btn-sm btn-success rounded-0 mt-5" data-bs-toggle="modal" data-bs-target="#tambahBarang">+ Tambah Barang</button>
        <div class="table_responsive">
         <table class="table table-bordered mt-3" id="tabelBarang">
             <thead class="bg-light">
               <tr>
                 <th class="text-nowrap" scope="col">No</th>
                 <th class="text-nowrap" scope="col">Kode Barang</th>
                 <th class="text-nowrap" scope="col">Nama Barang</th>
                 <th class="text-nowrap" scope="col">Kuantitas <span class="text-danger">*</span></th>
                 <th class="text-nowrap" scope="col">Harga Bandrol</th>
                 <th class="text-nowrap" scope="col">Diskon <span class="text-danger ms-1">*</span>
                    
                 </th>
                 <th class="text-nowrap" scope="col">Harga Diskon</th>
                 <th class="text-nowrap" scope="col">Total</th>
                 <th class="text-nowrap" scope="col">Action</th>
               </tr>
             </thead>
             <tbody>
              <tr class="d-none" id="cloneBarang">
                <th id="noBarang"></th>
                <td class="d-none"><input type="text" id="idBarang"><input type="text" value="%" id="unitDiskon"></td>
                <td id="codeBarang"></td>
                <td id="namaBarang"></td>
                <td><input id="kuantitasBarang" type="number" class="form-control" value="1" style="width: 70px"></td>
                <td id="hargaBarang">0</td>
                <td class="d-flex justify-content-between">
                  <input id="diskonBarang" type="number" class="form-control" value="0" style="width: 100px">
                  <div class="dropdown ">
                    <button id="btnUnit" class="btn p-0 px-2 shadow-none border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">%</button>
                    <ul class="dropdown-menu">
                      <li><span class="dropdown-item" id="selectUnitPct">%</span></li>
                      <li><span class="dropdown-item" id="selectUnitRp">Rp</span></li>
                    </ul>
                  </div>
                </td>
                <td id="hargaDiskonBarang">0</td>
                <td id="hargaTotalBarang">0</td>
                <td class="text-nowrap">
                    <a id="editBarangBtn" data-bs-toggle="modal" data-bs-target="#editBarang" class="btn btn-sm btn-warning rounded-0 me-2"><i class="bi bi-pencil me-2"></i>Edit</a>
                    <a id="hapusBarang" class="btn btn-sm btn-danger rounded-0"><i class="bi bi-trash3 me-2"></i>Hapus</a>
                </td>
              </tr>
             </tbody>
           </table>
        </div>
      

     <div class="row row-cols-2 row-cols-lg-4 mt-5">
         <div class="col p-2">
             <b>Sub Total</b>
             <input type="text" class="form-control mt-1" id="subTotal" value="Rp 0" readonly>
         </div> 
         <div class="col p-2">
            <div class="d-flex justify-content-between">
              <b>Diskon</b>
            <div class="dropdown ">
              <button id="btnUnit2" class="btn p-0 px-2 shadow-none dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">%</button>
              <ul class="dropdown-menu">
                <li><span class="dropdown-item" id="selectUnitPct2" onclick="selectUnit2('%')">%</span></li>
                      <li><span class="dropdown-item" id="selectUnitRp2" onclick="selectUnit2('Rp')">Rp</span></li>
              </ul>
            </div>
            </div>
            <input type="number" id="diskon2" name="diskon2" class="form-control mt-1  @error('diskon2') is-invalid @enderror" value="0" onchange="hitungTotalBayar()">
            <input type="hidden" id="unitDiskon2" value="%" name="unit2">
        </div>
        <div class="col p-2">
            <b>Ongkir</b>
            <input type="number" class="form-control mt-1  @error('ongkir') is-invalid @enderror" id="ongkir" name="ongkir" value="0" onchange="hitungTotalBayar()">
        </div>
        <div class="col p-2">
            <b>Total Bayar</b>
            <input type="text" class="form-control mt-1" id="totalBayar" value="Rp 0" readonly>
        </div>
     </div>
      <div class="d-flex mt-5 justify-content-center">
          <button type="reset" class="btn btn-sm btn-danger rounded-0 me-3">Reset</button>
          <button type="submit" class="btn btn-sm btn-primary rounded-0">Simpan</button>
      </div>

       </div>
    </form>

    <div class="modal fade" id="pilihCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Customer</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @foreach ($customer as $item)
                    <li class="list-group-item d-flex border_hover" data-bs-dismiss="modal" onclick="pilihCustomer('{{ route('customer.show',$item->id) }}')">
                      <div class="overflow-hidden rounded-circle me-3" style="width: 50px; height:50px">
                          <img src="https://picsum.photos/200" style="object-fit:cover">
                      </div>
                      <div>
                          <b class="d-block">{{ $item->name }}</b>
                          <span>{{ $item->telp }}</span>
                      </div>
                      <span class="d-block ms-auto">{{ $item->kode }}</span>
                  </li>
                    @endforeach
                  </ul>
            </div>
          </div>
        </div>
      </div>
      

      <div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Barang</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @foreach ($barang as $item)
                    <li class="list-group-item d-flex border_hover" data-bs-dismiss="modal" onclick="pilihBarang('{{ route('barang.show',$item->id) }}')">
                      <div class="overflow-hidden rounded-2 me-3" style="width: 50px; height:50px">
                          <img src="https://picsum.photos/200" style="object-fit:cover">
                      </div>
                      <div>
                          <b class="d-block">{{ $item->nama }}</b>
                          <span class="text-danger">Rp {{ number_format($item->harga) }}</span>
                      </div>
                      <span class="d-block ms-auto">{{ $item->code }}</span>
                  </li>
                    @endforeach
                  </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Barang</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @foreach ($barang as $item)
                    <li class="list-group-item d-flex border_hover" data-bs-dismiss="modal" onclick="editBarang('{{ route('barang.show',$item->id) }}')">
                      <div class="overflow-hidden rounded-2 me-3" style="width: 50px; height:50px">
                          <img src="https://picsum.photos/200" style="object-fit:cover">
                      </div>
                      <div>
                          <b class="d-block">{{ $item->nama }}</b>
                          <span class="text-danger">Rp {{ number_format($item->harga) }}</span>
                      </div>
                      <span class="d-block ms-auto">{{ $item->code }}</span>
                  </li>
                    @endforeach
                  </ul>
            </div>
          </div>
        </div>
      </div>

      <script>
        function pilihCustomer(endpoint){
        $.ajax({
          url:endpoint,
          method:'get',
          success:function(response){
            if(response){
             $('#idCustomer').val(response['id']);
             $('#codeCustomer').val(response['kode']);
             $('#namaCustomer').val(response['name']);
             $('#teleponCustomer').val(response['telp']);
            }
          }
        })
      }
      var no = 0;
      
      function hitungTotalBayar(){
        let subTotal = parseFloat($('#subTotal').attr('harga'));
        let totalBayar = $('#totalBayar');

        let diskonUnit = $('#btnUnit2').text();
        let diskon = parseInt($('#diskon2').val());
        let ongkir = parseInt($('#ongkir').val());

        var result = subTotal;

        if(diskonUnit == '%'){
            result = subTotal - (subTotal * diskon /100);
        };
        if(diskonUnit == 'Rp'){
            result = subTotal - diskon;
        }

        result = result + ongkir;



        totalBayar.val('Rp '+result.toLocaleString())
      }

      function hitungSubTotal(){
        var x = document.querySelectorAll('#hargaTotalBarang');
        
        var sum = 0;
        for(var i = 1; i < x.length; i++){
          let harga = parseFloat(x[i].getAttribute('harga'));
          sum += harga;
        }
        $('#subTotal').val('Rp '+sum.toLocaleString()).attr('harga',sum)
        hitungTotalBayar()
      }
      
      function pilihBarang(endpoint){
        $.ajax({
          url:endpoint,
          success:function(response){

            if(response){
              no = no+1;
              var tableBarang = $('#tabelBarang tbody');
              var cloneBarang = $('#cloneBarang').clone().removeAttr('class id');

              cloneBarang.attr('id','barang'+no);
              cloneBarang.find('#idBarang').val(response['id']).attr('name','id_barang[]');
              cloneBarang.find('#unitDiskon').val('%').attr('name','unit_diskon[]');
              cloneBarang.find('#noBarang').text(no);
              cloneBarang.find('#codeBarang').text(response['code']);
              cloneBarang.find('#namaBarang').text(response['nama']);
              cloneBarang.find('#hargaBarang').text('Rp '+response['harga'].toLocaleString()).attr({
                'temp':response['harga'],
                'harga':response['harga']
              });
              cloneBarang.find('#hargaTotalBarang').text('Rp '+response['harga'].toLocaleString()).attr({
                'temp':response['harga'],
                'harga':response['harga']
              });
              cloneBarang.find('#hargaDiskonBarang').text('Rp '+response['harga'].toLocaleString());
              cloneBarang.find('#kuantitasBarang').attr('onchange',"hitungKuantitas('barang"+no+"',this.value)").attr('name','kuantitas[]');
              cloneBarang.find('#diskonBarang').attr('onchange',"hitungDiskon('barang"+no+"',this.value)").attr('name','diskon[]');
              cloneBarang.find('#selectUnitPct').attr('onclick',"selectUnit('barang"+no+"','%')");
              cloneBarang.find('#selectUnitRp').attr('onclick',"selectUnit('barang"+no+"','Rp')");
              cloneBarang.find('#editBarangBtn').attr('onclick',"localStorage.setItem('barang','barang"+no+"')");
              cloneBarang.find('#hapusBarang').attr('onclick',"hapusBarang('barang"+no+"')");
              cloneBarang.appendTo(tableBarang);

              hitungSubTotal();
            }
          }
        })
      }

      function editBarang(endpoint){
        var el = localStorage.getItem('barang');
        el = $('#'+el)
        $.ajax({
          url:endpoint,
          success:function(response){

            if(response){ 
              var no2 = Math.floor(Math.random()*1000);
              el.attr('id','barang'+no2)
              el.find('#idBarang').val(response['id']);
              el.find('#codeBarang').text(response['code']);
              el.find('#namaBarang').text(response['nama']);
              el.find('#hargaBarang').text('Rp '+response['harga'].toLocaleString()).attr({
                'temp':response['harga'],
                'harga':response['harga']
              });
              el.find('#hargaTotalBarang').text('Rp '+response['harga'].toLocaleString()).attr({
                'temp':response['harga'],
                'harga':response['harga']
              });
              el.find('#hargaDiskonBarang').text('Rp '+response['harga'].toLocaleString());
              el.find('#kuantitasBarang').attr('onchange',"hitungKuantitas('barang"+no2+"',this.value)").val(1);
              el.find('#diskonBarang').attr('onchange',"hitungDiskon('barang"+no2+"',this.value)").val(0);
              el.find('#selectUnitPct').attr('onclick',"selectUnit('barang"+no2+"','%')");
              el.find('#selectUnitRp').attr('onclick',"selectUnit('barang"+no2+"','Rp')");
              el.find('#btnUnit').text('%');
              el.find('#unitDiskon').val('%');
              el.find('#editBarangBtn').attr('onclick',"localStorage.setItem('barang','barang"+no2+"')");
              el.find('#hapusBarang').attr('onclick',"hapusBarang('barang"+no2+"')");
              hitungSubTotal()
            }
          }
        })
      }

      
      function hitungDiskon(el,diskon){
        el = $('#'+el);
        var hargaTotalEl = el.find('#hargaTotalBarang');
        var hargaTotal = hargaTotalEl.attr('temp');
        var unit = el.find('#btnUnit').text();

        if(diskon == ' '){
          diskon = 0;
        }
        var potongan = (parseFloat(hargaTotal) * diskon / 100);
        var result = parseFloat(hargaTotal) - potongan;

        if(unit == 'Rp'){
            result = parseInt(hargaTotal) - diskon;
        }
        
        hargaTotalEl.text('Rp '+result.toLocaleString()).attr('harga',result);
        el.find('#hargaDiskonBarang').text('Rp '+result.toLocaleString());

        hitungSubTotal()
      }

      function hitungKuantitas(el,qty){
        var element = el;
        el = $('#'+el);
        var diskon = el.find('#diskonBarang').val();
        var unit = el.find('#btnUnit').text();
        var hargaBarang = parseInt(el.find('#hargaBarang').attr('temp'));
        var hargaTotalEl = el.find('#hargaTotalBarang');

        var result = hargaBarang
        if(qty >= 1){
          result = hargaBarang * qty;
        }
        hargaTotalEl.attr('temp',result);
        el.find('#hargaBarang').text('Rp '+result.toLocaleString()).attr('harga',result);
        hitungDiskon(element,diskon);
      }

      function selectUnit(el,unit){
        element = $('#'+el);
        element.find('#btnUnit').text(unit);
        element.find('#unitDiskon').val(unit);
        var diskon = element.find('#diskonBarang').val()
        hitungDiskon(el,diskon);
      }

      function hapusBarang(elid){
        $('#'+elid).remove();
        hitungSubTotal()
      }

      function selectUnit2(unit){
        $('#btnUnit2').text(unit);
        $('#unitDiskon2').val(unit);
        hitungTotalBayar()
      }
      </script>
@endsection