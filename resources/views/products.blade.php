@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th>Product</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ $product->price }} &euro;</td>
                                    <td><a href={{ "checkout?product_id=".$product->id}}           class="btn btn-primary btn-sm">buy</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

