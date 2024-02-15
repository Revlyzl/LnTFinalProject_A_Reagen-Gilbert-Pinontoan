@extends('layouts.main')

@section('container')
@if (empty($invoice_header))
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Product List</strong>
                </div>
                <div class="pull-right">
                  <a href="/userProduct" class="btn btn-success btn-sm">
                      <i class="fa fa-undo"></i> Back
                  </a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td align="center"><strong>There are no order for an invoice</strong></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        
    </div>

</div>
@else
<div class="card">
  <div class="card-header">
    <div class="pull-left">
        <strong>Invoice Information</strong>
    </div>
    <div class="pull-right">
      <a href="/userProduct" class="btn btn-success btn-sm">
          <i class="fa fa-undo"></i> Back
      </a>
    </div>
  </div>
    <div class="card-body">
      <div class="container mb-5 mt-3">
        <div class="row d-flex align-items-baseline">
          <div class="col-xl-9">
            <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>Number: #{{ $invoice_header->invoice_number }}</strong></p>
          </div>
          <div class="col-xl-3 float-end">
            <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                class="fa fa-print text-primary"></i> Print</a>
            
          </div>
          <hr>
        </div>
  
        <div class="container">
          <div class="col-md-12">
            <div class="text-center">
              <i class="fa fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
              <p class="pt-1" style="font-size: 30px">PT MEKSIKO</p>
            </div>
  
          </div>
  
  
          <div class="row">
            <div class="col-xl-8">
              <ul class="list-unstyled">
                <li class="text-muted">To: <span style="color:#5d9fc5 ;">{{ $invoice_header->user->name }}</span></li>
                <li class="text-muted">{{ $invoice_header->shipping_address }}</li>
                <li class="text-muted">{{ $invoice_header->postal_code }}</li>
                
                <li class="text-muted"><i class="fa fa-phone"></i> {{ $invoice_header->user->phone }}</li>
              </ul>
            </div>
            <div class="col-xl-4">
              <p class="text-muted">Invoice</p>
              <ul class="list-unstyled">
                <li class="text-muted"><i class="fa fa-circle" style="color:#84B0CA ;"></i> <span
                    class="fw-bold">ID:</span>#{{ $invoice_header->id }}</li>
                <li class="text-muted"><i class="fa fa-circle" style="color:#84B0CA ;"></i> <span
                    class="fw-bold">Creation Time: </span>{{ $invoice_header->created_at }}</li>
                {{-- <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                    class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                    Unpaid</span></li> --}}
              </ul>
            </div>
          </div>
  
          <div class="row my-2 mx-1 justify-content-center">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th >No.</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sub Total</th>
                    {{-- <th>Action</th> --}}
                </tr>
                </thead>
                <tbody>
                    @foreach ($invoice_details as $invoice_detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('/storage/product_images/'.$invoice_detail->product->image) }}" alt="{{ $invoice_detail->product->title }} Cover" width="100px"></td>
                            <td align="center">{{ $invoice_detail->product->name }}</td>
                            <td>{{ $invoice_detail->quantity }}</td>
                            <td>Rp.{{ number_format($invoice_detail->product->price) }}</td>
                            <td>Rp.{{ number_format($invoice_detail->total_price) }}</td>
                            {{-- <td>
                                <form action="/delete-order/{{ $invoiceDetail->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></button>
                                </form>
                            </td> --}}
                        </tr>
                    @endforeach
                    {{-- <tr>
                        <td colspan="6" align="right"><strong>Total Price :</strong></td>
                            <td align="right"><strong>Rp. {{ number_format($invoice_header->total_price) }}</strong></td>
                        </td>
                    </tr> --}}
                </tbody>
            </table>







          </div>
          <div class="row">
            <div class="col-xl-8">
              <p class="ms-3">Add additional notes and payment information</p>
  
            </div>
            <div class="col-xl-3">
              {{-- <ul class="list-unstyled">
                <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1110</li>
                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li>
              </ul> --}}
              <p class="text-black float-start"><span class="text-black me-2" style="font-size: 22px;"> Total Amount </span><span
                  style="font-size: 25px;">Rp.{{ number_format($invoice_header->total_price) }}</span></p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-xl-10">
              <p>Thank you for your purchase</p>
            </div>
            
          </div>
  
        </div>
      </div>
    </div>
</div>
@endif

@endsection