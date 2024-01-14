
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Invoice</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
   </head>
   
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
   body{
      font-family: 'Poppins', sans-serif;
   } 
   }
</style>
   <body style="margin-top:20px;background:#eee;font-family: 'Poppins', sans-serif;font-size:0.8125rem">
      <div class="page-content px-3">
         <div class="invoice" style="background: #fff;padding: 20px">
            <!-- begin invoice-company -->
            <div class="invoice-company text-inverse f-w-600" style="font-size: 20px">           
               Company Name, {{ @$customers->name }}
            </div>
            <!-- end invoice-company -->



            <!-- begin invoice-header -->
            <table style="width:100%;margin: 0 -20px;background: #f0f3f4;padding: 20px">
               <tr>
                  <td class="invoice-from" style="width: 1%;padding-right: 20px">
                     <small>from</small>
                     <p style="font-size: 14px">
                        <strong style="font-size: 17px;font-weight: 600" class="text-inverse">Rcreation</strong><br>
                        Muradpur<br>
                        Chittagong, 4203<br>
                        Phone: (123) 456-7890<br>
                        Fax: (123) 456-7890
                     </p>
                  </td>
                  <td class="invoice-to" style="width: 1%;padding-right: 20px;">
                     <small>to</small>
                     
                     <p style="font-size: 14px;margin-bottom: 1rem;font-style: normal;line-height: inherit;">
                        <strong style="font-size: 17px;font-weight: 600" >{{ $customers->name }}</strong><br>
                        {{ $customers->street_address }}<br>
                        {{ $customers->city }}, {{ $customers->postal_code }}<br>
                        Phone: {{ $customers->phone }}<br>
                        Fax: {{ $customers->phone }}
                     </p>
                  </td>
                  <td style="width: 1%;text-align: right;padding-left: 20px">
                     <small>Invoice / {{ date('M') }} period</small>
                     <div style="font-size: 16px;font-weight: 600">{{ date('M') }} {{ date('d,Y') }}</div>
                     <div>
                        #0000{{ $invoice_number }}DSS<br>
                        Services Product
                     </div>
                  </td>
               </tr>
            </table>
            <!-- end invoice-header -->





            <!-- begin invoice-content -->
            <div  style="margin-bottom: 20px;">
               <!-- begin table-responsive -->
               <div  style="overflow-x: auto;">
                  <table  style="width:100%;
                     width: 100%;
                     margin-bottom: 1rem;
                     color: #495057;
                     vertical-align: top;
                     border-color: #eff2f7;
                     caption-side: bottom;
                     border-collapse: collapse;
                     display: table;
                     border-collapse: separate;
                     box-sizing: border-box;
                     text-indent: initial;
                     border-spacing: 2px;
                     border-color: gray;
                     margin: 0px;
                     padding: 0px;">
                     <thead style="vertical-align: bottom;">
                        <tr>
                           <th style="font-weight: 600;padding: 0.75rem 0.75rem;
                           background-color: transparent;
                           border-bottom-width: 1px;
                           box-shadow: inset 0 0 0 9999px transparent;text-align:start">TASK DESCRIPTION</th>
                           <th style="font-weight: 600;padding: 0.75rem 0.75rem;
                           background-color: transparent;
                           border-bottom-width: 1px;
                           box-shadow: inset 0 0 0 9999px transparent;text-align:start" width="15%">Quantity</th>
                           <th style="font-weight: 600;padding: 0.75rem 0.75rem;
                           background-color: transparent;
                           border-bottom-width: 1px;
                           box-shadow: inset 0 0 0 9999px transparent;text-align:start" width="15%">Price</th>
                           <th style="font-weight: 600;padding: 0.75rem 0.75rem;
                           background-color: transparent;
                           border-bottom-width: 1px;
                           box-shadow: inset 0 0 0 9999px transparent;text-align:start" width="25%">LINE TOTAL</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                           $contents = Cart::content();
                        @endphp
                        @foreach ($contents as $content)                  
                        <tr>
                           <td style=" padding: 0.75rem 0.75rem;
                           background-color: transparent;
                           border-bottom-width: 1px;
                           box-shadow: inset 0 0 0 9999px transparent;">
                              <span>{{ $content->name }}</span><br>
                              <small>{{ $content->details }}</small>
                           </td>
                           <td style=" padding: 0.75rem 0.75rem;
                           background-color: transparent;
                           border-bottom-width: 1px;
                           box-shadow: inset 0 0 0 9999px transparent;">{{ $content->qty }}</td>
                           <td style=" padding: 0.75rem 0.75rem;
                           background-color: transparent;
                           border-bottom-width: 1px;
                           box-shadow: inset 0 0 0 9999px transparent;">{{ $content->price }}</td>
                           <td style=" padding: 0.75rem 0.75rem;
                           background-color: transparent;
                           border-bottom-width: 1px;
                           box-shadow: inset 0 0 0 9999px transparent;">{{ $content->qty*$content->price }}</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!-- end table-responsive -->
               <!-- begin invoice-price -->
               <div  style="background: #f0f3f4;display: table;width: 100%">
                  <div  style="display: table-cell;
                  padding: 20px;
                  font-size: 20px;
                  font-weight: 600;
                  width: 75%;
                  position: relative;
                  vertical-align: middle">
                     <div class="invoice-price-row" style="display: table; float: left">
                        <div class="sub-price" style="display: table-cell;vertical-align: middle;padding: 0 20px">
                           <small style="font-size: 12px;font-weight: 400;display: block">SUBTOTAL</small>
                           <span class="text-inverse">{{ Cart::subtotal() }}</span>
                        </div>
                        <div class="sub-price" style="display: table-cell;vertical-align: middle;padding: 0 20px">
                           <i class="fa fa-plus text-muted"></i>
                        </div>
                        <div class="sub-price" style="display: table-cell;vertical-align: middle; padding: 0 20px">
                           <small style="font-size: 12px;font-weight: 400;display: block">VAT ({{ $tax->tax }}%)</small>
                           <span class="text-inverse">{{ Cart::tax() }}</span>
                        </div>
                     </div>
                  </div>
                  <div class="invoice-price-right" style="display: table-cell;
                  padding: 20px;
                  font-size: 20px;
                  font-weight: 600;
                  width: 75%;
                  position: relative;
                  vertical-align: middle;
                  width: 25%;
                  background: #2d353c;
                  color: #fff;
                  font-size: 28px;
                  text-align: right;
                  vertical-align: bottom;
                  font-weight: 300">
                     <small style="font-size: 12px; font-weight: 400; display: block;display: block;
                     opacity: .6;
                     position: absolute;
                     top: 10px;
                     left: 10px;
                     font-size: 12px">TOTAL</small> <span >{{ Cart::total() }}</span>
                  </div>
               </div>
               <!-- end invoice-price -->
            </div>
            <!-- end invoice-content -->
            <!-- begin invoice-note -->
            <div class="invoice-note" style="color: #999;margin-top: 80px;font-size: 85%"> 
               * Make all cheques payable to [Your Company Name]<br>
               * Payment is due within 30 days<br>
               * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
            </div>
            <!-- end invoice-note -->
            <!-- begin invoice-footer -->
            <div class="invoice-footer" style="border-top: 1px solid #ddd;padding-top: 10px;font-size: 10px">
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

      </div>

   </body>
</html>







