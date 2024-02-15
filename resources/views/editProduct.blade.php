@extends('layouts.main')

@section('container')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Product Information</strong>
                </div>
                <div class="pull-right">
                    <a href="/adminProduct" class="btn btn-success btn-sm">
                        <i class="fa fa-undo"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <img src="{{ asset('/storage/product_images/'.$product->image) }}" alt="{{ $product->title }} Cover" width="300px" class="rounded mx-auto d-block img-thumbnail">
                <form action="/update-product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="name" value="{{ old('name', $product->name) }}">
                      @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label">Category</label>
                  
                        <select type="text" class="form-select" name="category_id" id="exampleInputEmail" aria-describedby="emailHelp">
                          <option selected>Select available category</option>
                          @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                  
                  
                  
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Price" name="price" value="{{ old('price', $product->price) }}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Total Product</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Total Product" name="total_product" value="{{ old('total_product', $product->total_product) }}">
                        @error('total_product')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Product" name="image" value="{{ old('image', $product->image) }}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                  </form>



            </div>
        </div>
        
    </div>

</div>


@endsection