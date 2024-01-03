@extends('backend.layouts.master')
@section('title','Invoice')
@push('css')
    

@endpush
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Invoices</h4>

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
        <!-- end row -->
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Invoice Table</h4>
                        <p class="card-title-desc">This view creates a dynamic data table with some features like
                            filters, pagination and search input, you can customize the headers, the data to be
                            displayed for each row.
                        </p>

                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="d-flex gap-1 mb-4">
                                <a href="{{ route('january.invoice') }}" class="btn btn-sm btn-info">January</a>
                                <a href="{{ route('fedruary.invoice') }}" class="btn btn-sm btn-danger">Fedruary</a>
                                <a href="{{ route('march.invoice') }}" class="btn btn-sm btn-success">March</a>
                                <a href="{{ route('april.invoice') }}" class="btn btn-sm btn-primary">April</a>
                                <a href="{{ route('may.invoice') }}" class="btn btn-sm btn-warning">May</a>
                                <a href="{{ route('june.invoice') }}" class="btn btn-sm btn-info">June</a>
                                <a href="{{ route('july.invoice') }}" class="btn btn-sm btn-danger">July</a>
                                <a href="{{ route('augest.invoice') }}" class="btn btn-sm btn-success">Augest</a>
                                <a href="{{ route('september.invoice') }}" class="btn btn-sm btn-primary">September</a>
                                <a href="{{ route('october.invoice') }}" class="btn btn-sm btn-warning">October</a>
                                <a href="{{ route('november.invoice') }}" class="btn btn-sm btn-info">November</a>
                                <a href="{{ route('december.invoice') }}" class="btn btn-sm btn-danger">December</a>
                                <button onclick="myFunction()" class="dropbtn">{{date('Y')}}</button>
                                <div id="myDropdown" class="dropdown-content mt-2">
                                    <form method="POST" action="{{ route('yearly-invoice.invoice',date('Y')) }}">
                                        @csrf
                                        <button class="btn-select" name="id" value="{{  date('Y') }}" type="submit">{{
                                            date('Y') }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('yearly-invoice.invoice',date('Y') - 1 ) }}">
                                        @csrf
                                        <button class="btn-select" name="id" value="{{  date('Y') - 1 }}"
                                            type="submit">{{ date('Y') - 1 }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('yearly-invoice.invoice',date('Y') - 2) }}">
                                        @csrf
                                        <button class="btn-select" name="id" value="{{  date('Y') - 2 }}"
                                            type="submit">{{ date('Y') - 2 }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('yearly-invoice.invoice',date('Y') - 3) }}">
                                        @csrf
                                        <button class="btn-select" name="id" value="{{  date('Y') - 3 }}"
                                            type="submit">{{ date('Y') - 3 }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('yearly-invoice.invoice',date('Y') - 4) }}">
                                        @csrf
                                        <button class="btn-select" name="id" value="{{  date('Y') - 4 }}"
                                            type="submit">{{ date('Y') - 4 }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('yearly-invoice.invoice', date('Y') - 5 ) }}">
                                        @csrf
                                        <button class="btn-select" name="id" value="{{  date('Y') - 5 }}"
                                            type="submit">{{ date('Y') - 5 }}</button>
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 table-responsive">
                                    <table id="datatable"
                                        class="table table-bordered dt-responsive dataTable no-footer dtr-inline"
                                        role="grid" aria-describedby="datatable_info" style="width: 1013px;">
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 159px;">ID</th>
                                                <th style="width: 242px;">Invoice Number</th>
                                                <th style="width: 242px;">PDF</th>
                                                <th style="width: 242px;">Social Media</th>
                                                <th style="width: 81px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @php $sl=1 @endphp
                                            @foreach($invoices as $invoice)
                                            <tr>
                                                <td>{{$sl++}}</td>
                                                <td>#0000{{$invoice->invoice_number}}DSS</td>
                                                @php
                                                    $share = \Share::page(asset('pdf/'.$invoice->pdf), 'Share title')
                                                    ->facebook()
                                                    ->twitter()
                                                    ->linkedin('Extra linkedin summary can be passed here')                                                    
                                                    ->whatsapp();
                                                @endphp
                                                <td> <button type=submit class="btn btn-sm" 
                                                    onclick="window.open('{{ asset('pdf/'.$invoice->pdf) }}'); return true;"> <i class="fa-regular fa-file-pdf" style="font-size: 25px"></i> </button>
                                                </td>
                                                <td>{!!$share!!}</td>
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <a href="{{route('invoice.show',$invoice->invoice_number)}}"><button
                                                                class="btn btn-sm btn-success"><i
                                                                    class="fa-solid fa-eye"></i></button></a>
                                                        <a href="{{route('invoice.edit',$invoice->invoice_number)}}"><button
                                                                class="btn btn-sm btn-warning"><i
                                                                    class="fa-solid fa-edit "></i></button></a>
                                                        <form method="post" id="{{'form_'.$invoice->invoice_number}}"
                                                            action="{{route('invoice.destroy',$invoice->invoice_number)}}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" data-id="{{$invoice->invoice_number}}"
                                                                class="delete btn btn-sm btn-danger mx-1"><i
                                                                    class="fa-solid fa-trash "></i></button>
                                                        </form>
                                                    </div>

                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-12 my-4">
                <a href="{{route('invoice.create')}}"> <button class=" btn btn-primary btn-md">➥ Create</button></a>
            </div>
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>
@endsection
@push('css')
    <style>
        #social-links ul{
            display: flex;
    text-decoration: none;
    list-style: none;
        }
        #social-links ul li{
            margin-left: 25px
        }
        #social-links ul li a{
            color: #1FB185;
        }
        #social-links ul li a span{
            font-size: 18px
        }
        dl, ol, ul {
            margin-top: 0;
            margin-bottom: 0;
        }
        ol, ul {
            padding-left:0;
        }

    </style>
@endpush
@push('js')
<script>
    $(document).ready(function () {
       $('#datatable').DataTable();
    });


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
@endpush

@push('css')
<style>
    .dropbtn {
        background-color: #1fb185;
        color: #ffffff;
        padding: 4px 25px;
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
        right: 185px;
        top: 130px;

    }

    .show {
        display: block;
    }

    .btn-select {
        width: 80px;
        background-color: #1fb185;
        color: #ffffff;
        padding: 5px 15px;
        font-size: 12px;
        border: none;
    }
</style>
@endpush