@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-2 px-3 bg-white border-bottom">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}" class="text-dark">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('products.index')}}" class="text-dark">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$products->name}}</li>
            </ol>
        </nav>
        <!-- product -->
        <div class="col-md-12 py-4 d-flex flex-wrap justify-content-center" >
            
            <table class="table">
                <thead>
                <tr>
                    <th class="col-lg-3 col-md-4 col-sm-6">Products</th>
                    <th class="col-lg-3 col-md-4 col-sm-6">Details</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="w-100 h-100 d-flex flex-row flex-wrap align-items-center justify-content-center">
                                <img src="/storage/images/{{$products->image}}" class="img-fluid" style="object-fit:cover;height:250px;width:250px;" alt="...">
                                <h5 class="m-2">{{$products->name}}</h5>
                            </div>
                        </td>
                        <td>
                            <ul>
                                <li>Rp.{{$products->price}}/hari</li>
                                <li>{{$products->description}}</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            <form action="{{route('orders')}}?id={{$products->id}}" class="col-8" method="POST">
                @csrf
                <div class="form-group d-flex align-items-center ">
                    <label for="rent_date" class="col-2">Rent Date</label>
                    <input type="date" name="rent_date" class="form-control col-10">
                </div>
                <div class="form-group d-flex align-items-center">
                    <label for="return_date" class="col-2">Return Date</label>
                    <input type="date" name="return_date" class="form-control col-10 ">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark col-2">Rent Now</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Container -->

@endsection
