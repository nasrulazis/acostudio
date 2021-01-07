@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-2 px-3 bg-white border-bottom">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}" class="text-dark">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('payments.index')}}" class="text-dark">History Payments</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payments NO.{{date_format(date_create($orders->date),"Ymd")}}{{$orders->id}}</li>
            </ol>
        </nav>
        <div class="card col-12 d-flex flex-row flex-wrap justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-lg-3 col-md-4 col-sm-6">Orders</th>
                        <th class="col-lg-3 col-md-4 col-sm-6">Details</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>
                                <div class="w-100 h-100 d-flex flex-row flex-wrap align-items-center justify-content-center">
                                    <h5 class="m-2">NO.{{date_format(date_create($orders->date),"Ymd")}}{{$orders->id}}</h5>
                                </div>
                            </td>
                            <td class="d-flex justify-content-between">
                                <ul>
                                    @foreach($orders->order_details as $key=>$order_details)
                                    <li><h5>{{$order_details->products->name}}</h5></li>
                                    <li>Lama Sewa = {{$order_details->rent_days}} Hari</li>
                                    <li>Tanggal Sewa = {{$order_details->rent_date}}</li>
                                    <li>Tanggal Pengembalian = {{$order_details->return_date}}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                </tbody>
            </table>
            <div class="col-md-8 py-4 d-flex flex-column">
                @if($orders->status==1)
                <h1 class="h3 mb-3 font-weight-normal font-weight-bold text-center">Upload bukti Pembayaran</h1>
                <div class="d-flex justify-content-center">
                    @if(!empty($orders->image))
                    <img src="/storage/images/{{$orders->image}}" class="img-fluid" style="object-fit:cover;height:200px;width:200px;" alt="...">
                    @endif
                </div>
                <div class="col-12 px-4 pt-4">                                    
                    <h4 class="d-flex justify-content-center">Transfer Ke</h4>
                    <div class="row m-2">
                        <div class="col-12">
                            <div class="list-group d-flex flex-row" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action list-group-item-dark active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">BNI</a>
                            <a class="list-group-item list-group-item-action list-group-item-dark" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">BRI</a>
                            <a class="list-group-item list-group-item-action list-group-item-dark" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">MANDIRI</a>
                            <a class="list-group-item list-group-item-action list-group-item-dark" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">BCA</a>
                        </div>
                    </div>                
                </div>
                <div class="col-12 d-flex justify-content-center">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active text-center" id="list-home" role="tabpanel" aria-labelledby="list-home-list">a/n Acostudio<h3>5046772</h3></div>
                        <div class="tab-pane fade text-center" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">a/n Acostudio<h3>563101017240538</h3></div>
                        <div class="tab-pane fade text-center" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">a/n Acostudio<h3>1392307588</h3></div>                  
                        <div class="tab-pane fade text-center" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">a/n Acostudio<h3>1300010553256</h3></div>
                        </div>
                    </div>
                    <p class="text-center">Pastikan pembayaran tertuju kepada no rekening atas nama <b>Acostudio</b></p>
                </div>
                <form method="POST" action="{{route('payments.update',['id' => $orders->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group d-flex flex-column align-items-center">
                        <p class="h5 m-0">Total Harga = Rp.{{$orders->price_total}}</p>
                    </div>
                    <div class="form-group d-flex flex-column align-items-center">
                        <div class="custom-file">
                        <input id="image" name="image" type="file" class="custom-file-input">
                        <label for="image" class="custom-file-label text-truncate">Upload Payments</label>
                        </div>
                    </div>
                    <div class="form-group d-flex flex-column align-items-center">
                        @if(empty($orders->image))
                        <button type="submit" class="w-100 btn btn-dark">
                            {{ __('Upload') }}
                        </button>
                        @else
                        <button type="submit" class="w-100 btn btn-dark">
                            {{ __('Update') }}
                        </button>
                        @endif
                    </div>
                </form>
                @elseif($orders->status==2)
                <h1 class="h3 mb-3 font-weight-normal font-weight-bold text-center">Silahkan Menggunakan Produk</h1>
                <div class="col-12 d-flex justify-content-center mt-4">
                    <form action="{{route('orders.finish',['id' => $orders->id])}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark">Selesai</button>
                    </form>
                </div>
                @elseif($orders->status==3)
                <h1 class="h3 mb-3 font-weight-normal font-weight-bold text-center">Selesai</h1>
                @else
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    $('.custom-file-input').on('change', function() { 
    let fileName = $(this).val().split('\\').pop(); 
    $(this).next('.custom-file-label').addClass("selected").html(fileName); 
    });
</script>
@endsection
