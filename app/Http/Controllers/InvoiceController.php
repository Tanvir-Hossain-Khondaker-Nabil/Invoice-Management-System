<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date = date('M');
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }

    public function YearlyInvoice($id)
    {
        $invoices = Invoice::where('date',$id)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    
        $tax = Tax::select('tax')->first();    
        $invoice = Invoice::select('id')->latest()->first();
        
        if($invoice->id > 0){
            $invoice_num = $invoice->id + '1'.date('dmy');
        }else{
            $invoice_num = 'INV#'.'1'.date('dmy');
        }

        $products = Product::get();
        $customers = Customer::get();
        return view('backend.modules.invoice.create',compact('products','customers','invoice_num','tax'));
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $contents = Cart::content();
        $cus_id = $request->cus_id;
        $customers = Customer::find($cus_id);
        // return view('backend.invoice',compact('contents','customers'));      
        
        return  Pdf::loadView('backend.pdf', compact('contents','customers'));
    }

    public function invoice(Request $request){

        $cus_name = $request->cus_name;
        $cus_phone = $request->cus_phone;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tax = Tax::select('tax')->first();
        $invoices = Invoice::where('invoice_number',$id)->get();

        $invoice = Invoice::where('invoice_number',$id)->first();

        $cus_id = $invoice->customer_id;
        $customer = Customer::where('id',$cus_id)->first();

        return view('backend.modules.invoice.invoice',compact('invoices','invoice','customer','tax'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $products = Product::get();
        $customers = Customer::get();

        $invoices = Invoice::where('invoice_number',$id)->get();

        $invoice = Invoice::where('invoice_number',$id)->first();

        $cus_id = $invoice->customer_id;
        $customer = Customer::where('id',$cus_id)->first();

        return view('backend.modules.invoice.edit',compact('invoices','invoice','customer','products','customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request )
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $invoice = Invoice::where('invoice_number',$id)->pluck('id');
        
        for ($i=0; $i < count($invoice); $i++) { 
            Invoice::destroy($invoice);
        }
        
        session()->flash('msg','Delete Successfully');
        session()->flash('cls','error');
        return redirect()->route('invoice.index');
    }

    public function JanuaryInvoice()
    {
        $date = "Jan";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }

    public function FedruaryInvoice()
    {
        $date = "Fed";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }

    public function MarchInvoice()
    {
        $date = "Mar";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }
    public function AprilInvoice()
    {
        $date = "Apr";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }
    public function MayInvoice()
    {
        $date = "May";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }
    public function JuneInvoice()
    {
        $date = "June";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }
    public function JulyInvoice()
    {
        $date = "July";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }
    public function AugestInvoice()
    {
        $date = "Aug";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }
    public function SeptemberInvoice()
    {
        $date = "Sept";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }
    public function OctoberInvoice()
    {
        $date = "Oct";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }
    public function NovemberInvoice()
    {
        $date = "Nov";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }
    public function DecemberInvoice()
    {
        $date = "Dec";
        $year = date('Y');
        $invoices = Invoice::where('month',$date)->where('date',$year)->select('invoice_number','pdf','customer_id','total')->groupBy('invoice_number')->groupBy('pdf')->groupBy('total')->groupBy('customer_id')->latest()->get();
        return view ('backend.modules.invoice.index',compact('invoices'));
    }
}
