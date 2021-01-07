<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Products;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role==2){
            $products = Products::orderBy('updated_at', 'desc')->simplePaginate(5);
            return view('products_admin',compact('products'));
        }else{
            $products = Products::where('status',2)->orderBy('updated_at', 'desc')->simplePaginate(5);
            return view('products',compact('products'));
        }
    }

    public function myproducts(){
        if(Auth::user()->role==2){
            return back();
        }else{
            $products = Products::where('user_id',Auth::user()->id)->orderBy('updated_at', 'desc')->simplePaginate(5);
            return view('myproducts',compact('products'));
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products_admin_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Products = New Products;
        $Products->name = $request->name;
        if(!empty($request->file('image'))){
            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $location=public_path('/storage/images');
            $file->move($location,$filename);
            $Products->image=$filename;                       
        }
        $Products->price = $request->price;
        $Products->description = $request->description;
        $Products->status = 1;
        $Products->user_id = Auth::user()->id;
        $Products->save();
        alert()->success('Success','Berhasil Menambah Product');
        if(Auth::user()->role==2){
            return redirect()->route('products.index');
        }else{
            return redirect()->route('products.myproducts');
        }
    }

    public function verify()
    {
        $id=$_GET['id'];
        $Products = Products::where('id',$id)->first();
        if($Products->status==2){
            $Products->status = 1;
            $Products->save();
            alert()->success('Success','Berhasil Hapus Verifikasi Product');
        }else{
            $Products->status = 2;
            $Products->save();
            alert()->success('Success','Berhasil Verifikasi Product');
        }
        return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Products::where('id',$id)->first();
        return view('products_detail',compact('products'));
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
        return view('products_admin_update',compact('products'));
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
        $Products = Products::where('id',$id)->first();
        $Products->name = $request->name;
        if(!empty($request->file('image'))){
            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $location=public_path('/storage/images');
            $file->move($location,$filename);
            $Products->image=$filename;                       
        }
        $Products->price = $request->price;
        $Products->description = $request->description;
        $Products->save();
        alert()->success('Success','Berhasil Mengubah Produk');
        if(Auth::user()->role==2){
            return redirect()->route('products.index');
        }else{
            return redirect()->route('products.myproducts');
        }
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
    public function delete()
    {
        $id=$_GET['id'];
        $products = Products::find($id);
        $products->delete();
        alert()->success('Success','Berhasil Menghapus Produk');
        return back();
    }
}
