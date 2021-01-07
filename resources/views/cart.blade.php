@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-2 px-3 bg-white border-bottom">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}" class="text-dark">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
        <div class="card col-12 d-flex flex-row flex-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-lg-3 col-md-4 col-sm-6">Products</th>
                        <th class="col-lg-3 col-md-4 col-sm-6">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($orders))
                    <tr>
                        <td>No Products in cart</td>
                    </tr>
                    @else
                    @foreach($orders->order_details as $key=>$order_details)
                    <tr>
                        <td>
                            <div class="w-100 h-100 d-flex flex-row flex-wrap align-items-center justify-content-center">
                                <img src="/storage/images/{{$order_details->products->image}}" class="img-fluid" style="object-fit:cover;height:100px;width:100px;" alt="...">
                                <h5 class="m-2">{{$order_details->products->name}}</h5>
                            </div>
                        </td>
                        <td class="d-flex justify-content-between">
                            <ul>
                                <li>Biaya Sewa = Rp.{{$order_details->products->price}}/Hari</li>
                                <li>Total Sewa = Rp.{{$order_details->price}}</li>
                                <li>Lama Sewa = {{$order_details->rent_days}} Hari</li>
                                <li>Tanggal Sewa = {{$order_details->rent_date}}</li>
                                <li>Tanggal Pengembalian = {{$order_details->return_date}}</li>
                            </ul>
                            <div>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$order_details->id}}"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td><h4 class="m-0 h-100 align-items-center d-flex"> Total Biaya = Rp.{{$orders->price_total}}</h4></td>
                        <td class="justify-content-end d-flex">
                            <button type="submit" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">Checkout</button>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Checkout-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Checkout Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center flex-wrap">
                Anda Yakin?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark col-2" data-dismiss="modal">Close</button>
                <form action="{{route('orders.checkout')}}" class="col-2 p-0" method="post">
                    @csrf
                    <button type="submit" class="btn btn-dark w-100">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if(empty($products))
@else

<!-- Modal Products-->
@foreach($orders->order_details as $key=>$order_details)
<div class="modal fade" id="exampleModal{{$order_details->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$order_details->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Sewa {{$order_details->products->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center flex-wrap">
                Anda Yakin?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark col-2" data-dismiss="modal">Close</button>
                <form action="{{route('orders.delete')}}?id={{$order_details->id}}" class="col-2 p-0" method="post">
                    @csrf
                    <button type="submit" class="btn btn-dark w-100">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
@endsection
