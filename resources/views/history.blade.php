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
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice_headers as $invoice_header)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice_header->created_at }}</td>
                                <td>
                                    @if ($invoice_header->status == 1)
                                    Has been ordered, Payment hasn't been done
                                        
                                    @else
                                    Payment is done    
                                    @endif
                                </td>
                                <td>Rp.{{ number_format($invoice_header->total_price)  }}</td>
                                
                                <td>
                                    <a href="/index-invoice/{{ $invoice_header->id }}" class="btn btn-primary"><i class="fa fa-file"></i> Invoice</a>
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