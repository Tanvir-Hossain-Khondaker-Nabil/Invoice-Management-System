@extends('backend.layouts.master')
@section('title','Customer')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Customers</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Customer</a></li>
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
        
                <h4 class="card-title">Customer Table</h4>
                <p class="card-title-desc">This view creates a dynamic data table with some features like filters, pagination and search input, you can customize the headers, the data to be displayed for each row.
                </p>
        
                <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="datatable"
                                class="table table-bordered dt-responsive dataTable no-footer dtr-inline"
                                role="grid" aria-describedby="datatable_info" style="width: 1013px;">
                                <thead>
                                    <tr role="row">
                                        <th style="width: 159px;">ID</th>
                                        <th style="width: 242px;">Image</th>
                                        <th style="width: 242px;">Name</th>
                                        <th style="width: 115px;">Email </th>
                                        <th style="width: 115px;">Phone</th>
                                        <th style="width: 52px;" >Shop Name</th>
                                        <th style="width: 81px;">city</th>
                                        <th style="width: 81px;">Postal Code</th>
                                        <th style="width: 81px;">Street Address</th>
                                        <th style="width: 81px;" >Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=1 @endphp
                                    @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$sl++}}</td>
                                        <td><img src="{{asset($customer->photo)}}" alt="" class="img-fluid" style="width: 50px"></td>
                                        <td>{{$customer->name}}</td>                
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->phone}}</td>
                                        <td>{{$customer->shopname}}</td>
                                        <td>{{$customer->city}}</td>
                                        <td>{{$customer->postal_code}}</td>
                                        <td>{{$customer->street_address}}</td>
                                        <td>
                                            <div class="d-flex">
                                            <a href="{{route('customer.edit',$customer->id)}}"><button class="btn btn-sm btn-warning"><i class="fa-solid fa-edit "></i></button></a> 
                                            <form method="post" id="{{'form_'.$customer->id}}" action="{{route('customer.destroy',$customer->id)}}">
                                                @csrf
                                                @method('delete')
                                                <button type="button" data-id="{{$customer->id}}" class="delete btn btn-sm btn-danger mx-1"><i class="fa-solid fa-trash "></i></button>
                                            </form>
                                            </div>                         
                                        </td>      
                                    </tr>
                                    @endforeach
                                </tbody>                                
                            </table>
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-12 my-4">
    <a href="{{route('customer.create')}}"> <button class=" btn btn-primary btn-md">➥ Create</button></a>
    </div>
</div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>
@endsection
@push('js')
<script>
    $(document).ready(function () {
       $('#datatable').DataTable({
        // "bProcessing": true,
    // "sAutoWidth": false,
    // "bDestroy":true,
    // "sPaginationType": "bootstrap", // full_numbers
    // "iDisplayStart ": 5,
    // "iDisplayLength": 5,
    "bPaginate": false, //hide pagination
    // "bFilter": false, //hide Search bar
    // "bInfo": false, // hide showing entries
       });

    });
    </script>
@endpush