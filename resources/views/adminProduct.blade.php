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
                    <a href="/create-product" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i> Add Product
                    </a>
                    <a href="/create-category" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i> Add Category
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
                        <th>Harga</th>
                        <th>Jumlah Barang</th>
                        {{-- <th>Action</th> --}}
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody> 
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('/storage/product_images/'.$product->image) }}" alt="{{ $product->title }} Cover" width="100px"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name}}</td>
                                <td>Rp.{{number_format($product->price) }}</td>
                                <td>{{ number_format($product->total_product) }}</td>
                                <td align="center">

                                    <a href="/edit-product/{{ $product->id }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>                                 
                                </td>
                                <td align="center">
                                    <form action="/delete-product/{{ $product->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></button>
                                    </form>
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