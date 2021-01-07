<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\Order_Details;
use App\Products;
use App\Transactions;
use Auth;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders= Orders::where('user_id',Auth::user()->id)->where('status',1)->orWhere('status',2)->orWhere('status',3)->get();
        return view('payments',compact('orders'));
    }
    
    public function admin()
    {
        $orders= Orders::orderBy('updated_at', 'desc')->paginate(5);
        return view('payments_admin',compact('orders'));
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orders= Orders::where('id',$id)->where('user_id',Auth::user()->id)->first();
        return view('payment_details',compact('orders'));
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
        $orders = Orders::find($id);
        if(!empty($request->file('image'))){
            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $location=public_path('/storage/images');
            $file->move($location,$filename);
            $orders->image=$filename;                       
            alert()->success('Success','Berhasil Mengupload Bukti Pembayaran');
        }
        $orders->update();
        return back();
    }
    
    
    public function PaymentsVerification(Request $request)
    {
        $id=$_GET['id'];
        $orders = Orders::find($id);
        $orders->status=2;
        $orders->update();
        foreach($orders->order_details as $key=>$order_details){
            $transaction = New Transactions;
            $transaction->user_id = $order_details->products->user_id;
            $transaction->money = $order_details->price;
            $transaction->status = 0;
            $transaction->save();
        }
        alert()->success('Success','Berhasil Verifikasi Pembayaran');
        return redirect()->route('payments.admin');
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
