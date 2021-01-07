@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-2 px-3 bg-white border-bottom">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}" class="text-dark">Home</a></li>
                @if(Auth::user()->id==1)
                <li class="breadcrumb-item"><a href="{{route('products.myproducts')}}" class="text-dark">My Products</a></li>
                @else
                <li class="breadcrumb-item"><a href="{{route('products.index')}}" class="text-dark">Products</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">Update Products {{$products->name}}</li>
            </ol>
        </nav>
        <!-- product -->
        <div class="col-md-8 py-4 d-flex flex-column">
            <h1 class="h3 mb-3 font-weight-normal font-weight-bold text-center">Update Products</h1>
            <form method="POST" action="{{route('products.update',['id' => $products->id])}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group d-flex flex-column align-items-center">
                    <label for="name" class="sr-only">{{ __('Products Name') }}</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{$products->name}}" placeholder="Name" required  autofocus>
                </div>
                <div class=" d-flex justify-content-center align-items-center mb-2">
                        <img src="/storage/images/{{$products->image}}" class="img-fluid" style="object-fit:cover;height:200px;width:200px;" alt="...">
                </div>
                <div class="form-group d-flex flex-column align-items-center">
                    <div class="custom-file">
                    
                    <input id="image" name="image" type="file" class="custom-file-input">
                    <label for="image" class="custom-file-label text-truncate">Image</label>
                    </div>
                </div>
                <div class="form-group d-flex flex-column align-items-center">
                    <label for="price" class="sr-only">{{ __('Price') }}</label>
                    <input id="price" type="text" class="form-control" name="price" value="{{$products->price}}" placeholder="Price" required  autofocus>
                </div>
                <div class="form-group d-flex flex-column align-items-center">
                    <label for="description" class="sr-only">{{ __('Description') }}</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Description">{{$products->description}}</textarea>                        
                </div>
                <div class="form-group d-flex flex-column align-items-center">
                    <button type="submit" class="w-100 btn btn-dark">
                        {{ __('Update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Container -->

<!-- row clicckable -->
<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            // window.location = $(this).data("href");
        });
    });
    $('.custom-file-input').on('change', function() { 
    let fileName = $(this).val().split('\\').pop(); 
    $(this).next('.custom-file-label').addClass("selected").html(fileName); 
    });
</script>
@endsection
