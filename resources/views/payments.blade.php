@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-2 px-3 bg-white border-bottom">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}" class="text-dark">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">History Payments</li>
            </ol>
        </nav>
        <div class="card col-12 d-flex flex-row flex-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-lg-3 col-md-4 col-sm-6">Orders</th>
                        <th class="col-lg-3 col-md-4 col-sm-6">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key=>$orders)
                        <tr class="clickable-row" data-href="{{route('payments.edit',['id' => $orders->id])}}">
                            <td>
                                <div class="w-100 h-100 d-flex flex-row flex-wrap align-items-center justify-content-center">
                                    <h5 class="m-2">NO.{{date_format(date_create($orders->date),"Ymd")}}{{$orders->id}}</h5>
                                </div>
                            </td>
                            <td class="d-flex flex-column justify-content-between">
                                <ul>
                                    @foreach($orders->order_details as $key=>$order_details)
                                    <li><h5>{{$order_details->products->name}}</h5></li>
                                    <li>Lama Sewa = {{$order_details->rent_days}} Hari</li>
                                    <li>Tanggal Sewa = {{$order_details->rent_date}}</li>
                                    <li>Tanggal Pengembalian = {{$order_details->return_date}}</li>
                                    @endforeach
                                </ul>
                                @if($orders->status==1)
                                <h6>Status = Menunggu Pembayaran/Verifikasi</h6>
                                @elseif($orders->status==2)
                                <h6>Status = Silahkan Mengambil Produk</h6>
                                @elseif($orders->status==3)
                                <h6>Status = Selesai</h6>
                                @else
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- row clicckable -->
<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@endsection
