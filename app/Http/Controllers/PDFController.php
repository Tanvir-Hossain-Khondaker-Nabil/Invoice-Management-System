<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Tax;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 
use Illuminate\Support\Facades\App;
use Gloudemans\Shoppingcart\Facades\Cart;

class PDFController extends Controller
{
    public function index(Request $request)
    {
       
        $this->validate($request, [
            'invoice_number'=>'required',
            'cus_id'=>'required',
        ]);
        $contents = Cart::content();
        $cus_id = $request->cus_id;
        $customers = Customer::find($cus_id);

        $tax = Tax::select('tax')->first();

        foreach ($contents as $content) {
            cart::setTax($content->rowId, @$tax->tax ? @$tax->tax : '18' );
        }

        $invoice_number = $request->invoice_number;
        $invoice_date = $request->invoice_date;

        $data = [
                'invoice_number' => $invoice_number,
                'invoice_date' => $invoice_date,
                'contents' => $contents,
                'customers' => $customers,
            ];  
        
        return view('invoice',  compact('customers','contents','invoice_number','invoice_date','tax'));

           
    }

    


    public function downloadPDF(Request $request){
        $contents = Cart::content();

        $tax = Tax::select('tax')->first();
        foreach ($contents as $content) {
            cart::setTax($content->rowId, $tax->tax);
        }

        $cus_id = $request->cus_id;
        $customers = Customer::find($cus_id);

        $invoice_number = $request->invoice_number;
        $invoice_date = $request->invoice_date;

        $cus_name = $customers->name;
        $cus_phone = $customers->phone;
        $path = public_path('pdf/');
        $fileName = $cus_name.'-'.$cus_phone.'-'.$invoice_number .'.'. 'pdf' ;

            foreach($contents as $row){
                $data['product_id'] = $row->id;
                $data['name'] = $row->name;
                $data['price'] = $row->price;
                $data['qty'] = $row->qty;
            
            $data['vat'] = Cart::tax();
            $data['sub_total'] = Cart::subtotal();
            $data['total'] = Cart::total();
            $data['month'] = $request->month;
            $data['date'] = date('Y');
            $data['invoice_number'] = $request->invoice_number;
            $data['customer_id'] = $request->cus_id;
            $data['pdf'] = $fileName;
            
            Invoice::create($data);
        }
     
        $pdf = Pdf::loadView('pdf', compact('customers','contents','invoice_number','invoice_date','tax'))->save($path . '/' . $fileName);
        Cart::destroy();
        return redirect()->route('invoice.index');
    }


    public function updatePDF(request $request){
        $id = 0;
        $p = 0;
        $q = 0;
        $u = 0;
        for ($i=0; $i < count($request->input('product')); $i++) { 
            // dd( $request->all());
            $product_id= $request->product_id[$id++];
            // echo $request->product[$p++];
            // echo $request->quantity[$q++];
            // echo $request->unitprice[$u++];

            Invoice::where('product_id',$product_id)->
            update([
                'name'=>$request->product[$p++],
                'qty'=>$request->quantity[$q++],
                'price'=>$request->unitprice[$u++],
                'customer_id'=>$request->cus_id,
                'vat'=>$request->tax,
                'sub_total'=>$request->subtotal,
                'total'=>$request->total,
            ]);
            return redirect()->route('invoice.index');
        }
        
    }


}