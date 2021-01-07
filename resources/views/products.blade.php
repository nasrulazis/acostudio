@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-2 px-3 bg-white border-bottom">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}" class="text-dark">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
        <!-- product -->
        <div class="col-md-12 py-4 d-flex flex-wrap">
            <table class="table">
                <thead>
                <tr>
                    <th class="col-lg-3 col-md-4 col-sm-6">Products</th>
                    <th class="col-lg-3 col-md-4 col-sm-6">Details</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($products as $key=>$product)
                    <tr class="clickable-row" data-href="" data-toggle="modal" data-target="#exampleModal{{$product->id}}">
                        <td>
                            <div class="w-100 h-100 d-flex flex-row flex-wrap align-items-center justify-content-center">
                                <img src="/storage/images/{{$product->image}}" class="img-fluid" style="object-fit:cover;height:100px;width:100px;" alt="...">
                                <h5 class="m-2">{{$product->name}}</h5>
                                </div>
                            </td>
                        <td>
                            <ul>
                                <li>Rp.{{$product->price}}/hari</li>
                                <li>{{ str_limit($product->description, $limit = 150, $end = '...') }}</li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- End Container -->

<!-- Modal Products-->
@foreach($products as $key=>$product)
<div class="modal fade" id="exampleModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$product->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$product->name}}</h5>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center flex-wrap">
                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                    <img src="/storage/images/{{$product->image}}" class="img-fluid" style="object-fit:cover;height:200px;width:200px;" alt="...">
                </div>
                <div class="col-lg-6 p-2">
                    <ul>
                        <li>Rp.{{$product->price}}/hari</li>
                        <li>{{$product->description}}</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark col-2" data-dismiss="modal">Close</button>
                <a href="{{route('products.show', ['id' => $product->id])}}" class="btn btn-dark col-2">Rent Now</a>
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
