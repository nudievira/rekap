<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sales;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\SalesDetail;
use Illuminate\Http\Request;
use DB;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Tambah Transaksi';
        $data['customer'] = Customer::all();
        $data['barang'] = Barang::all();
        return view('form',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode'=>'required',
            'tanggal'=>'required',
            'cust_id'=>'required|numeric',
            'diskon2'=>'required|numeric|min:0',
            'unit2'=>'required',
            'ongkir'=>'required|numeric|min:0',
            'id_barang'=>'required',
            'kuantitas'=>'required|min:0',
            'diskon'=>'required|min:0',
            'unit_diskon'=>'required'
        ]);

        $sub_total_array = [];
    
        $data_sales_detail = [];

        foreach($request->id_barang as $index => $value){
            $harga_barang = Barang::find($request->id_barang[$index])->harga;
            $unit_diskon = $request->unit_diskon[$index];
            $harga_bandrol = $harga_barang * $request->kuantitas[$index];

            $diskon = 0;
            $harga_diskon = 0;
            
            if($unit_diskon == '%'){
                $diskon = $harga_bandrol * $request->diskon[$index] / 100;
                $harga_diskon = $harga_bandrol - $diskon;
                
            }
            if($unit_diskon == 'Rp'){
                $diskon = $request->diskon[$index];
                $harga_diskon = $harga_bandrol - $diskon;
            }

            array_push($sub_total_array,$harga_diskon);
            
            $rs = [
                'sales_id'=>0,
                'barang_id'=>$request->id_barang[$index],
                'harga_bandrol'=>$harga_bandrol,
                'kuantitas'=>$request->kuantitas[$index],
                'diskon'=>$diskon,
                'harga_diskon'=>$harga_diskon,
                'total'=>$harga_diskon
            ];
            array_push($data_sales_detail, $rs);
        }

        $sub_total = array_sum($sub_total_array);
        $single_unit = $request->unit2;
        $single_diskon = $request->diskon2;
        $ongkir = $request->ongkir;

        if($single_unit == '%'){
            $single_diskon = $sub_total * $single_diskon / 100;
        }
        $total_bayar = $sub_total - $single_diskon + $ongkir;

        $data_sales = [
            'kode'=>$request->kode,
            'tanggal'=>$request->tanggal,
            'user_id'=>auth()->user()->id,
            'cust_id'=>$request->cust_id,
            'sub_total'=>$sub_total,
            'diskon'=>$single_diskon,
            'ongkir'=>$request->ongkir,
            'total_bayar'=>$total_bayar,

        ];

        $sales = Sales::create($data_sales);

        foreach($data_sales_detail as $item){
            $item['sales_id'] = $sales->id;
            SalesDetail::create($item);
        }

        if($sales){
            return redirect()->route('transaksi')->with('success','Transaksi Dibuat !');
        }else{
            return redirect()->route('transaksi')->with('error','Transaksi Gagal Dibuat !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
