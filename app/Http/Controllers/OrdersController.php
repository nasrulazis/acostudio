<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\Order_Details;
use App\Products;
use App\Transactions;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use DateTime;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $orders= Orders::where('user_id',Auth::user()->id)->where('status',0)->first();
        if(empty($orders)){
            return view('cart',compact('orders'));
        }else{
            $order_details= Order_Details::where('orders_id',$orders->id)->get();
            return view('cart',compact('orders','order_details'));
        }
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
        $products = Products::where('id',$id)->first();
        return view('products_order',compact('products'));
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
        $orders->status=3;
        $orders->update();
        foreach($orders->order_details as $key=>$order_details){
            $transaction = New Transactions;
            $transaction->user_id = $order_details->products->user_id;
            $transaction->money = $order_details->price;
            $transaction->status = 1;
            $transaction->save();
            $transaction = New Transactions;
            $transaction->user_id = $order_details->products->user_id;
            $transaction->money = -$order_details->price;
            $transaction->status = 0;
            $transaction->save();
        }
        alert()->success('Success','Orders Berhasil Diselesaikan!');
        return redirect()->route('payments.index');
    }
    public function orders(Request $request){
        $id=$_GET['id'];
        $products = Products::where('id',$id)->first();
        $orders = Orders::where('user_id',Auth::user()->id)->where('status',0)->first();
        if(empty($orders)){
            $order = new Orders;
            $order->user_id = Auth::user()->id;
            $order->price_total = 0;
            $order->status = 0;
            $order->save();
        }
        $orders = Orders::where('user_id',Auth::user()->id)->where('status',0)->first();
        $check_order_details=Order_Details::where('products_id',$products->id)->where('orders_id',$orders->id)->first();
        if(empty($check_order_details)){
            $order_details = new Order_Details;
            $order_details->products_id=$products->id;
            
            $order_details->orders_id=$orders->id;
            $order_details->rent_date=$request->rent_date;
            $order_details->return_date=$request->return_date;
            $rentdate = new DateTime($order_details->rent_date);
            $returndate = new DateTime($order_details->return_date);
            $interval = $rentdate->diff($returndate);
            $order_details->rent_days=$interval->format("%d");
            $order_details->price=$products->price*$order_details->rent_days;
            $order_details->save();
        }else{
            $order_details=Order_Details::where('products_id',$products->id)->where('orders_id',$orders->id)->first();
            $order_details->rent_date=$request->rent_date;
            $order_details->return_date=$request->return_date;
            $rentdate = new DateTime($order_details->rent_date);
            $returndate = new DateTime($order_details->return_date);
            $interval = $rentdate->diff($returndate);
            $order_details->rent_days=$interval->format("%d");
            $order_details->price=$products->price*$order_details->rent_days;
            $order_details->update();
        }
        $order_details=Order_Details::where('orders_id',$orders->id)->get();
        $orders = Orders::where('user_id',Auth::user()->id)->where('status',0)->first();
        $orders->price_total = 0;
        foreach($order_details as $key=> $data){
            $orders->price_total +=$data->price; 
        }       
        $orders->update();
        alert()->success('Success','Berhasil Menambahkan Ke Keranjang!');
        return back();
    }
    //checkout
    public function checkout()
    {
        $orders = Orders::where('user_id',Auth::user()->id)->where('status',0)->first();
        $order_details=Order_Details::where('orders_id',$orders->id)->get();
        $orders->status = 1;
        $orders->update();
        $orders->date = $orders->updated_at;
        $orders->update();
        alert()->success('Success','Berhasil CheckOut Silahkan Melakukan Pembayaran!');
        return back();
    }
    // Delete From Orders 
    public function delete()
    {
        $id=$_GET['id'];
        $order_details=Order_Details::find($id);
        $order_details->delete();
        $orders = Orders::where('user_id',Auth::user()->id)->where('status',0)->first();
        $order_details=Order_Details::where('orders_id',$orders->id)->get();
        $orders->price_total = 0;
        foreach($order_details as $key=> $data){
            $orders->price_total +=$data->price; 
        }       
        $orders->update();
        alert()->success('Success','Berhasil Menghapus Data');

        return back();
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
