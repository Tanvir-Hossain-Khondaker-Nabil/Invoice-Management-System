@extends('backend.layouts.master')

@section('content')
<div class="page-content">
  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Create A New Invoice</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript: void(0);">Invoice</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>

        </div>
      </div>
    </div>
    <!-- end page title -->
    <div class="row">
      <div class="col-12">
        <div class="card shadow-lg">
          <div class="card-body  table-responsive">
            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" id="myTable">
              <thead>
                <tr>
                  <th style="width: 300px;">
                    <i class="fa-solid fa-square-plus fa-xl text-success"></i> Item
                    <div class="dropdown">
                      <button onclick="myFunction()" class="dropbtn">All Item</button>
                      <div id="myDropdown" class="dropdown-content mt-2">
                        <form method="POST" action="{{ route('cart.store') }}">
                          @csrf
                          @if (isset($products))
                          @foreach ($products as $product)
                          <button class="btn-select" name="id" value="{{ $product->id }}" type="submit">{{
                            $product->name }}</button>
                          @endforeach
                          @endif                          
                        </form>
                      </div>
                    </div>
                  </th>
                  <th>Qty</th>
                  @if (Cart::content()->count() > 0)
                  @endif                            
                  <th>Price</th>
                  <th>Total</th>
                  <th>
                    @if (Cart::content()->count() > 0)
                    Add
                    @else
                    Input
                    @endif
                  </th>
                </tr>
              </thead>

              <tbody id="TBody">
                @php
                $cart_products = Cart::content();
                @endphp
                @foreach ($cart_products as $item)
                <tr id="TRow">
                  <td>
                    <input type="text" name="product" value="{{ @$item->name }}" class="form-control"
                      id="formrow-password-input" placeholder="Enter Your Product">
                  </td>
                  <form action="{{ route('cart.update',$item->rowId) }}" method="post">
                    @csrf
                    <td class="d-flex gap-3">
                      <input type="number" name="quantity" onchange="Calc(this)" class="form-control"
                        placeholder="Quantity" value="{{ @$item->qty }}" id="quantity">

                      <button type="submit" class="btn btn-sm "><i
                          class="fa-solid fa-check fa-xl text-success"></i></button>
                          
                    </td>
                  </form>
                  <td>
                    <input type="number" name="unitprice" onchange="Calc(this)" class="form-control"
                      placeholder="Unit Price" value="{{ @$item->price }}" id="unitprice">
                  </td>
                  <td>
                    <input type="number" name="total" class="form-control" value="{{ @$item->price*@$item->qty }}"
                      placeholder="Total" onchange="Calc(this)" id="total" style="cursor: pointer;" readonly>
                  </td>
                  <td>
                    <a href="{{ route('cart.remove',$item->rowId)  }}" onclick="DeleteRow(this)"
                      class="btn btn-sm btn-danger">
                      <i class="fa fa-minus"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tbody>
                @if (Cart::content()->count() > 0)
                <tr>
                  <td colspan="2"></td>
                  <td></td>
                  <td></td>                  
                  <td>
                    <a href="#" class="btn btn-sm btn-success" id="addRow"><i class="fa fa-plus"></i></a>
                  </td>                  
                </tr>
                @endif
                <tr>
                  @if (Cart::content()->count() > 0)
                  <td colspan="2"></td>
                  @else
                  <td colspan="3"></td>
                  @endif
                  <td>
                    <strong>Sub Total:</strong>
                  </td>
                  <td>
                    <input type="text" name="subtotal" class="form-control" value="{{ Cart::subtotal() }}"
                      id="subtotal" readonly>
                  </td>
                </tr>
                <tr>
                  @if (Cart::content()->count() > 0)
                  <td colspan="2"></td>
                  @else
                  <td colspan="3"></td>
                  @endif
                  <td>
                    <strong>VAT(%):</strong>
                  </td>
                  <td>
                    <input type="text" name="" class="form-control" id="vat" value="{{ Cart::tax() }}">
                  </td>
                </tr>
                <tr>                  
                  @if (Cart::content()->count() > 0)
                  <td colspan="2"></td>
                  @else
                  <td colspan="3"></td>
                  @endif
                  <td>
                    <strong>VAT+Sub Total:</strong>
                  </td>
                  <td>
                    <input type="text" name="" class="form-control" id="vatsubtotal" onclick="tax" value="{{ Cart::total() }}" readonly>
                  </td>
                </tr>
              </tbody>
            </table>







          </div>
        </div>
        <form action="{{ route('generate.pdf') }}" method="POST">
          @csrf
          <div class="card p-3 shadow-lg">
            <div class="row">
              <div class="col-md-4">
                <label class="form-label">Select Customer</label>
                <select class="form-control select2" name="cus_id">
                    <option>Select</option>
                    {{-- <optgroup label="Alaskan/Hawaiian Time Zone"> --}}
                      @if (isset($customers))
                      @foreach ($customers as $customer)
                      <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                      @endforeach
                      @endif
                </select>
                @error('cus_id')
                <code>*{{$message}}</code>
                @enderror
              </div>
              <div class="col-md-4">
                <label class="form-label">Invoice Number</label>
                
                <input type="text" class="form-control" value="{{ $invoice_num }}" name="invoice_number" readonly>
                @error('invoice_number')
                <code>*{{$message}}</code>
                @enderror
              </div>
              <div class="col-md-4">    
                <label class="form-label">Invoice Date</label>            
                <input type="text" value="{{ date('Y') }}" name="invoice_date" readonly class="form-control">
              </div>
            </div>
            
          </div>
          <button class="btn btn-success" style="background-color: #1fb185;">Create Invoice</button>
        </form>
      </div>
    </div>
    <!-- end row -->


  </div> <!-- container-fluid -->
