@extends('layouts.main')

@section('container')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    {{-- <h3><i class="fa fa-shopping-cart"></i> Check Out</h3> --}}
                    {{-- <h3><i class="fa fa-shopping-cart"></i> Order List</h3> --}}
                    <strong><i class="fa fa-shopping-cart"></i> Order List</strong>                  
                </div>
                <div class="pull-right">
                    <a href="/userProduct" class="btn btn-success btn-sm">
                        <i class="fa fa-undo"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
                @if(!empty($invoice_header))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th >No.</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoiceDetails as $invoiceDetail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('/storage/product_images/'.$invoiceDetail->product->image) }}" alt="{{ $invoiceDetail->product->title }} Cover" width="100px"></td>
                                <td align="center">{{ $invoiceDetail->product->name }}</td>
                                <td>{{ $invoiceDetail->quantity }}</td>
                                <td>Rp.{{ number_format($invoiceDetail->product->price) }}</td>
                                <td>Rp.{{ number_format($invoiceDetail->total_price) }}</td>
                                <td>
                                    <form action="/delete-order/{{ $invoiceDetail->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" align="right"><strong>Total Price :</strong></td>
                                <td align="right"><strong>Rp. {{ number_format($invoice_header->total_price) }}</strong></td>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <a href="/purchase-confirmation" class="btn btn-success" onclick="return confirm('Anda yakin akan Check Out ?');">
                    Check Out
                </a>
                @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td align="center"><strong>There are no order added in to the cart</strong></td>
                        </tr>
                    </thead>
                </table>

                @endif
            </div>
        </div>
        
    </div>

</div>


@endsection