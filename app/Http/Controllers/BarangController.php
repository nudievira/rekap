<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Data Barang';
        $data['barang'] = Barang::all();
        return view('barang',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code'=>'required',
            'nama'=>'required|max:50',
            'harga'=>'required|numeric|min:1'
        ]);

        $action = Barang::create($data);
        if($action){
            return redirect()->route('barang.index')->with('success','Barang Ditambah !');
        }else{
            return redirect()->route('barang.index')->with('error','Barang Gagal Ditambah !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return $barang;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $data = $request->validate([
            'nama'=>'required|max:50',
            'harga'=>'required|numeric|min:1'
        ]);

        $action = $barang->update($data);
        if($action){
            return redirect()->route('barang.index')->with('success','Barang Diedit !');
        }else{
            return redirect()->route('barang.index')->with('error','Barang Gagal Diedit !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $action = $barang->delete();
        if($action){
            return redirect()->route('barang.index')->with('success','Barang Dihapus !');
        }else{
            return redirect()->route('barang.index')->with('error','Barang Gagal Dihapus !');
        }
    }
}
