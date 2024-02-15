@extends('layouts.main')

@section('container')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Category Information</strong>
                </div>
                <div class="pull-right">
                    <a href="/adminProduct" class="btn btn-success btn-sm">
                        <i class="fa fa-undo"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                @foreach ($collection as $item)
                    <div class="card-body table-responsive">
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
                                <tr>
                                    <form action="/update_address_postal/{{ $invoice_header->id }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                          <label for="exampleInputEmail1">Shipping Adress</label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="shipping_address">
                                          @error('shipping_address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                          @enderror
                                
                                        </div>
                    
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Postal Code</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="postal_code">
                                            @error('postal_code')
                                              <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                  
                                        </div>
                    
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                      </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach

                {{-- <form action="/update_address_postal/{{ $invoice_header->id }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                      <label for="exampleInputEmail1">Shipping Adress</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="shipping_address">
                      @error('shipping_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
            
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Postal Code</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" name="postal_code">
                        @error('postal_code')
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
              
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                  </form> --}}



            </div>
        </div>
        
    </div>

</div>


@endsection