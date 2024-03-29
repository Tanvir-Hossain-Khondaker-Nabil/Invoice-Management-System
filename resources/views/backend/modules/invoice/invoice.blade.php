@extends('backend.layouts.master')

@section('content')
<div class="page-content px-3">
   <div class="invoice">
      <!-- begin invoice-company -->
      
      <div class="row invoice-company text-inverse f-w-600">
         <div class="col-10">
            Company Name, {{ @$customer->name }}
         </div>
         <div class="col-2 text-end">
            <span class="pull-right hidden-print"><a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
               </span>
         </div>           
      </div>
      <!-- end invoice-company -->
      <!-- begin invoice-header -->
      <div class="invoice-header">
         <div class="invoice-from">
            <small>from</small>
            <address class="m-t-5 m-b-5">
               <strong class="text-inverse">Rcreation</strong><br>
               Muradpur<br>
               Chittagong, 4203<br>
               Phone: (123) 456-7890<br>
               Fax: (123) 456-7890
            </address>
         </div>
         <div class="invoice-to">
            <small>to</small>
            
            <address class="m-t-5 m-b-5">
               <strong class="text-inverse">{{ @$customer->name }}</strong><br>
               {{ @$customer->street_address }}<br>
               {{ @$customer->city }}, {{ @$customer->postal_code }}<br>
               Phone: {{ @$customer->phone }}<br>
               Fax: {{ @$customer->phone }}
            </address>
         </div>
         <div class="invoice-date">
            <small>Invoice / {{ @$invoice->month }} period</small>
            <div class="date text-inverse m-t-5">{{ @$invoice->month }} {{ @$invoice->date }}</div>
            <div class="invoice-detail">
               INV#{{ @$invoice->invoice_number }}<br>
               Services Product
            </div>
         </div>
      </div>
      <!-- end invoice-header -->
      <!-- begin invoice-content -->
      <div class="invoice-content">
         <!-- begin table-responsive -->
         <div class="table-responsive">
            <table class="table table-invoice">
               <thead>
                  <tr>
                     <th>TASK DESCRIPTION</th>
                     <th class="text-center" width="10%">Price</th>
                     <th class="text-center" width="10%">Quantity</th>
                     <th class="text-right" width="20%">LINE TOTAL</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($invoices as $content)                  
                  <tr>
                     <td>
                        <span class="text-inverse">{{ $content->name }}</span><br>
                        <small>{{ $content->details }}</small>
                     </td>
                     <td class="text-center">{{ $content->qty }}</td>
                     <td class="text-center">{{ $content->price }}</td>
                     <td class="text-right">{{ $content->qty*$content->price }}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         <!-- end table-responsive -->
         <!-- begin invoice-price -->
         <div class="invoice-price">
            <div class="invoice-price-left">
               <div class="invoice-price-row">
                  <div class="sub-price">
                     <small>SUBTOTAL</small>
                     <span class="text-inverse">{{ @$invoice->sub_total }}</span>
                  </div>
                  <div class="sub-price">
                     <i class="fa fa-plus text-muted"></i>
                  </div>
                  <div class="sub-price">
                     <small>VAT ({{ @$tax->tax }}%)</small>
                     <span class="text-inverse">{{ @$invoice->vat }}</span>
                  </div>
               </div>
            </div>
            <div class="invoice-price-right">
               <small>TOTAL</small> <span class="f-w-600">{{ @$invoice->total }}</span>
            </div>
         </div>
         <!-- end invoice-price -->
      </div>
      <!-- end invoice-content -->
      <!-- begin invoice-note -->
      <div class="invoice-note">
         * Make all cheques payable to [Your Company Name]<br>
         * Payment is due within 30 days<br>
         * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
      </div>
      <!-- end invoice-note -->
      <!-- begin invoice-footer -->
      <div class="invoice-footer">
         <p class="text-center m-b-5 f-w-600">
            THANK YOU FOR YOUR BUSINESS
         </p>
         <p class="text-center">
            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> matiasgallipoli.com</span>
            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:016-18192302</span>
            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> rtiemps@gmail.com</span>
         </p>
      </div>
      <!-- end invoice-footer -->
      
   </div>
   {{-- <div class="card invoice-none">
      <div class="row">
         <div class="col-12 text-end">
            <form action="{{ route('download.pdf') }}" method="get">
               @csrf
            <input type="hidden" name="cus_id" value="{{ @$invoices->id }}">
            <input type="hidden" name="invoice_number" value="{{ $invoice_number }}">
            <input type="hidden" name="month" value="{{  date('M')  }}">
            <input type="hidden" name="date" value="{{  date('d,Y')  }}">
            <button type="submit" class="btn btn-success" >Save</button>
            </form>
         </div>
      </div>      
   </div> --}}
</div>
@endsection










@push('css')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
      @media print {
   .px-3 {
      padding-right: 0px !important;
      padding-left: 0px !important;
   }
   .invoice-none{
      display: none
   }
   title{
      display:none
   }
}
   body{
      margin-top:20px;
      background:#eee;
   }

   .invoice {
      background: #fff;
      padding: 20px
   }

   .invoice-company {
      font-size: 20px
   }

   .invoice-header {
      margin: 0 -20px;
      background: #f0f3f4;
      padding: 20px
   }

   .invoice-date,
   .invoice-from,
   .invoice-to {
      display: table-cell;
      width: 1%
   }

   .invoice-from,
   .invoice-to {
      padding-right: 20px
   }

   .invoice-date .date,
   .invoice-from strong,
   .invoice-to strong {
      font-size: 16px;
      font-weight: 600
   }

   .invoice-date {
      text-align: right;
      padding-left: 20px
   }

   .invoice-price {
      background: #f0f3f4;
      display: table;
      width: 100%
   }

   .invoice-price .invoice-price-left,
   .invoice-price .invoice-price-right {
      display: table-cell;
      padding: 20px;
      font-size: 20px;
      font-weight: 600;
      width: 75%;
      position: relative;
      vertical-align: middle
   }

   .invoice-price .invoice-price-left .sub-price {
      display: table-cell;
      vertical-align: middle;
      padding: 0 20px
   }

   .invoice-price small {
      font-size: 12px;
      font-weight: 400;
      display: block
   }

   .invoice-price .invoice-price-row {
      display: table;
      float: left
   }

   .invoice-price .invoice-price-right {
      width: 25%;
      background: #2d353c;
      color: #fff;
      font-size: 28px;
      text-align: right;
      vertical-align: bottom;
      font-weight: 300
   }

   .invoice-price .invoice-price-right small {
      display: block;
      opacity: .6;
      position: absolute;
      top: 10px;
      left: 10px;
      font-size: 12px
   }

   .invoice-footer {
      border-top: 1px solid #ddd;
      padding-top: 10px;
      font-size: 10px
   }

   .invoice-note {
      color: #999;
      margin-top: 80px;
      font-size: 85%
   }

   .invoice>div:not(.invoice-footer) {
      margin-bottom: 20px
   }

   .btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
      color: #2d353c;
      background: #fff;
      border-color: #d9dfe3;
   }
   @media print {
   .px-3 {
      padding-right: 0px !important;
      padding-left: 0px !important;
   }
   .invoice-none{
      display: none
   }
   title{
      display:none
   }
      
   }
</style>
@endpush
