@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-2 px-3 bg-white border-bottom">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}" class="text-dark">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transaction</li>
            </ol>
        </nav>
        <!-- product -->
        <div class="col-md-12 py-4 d-flex flex-wrap">
            <table class="table">
                <thead>
                <tr>
                    <th class="col-lg-3 col-md-4 col-sm-6">Transaction</th>
                    <th class="col-lg-3 col-md-4 col-sm-6">Details</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($transaction as $key=>$transactions)
                        <tr class="clickable-row" data-href="" data-toggle="modal" data-target="#exampleModal{{$transactions->id}}">
                            <td>
                                <div class="w-100 h-100 d-flex flex-row flex-wrap align-items-center justify-content-center">
                                    <h5 class="m-2">NO.{{date_format(date_create($transactions->created_at),"Ymd")}}{{$transactions->id}}</h5>
                                </div>
                            </td>
                            <td>
                                <ul>
                                    <li><h5>{{date_format(date_create($transactions->created_at),"Y-m-d")}}</h5></li>
                                    <li>Uang {{$transactions->money}}</li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-dark">
                            <h5>Saldo = Rp.{{$transaction_total}}</h5>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-dark">
                            {!! $transaction->links() !!}
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
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
</script>
@endsection
