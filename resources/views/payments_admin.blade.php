@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-2 px-3 bg-white border-bottom">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}" class="text-dark">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payments</li>
            </ol>
        </nav>
        <!-- product -->
        <div class="col-md-12 py-4 d-flex flex-wrap">
            <table class="table">
                <thead>
                <tr>
                    <th class="col-lg-3 col-md-4 col-sm-6">Orders</th>
                    <th class="col-lg-3 col-md-4 col-sm-6">Details</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($orders as $key=>$order)
                    <tr class="clickable-row" data-href="" data-toggle="modal" data-target="#exampleModal{{$order->id}}">
                        <td>
                            <div class="w-100 h-100 d-flex flex-row flex-wrap align-items-center justify-content-center">
                                <h5 class="m-2">NO.{{date_format(date_create($order->date),"Ymd")}}{{$order->id}}</h5>
                                @if($order->status==2||$order->status==3)
                                <i class="far fa-check-circle text-success"></i>
                                @endif
                                </div>
                            </td>
                        <td>
                            <ul>
                                @foreach($order->order_details as $key=>$order_details)
                                    <li><h5>{{$order_details->products->name}}</h5></li>
                                    <li>Lama Sewa = {{$order_details->rent_days}} Hari</li>
                                    <li>Tanggal Sewa = {{$order_details->rent_date}}</li>
                                    <li>Tanggal Pengembalian = {{$order_details->return_date}}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="text-dark">
                            {!! $orders->links() !!}
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End Container -->

<!-- Modal Products-->
@foreach($orders as $key=>$orders)
<div class="modal fade" id="exampleModal{{$orders->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$orders->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NO.{{date_format(date_create($orders->date),"Ymd")}}{{$orders->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center flex-wrap">
            <img src="/storage/images/{{$orders->image}}" class="img-fluid" style="object-fit:cover;height:250px;width:250px;" alt="...">
                <div class="col-lg-6 p-2">
                    <ul>
                        @foreach($orders->order_details as $key=>$order_details)
                            <li><h5>{{$order_details->products->name}}</h5></li>
                            <li>Lama Sewa = {{$order_details->rent_days}} Hari</li>
                            <li>Tanggal Sewa = {{$order_details->rent_date}}</li>
                            <li>Tanggal Pengembalian = {{$order_details->return_date}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark col-2" data-dismiss="modal">Close</button>
                @if($orders->status==1)
                <a href="{{route('payments.verify')}}?id={{$orders->id}}" class="btn btn-dark col-2">Verify</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- row clicckable -->
<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            // window.location = $(this).data("href");
        });
    });
</script>
@endsection
