@extends('layouts.main')

@section('container')
<div class="content mt-3">
    <div class="animated fadeIn">
        {{-- <div class="card">
            <img src="{{ asset('/storage/product_images/'.$product->image) }}" alt="{{ $product->title }} Cover" width="300px" class="rounded mx-auto d-block img-thumbnail mt-3">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">Price: {{ $product->price}}</p>
                <p class="card-text">Total Product: {{ $product->total_product }}</p>
                <p class="card-text">Category: {{ $product->category->name }}</p>
            </div>
        </div> --}}

        <div class="card mb-3" style="max-width: 1500px;">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{ asset('/storage/product_images/'.$product->image) }}" class="img-fluid rounded-start" alt="{{ $product->title }}">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><i class="menu-icon fa fa-money"></i> Price: {{ $product->price}}</p>
                <p class="card-text"><i class="menu-icon fa fa-shopping-cart"></i> Total Product: {{ $product->total_product }}</p>
                <p class="card-text"><i class="menu-icon fa fa-tags"></i> Category: {{ $product->category->name }}</p>
                </div>
              </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Order Information</strong>
                </div>
                <div class="pull-right">
                    <a href="/userProduct" class="btn btn-success btn-sm">
                        <i class="fa fa-undo"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if (empty($invoice_header))
                    <form action="/store-order/{{ $product->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Shipping Address</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Shipping Address" name="shipping_address">
                            @error('shipping_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Postal Code</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Postal Code" name="postal_code">
                            @error('postal_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Quantity</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Quantity" name="quantity" value="{{ old('quantity') }}">
                            @error('quantity')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                            
                        <button type="submit" class="btn btn-warning mt-3">add to cart</button>
                    </form>
                @else
                    <form action="/store-order/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}"> 

                        <div class="form-group">
                            <label for="exampleInputEmail1">Quantity</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Quantity" name="quantity" value="{{ old('quantity') }}">
                            @error('quantity')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                            
                        <button type="submit" class="btn btn-warning mt-3">add to cart</button>
                    </form>
                @endif
            </div>
        </div>
        
    </div>

</div>


@endsection