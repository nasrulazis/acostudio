<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;
use App\Products;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saldo=Transactions::where('user_id',Auth::user()->id)->where('status',1)->get();
        $saldo_tunda=Transactions::where('user_id',Auth::user()->id)->where('status',0)->get();
        $total_saldo=0;
        $saldo_ditunda=0;
        foreach($saldo as $key=>$saldo){
            $total_saldo+=$saldo->money;
        }
        foreach($saldo_tunda as $key=>$saldo_tunda){
            $saldo_ditunda+=$saldo_tunda->money;
        }
        $products=Products::where('user_id',Auth::user()->id)->where('status',2)->get();
        $count_products=count($products);
        return view('profile',compact('total_saldo','saldo_ditunda','count_products'));
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
        //
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