</div>

@endsection
@push('css')
<link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<style>
  .dt-responsive td,
  .dt-responsive th {
    border: 1px solid #e1e1e1;
  }

  .table thead tr th {
    font-size: 18px !important;
  }

  .dropbtn {
    background-color: #1fb185;
    color: #ffffff;
    padding: 4px 33px;
    font-size: 12px;
    border: none;
    border-radius: 2px;
    cursor: pointer;
  }

  .dropdown {
    position: relative;
    display: inline-block;
    margin-left: 50px
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .show {
    display: block;
  }

  .btn-select {
    width: 110px;
    background-color: #1fb185;
    color: #ffffff;
    padding: 5px 15px;
    font-size: 12px;
    border: none;
  }
</style>
@endpush
@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script>
    function Calc(e) {
      var index = $(e).parent().parent().index();
      var quantity = document.getElementsByName('quantity')[index].value;
      var unitprice = document.getElementsByName('unitprice')[index].value;
      var discount = document.getElementsByName('discount')[index].value;
  
      var dec = (discount / 100).toFixed(2);
  
      if (discount != '') {
        var total_value = (quantity * unitprice);
        var mult = total_value * dec;
        var total = (total_value - mult);
        document.getElementsByName('total')[index].value = total;
      } else {
        var total = (quantity * unitprice);
        document.getElementsByName('total')[index].value = total;
      }
  
      SubTotals()
    }
  
    function SubTotals() {
      var sum = 0
      var totals = document.getElementsByName('total')
      for (let index = 0; index < totals.length; index++) {
        var total = totals[index].value;
        sum = +(sum) + +(total);
      }
      document.getElementById('subtotal').value = sum;
    }
  
    $('#vat').change(function () {
      var vInput = this.value;
      var subtotal = $("#subtotal").val();
      var vInput = ((vInput * subtotal) / 100);
      var vstotal = (parseFloat(subtotal) + parseFloat(vInput)).toFixed(1);
      $('#vatsubtotal').val(vstotal);
    });
  
    $('#paid').change(function () {
      var pInput = this.value;
      var vatsubtotal = $("#vatsubtotal").val();
  
      if ((pInput < vatsubtotal) || (pInput <= vatsubtotal)) {
        $('#paid').val(pInput);
  
        var dInput = +(vatsubtotal) - +(pInput);
        $('#due').val(dInput);
  
        var total = $("#total").val();
        var subtotal = $("#subtotal").val();
      }
    });
  
    $("#addRow").click(function () {
      var v = $("#TRow").clone().appendTo("#TBody");
      $(v).find("input").val('');
      $(v).removeClass('d-none');
    });
  
  
    function DeleteRow(e) {
      $(e).parent().parent().remove();
    }
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }
  
    window.onclick = function (event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
@endpush