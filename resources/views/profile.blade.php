@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-2 px-3 bg-white border-bottom">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}" class="text-dark">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
        <div class="card col-12 d-flex flex-row flex-wrap">
            <div class="col-lg-6 py-4 d-flex flex-column align-items-center text-center justify-content-center">
                <div class="col-lg-12 d-flex justify-content-center">
                    <img src="/storage/acostudio/1.png" class="d-block img-fluid " style="object-fit:cover;height:300px;width:300px;" alt="...">
                </div>
                <h5 class="mt-2">{{ Auth::user()->name}}</h5>
                <p class="mb-2">{{ Auth::user()->email}}</p>
                <p class="mb-2">{{ Auth::user()->birthdate}}</p>
            </div>
            <div class="col-lg-6 py-4 d-flex flex-column justify-content-center">
                <h5>Informasi Penjualan</h5>
                <h6>Produk</h6>
                <p>{{$count_products}}</p>
                <h6>Saldo</h6>
                <p>Bisa Ditarik : Rp.{{$total_saldo}}</p>
                <p>Tertunda : Rp.{{$saldo_ditunda}}</p>
            </div>
        </div>
    </div>
</div>
@endsection
