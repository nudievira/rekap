<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Data Customer';
        $data['customer'] = Customer::all();
        return view('customer',$data);

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
            'kode'=>'required',
            'name'=>'required|max:50',
            'telp'=>'required|numeric|min:1'
        ]);

        $action = Customer::create($data);
        if($action){
            return redirect()->route('customer.index')->with('success','Customer Ditambah !');
        }else{
            return redirect()->route('customer.index')->with('error','customer Gagal Ditambah !');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name'=>'required|max:50',
            'telp'=>'required|numeric|min:1'
        ]);

        $action = $customer->update($data);
        if($action){
            return redirect()->route('customer.index')->with('success','customer Diedit !');
        }else{
            return redirect()->route('customer.index')->with('error','customer Gagal Diedit !');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $action = $customer->delete();
        if($action){
            return redirect()->route('customer.index')->with('success','customer Dihapus !');
        }else{
            return redirect()->route('customer.index')->with('error','customer Gagal Dihapus !');
        }

    }
}
