<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use App\Models\InvoiceHeader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\View\Components\Alert;

class invoiceController extends Controller
{
    public function indexInvoice($id){
        $invoice_header = InvoiceHeader::where('user_id', Auth::user()->id)->where('status',1)->first();
        $invoice_details = InvoiceDetail::where('invoice_id', $invoice_header->id)->get();
        return view('invoice', [
            'title'=> 'Invoice',
            'page'=> 'Invoice',
        ], compact('invoice_header','invoice_details'));

    }

    public function createOrder(Product $product){
        $invoiceDetails = InvoiceDetail::all();
        $invoice_header = InvoiceHeader::where('user_id', Auth::user()->id)->where('status',0)->first();
        // $invoice_headers = InvoiceHeader::all();
        return view('createOrder', [
            'title'=> 'Create Order',
            'page'=> 'Create Order',
            'product'=> $product,
            'invoiceDetails'=> $invoiceDetails,
            'invoice_header'=> $invoice_header
            // 'invoice_headers'=> $invoice_headers
        ]);
    }
    public function storeOrder(Request $request, $id){
        $request->validate([
            // 'shipping_address'=>'required|min:10|max:100',
            // 'postal_code'=> 'required|digits:5',
            'quantity'=>'required|integer'
        ]);

        $product = Product::where('id', $id)->first();

        // //---------------------------------------------------------------------------------------------------------------
        $invoiceHeader = InvoiceHeader::where('user_id', Auth::id())->where('status', 0)->first();
        // //---------------------------------------------------------------------------------------------------------------

        //validasi quantity
        if($request->quantity > $product->total_product){
            return redirect('/create-order/'.$id);
        }

        //validation check InvoiceHeader
        $invoiceHeader_check = InvoiceHeader::where('user_id', Auth::user()->id)->where('status', 0)->first();
        
        //store to InvoiceHeader
        if(empty($invoiceHeader_check)){        
            $invoice_header = new InvoiceHeader;
            $invoice_header->user_id = Auth::user()->id;
            $invoice_header->status = 0;
            $invoice_header->invoice_number = mt_rand(100, 999);
            // $invoice_header->shipping_address = $request->shipping_address;
            // $invoice_header->postal_code = $request->postal_code;

            if (empty($invoiceHeader->shipping_address) || empty($invoiceHeader->postal_code)) {
                $invoice_header->shipping_address = $request->shipping_address;
                $invoice_header->postal_code = $request->postal_code;
            }
            $invoice_header->total_price = 0;
            // $invoice_header->total_price = 0;
            $invoice_header->save();
        }
        
        // //---------------------------------------------------------------------------------------------------------------
        // // Check if shipping address and postal code are empty
        // if(empty($invoiceHeader->shipping_address) || empty($invoiceHeader->postal_code)){
        //     // Update invoice header with shipping address and postal code
        //     $invoiceHeader->update([
        //         'shipping_address' => $request->shipping_address,
        //         'postal_code' => $request->postal_code
        //     ]);
        // }
        // //---------------------------------------------------------------------------------------------------------------


        //store to InvoiceDetail
        $newInvoice = InvoiceHeader::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //validation check InvoiceDetail
        $invoiceDetail_check = InvoiceDetail::where('product_id', $product->id)->where('invoice_id', $newInvoice->id)->first();;

        if(empty($invoiceDetail_check)){
            $invoice_detail = new InvoiceDetail;
            $invoice_detail->product_id = $product->id;
            $invoice_detail->invoice_id = $newInvoice->id;                 
            $invoice_detail->quantity = $request->quantity;
            $invoice_detail->total_price = $product->price * $request->quantity;
            $invoice_detail->save();
        }else{
            $invoice_detail = InvoiceDetail::where('product_id', $product->id)->where('invoice_id', $newInvoice->id)->first();
            $invoice_detail->quantity = $invoice_detail->quantity + $request->quantity;

            //current price
            $new_invoice_detail_price = $product->price * $request->quantity;
            $invoice_detail->total_price = $invoice_detail->total_price + $new_invoice_detail_price;
            $invoice_detail->update();
        }
        
        $invoice_header = InvoiceHeader::where('user_id', Auth::user()->id)->where('status',0)->first();
        $invoice_header->total_price = $invoice_header->total_price + ($product->price * $request->quantity);
        $invoice_header->update();
        return redirect('/order-list');

    }

    public function orderList()
    {
        $invoice_header = InvoiceHeader::where('user_id', Auth::user()->id)->where('status',0)->first();
 	    $invoiceDetails = [];
        if(!empty($invoice_header))
        {
            $invoiceDetails = InvoiceDetail::where('invoice_id', $invoice_header->id)->get();

        }
        
        return view('orderList', [
            'title'=> 'Order List',
            'page'=> 'Order List',
            'invoiceDetails'=> $invoiceDetails,
            'invoice_header'=>$invoice_header
        ]);
    }

    // public function orderList(){
    //     $invoiceDetails = InvoiceDetail::all();
    //     $invoice_header = InvoiceHeader::where('user_id', Auth::user()->id)->where('status',0)->first();
    //     $invoice_headers = InvoiceHeader::all();
    //     return view('orderList', [
    //         'title'=> 'Order List',
    //         'page'=> 'Order List',
    //         'invoiceDetails'=> $invoiceDetails,
    //         'invoice_header'=> $invoice_header,
    //         'invoice_headers'=> $invoice_headers
    //     ]);
    // }

    // public function deleteOrder(InvoiceDetail $invoiceDetail){
    //     $invoiceDetail->delete();
    //     return redirect('/order-list');
    // }

    public function deleteOrder($id){
        $invoice_detail = InvoiceDetail::where('id', $id)->first();

        $invoice_header = InvoiceHeader::where('id', $invoice_detail->invoice_id)->first();
        $invoice_header->total_price = $invoice_header->total_price - $invoice_detail->total_price;
        $invoice_header->save();

        $invoice_detail->delete();
        return redirect('/order-list');
    }

    public function purchaseConfirmation(){
        $user = User::where('id', Auth::user()->id)->first();
        $invoice_header = InvoiceHeader::where('user_id', Auth::user()->id)->where('status',0)->first();
        // $invoice_id = $invoice_header->invoice_id;
        $invoice_id = $invoice_header->id;
        $invoice_header->status = 1;
        $invoice_header->update();

        $invoice_details = InvoiceDetail::where('invoice_id', $invoice_id)->get();
        foreach($invoice_details as $invoice_detail){
            $product = Product::where('id', $invoice_detail->product_id)->first();
            $product->total_product = $product->total_product - $invoice_detail->quantity;
            $product->update();
        }
        return redirect('/index-history');
    }

    public function indexHistory(){
        $invoice_headers = InvoiceHeader::where('user_id', Auth::user()->id)->where('status', '!=',0)->get();

    	return view('history', [
            'title'=> 'Invoice',
            'page'=> 'Invoice'
        ],compact('invoice_headers'));
    }


}
