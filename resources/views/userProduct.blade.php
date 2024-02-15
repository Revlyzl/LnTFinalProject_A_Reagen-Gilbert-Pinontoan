@extends('layouts.main')

@section('container')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Product List</strong>
                </div>
                <div class="pull-right">
                    <a href="/order-list" class="btn btn-warning btn-sm">
                        <i class="fa fa-shopping-cart"></i> Order in Cart
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>No.</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Total Product</th>
                        <th>Add to Cart</th>
                        {{-- <th>Edit</th>
                        <th>Delete</th> --}}
                    </thead>
                    <tbody> 
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('/storage/product_images/'.$product->image) }}" alt="{{ $product->title }} Cover" width="100px"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name}}</td>
                                <td>Rp.{{ number_format($product->price) }}</td>
                                <td>{{ number_format($product->total_product) }}</td>
                                <td class="text-center">

                                    <a href="/create-order/{{ $product->id }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus"></i>
                                    </a>                                 
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

</div>


@endsection