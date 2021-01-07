@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- carousel -->
        <div class="col-md-12">
            <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Get Your Gear & Hunt</h5>
                            <p>Sewa peralatan fotografi cepat dan sesuai dengan keinginanmu!</p>
                        </div>
                        <img src="/storage/acostudio/1.png" class="d-block w-100 img-fluid" alt="...">
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Rent Your Gear & Make Money</h5>
                            <p>Sewakan peralatan fotografimu dan dapatkan uang cepat!</p>
                        </div>
                        <img src="/storage/acostudio/2.png" class="d-block w-100 img-fluid" alt="...">
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Show Your Skill To The World</h5>
                            <p>Tunjukkan pada dunia foto terbaikmu!</p>
                        </div>
                        <img src="/storage/acostudio/3.png" class="d-block w-100 img-fluid" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-12 text-center mt-4">
            <h4>PRODUCTS</h4>
        </div>
        <!-- product -->
        <div class="col-md-12 py-4 d-flex flex-wrap">
            @foreach($products as $key=>$product)
            <a href="{{route('products.show', ['id' => $product->id])}}" class="col-lg-3 col-md-4 col-sm-12 text-decoration-none text-dark">
                <div class="card px-2 border-0">
                    <img src="/storage/images/{{$product->image}}" class="img-fluid mt-4" style="object-fit:cover;height:200px;" alt="...">
                    <div class="card-body text-center">
                        <h5>{{$product->name}}</h5>
                        <p class="card-text">Rp.{{$product->price}} /hari</p>
                    </div>
                </div>
            </a>
            @endforeach
            
        </div>
    </div>
</div>
@endsection
