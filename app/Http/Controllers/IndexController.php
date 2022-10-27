<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sales;
use App\Models\Barang;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function transaksi(){
        $data['title'] = 'Daftar Transaksi';
        $data['data'] = auth()->user()->sales;
        return view('transaksi',$data);
    }
    public function deleteTransaksi($id){
        $sales = Sales::find($id);
        $sales_detail = $sales->sales_details;
        foreach($sales_detail as $item){
            $item->delete();
        }
        $action = $sales->delete();
        if($sales){
            return redirect()->route('transaksi')->with('success','Transaksi Dhapus !');
        }else{
            return redirect()->route('transaksi')->with('error','Transaksi Gagal Dhapus !');
        }
    }

}
