@extends('backend.layouts.master')

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

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">                        
                        @if(isset($customer))
                        <h4 class="card-title mb-4">Edit Customer</h4>
                        @else
                        <h4 class="card-title mb-4">Create Customer</h4>
                        @endif

                        <form  method="post"
                        action="{{(@$customer) ? route('customer.update',$customer->id) : route('customer.store')}}" enctype="multipart/form-data">
                            @csrf
                                @if(isset($customer))
                                @method('put')
                                @endif
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="formrow-email-input" value="{{@$customer->name}}" placeholder="Enter Your Name">
                                        @error('name')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="formrow-password-input" value="{{@$customer->email}}" placeholder="Enter Your Email">
                                        @error('email')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="formrow-email-input" value="{{@$customer->phone}}" placeholder="Enter Your Phone">
                                        @error('phone')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label">Shop Name</label>
                                        <input type="text" name="shopname" class="form-control" id="formrow-password-input" value="{{@$customer->shopname}}" placeholder="Enter Your Shop Name">
                                        @error('shopname')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-inputCity" class="form-label">Postal Code</label>
                                        <input type="text" name="postal_code" class="form-control" id="formrow-inputCity" value="{{@$customer->postal_code}}" placeholder="Enter Your Postal Code">
                                        @error('postal_code')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-inputCity" class="form-label">Street Address</label>
                                        <input type="text" name="street_address" class="form-control" id="formrow-inputCity" value="{{@$customer->street_address}}" placeholder="Enter Your Street Address">
                                        @error('street_address')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" id="formrow-email-input" value="{{@$customer->city}}" placeholder="Enter Your City">
                                        @error('city')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-inputState" class="form-label">Upload Image</label>
                                        <div class="custom-file">
                                            <input type="file" name="photo" class="form-control" id="customFile">
                                        </div>
                                        @error('photo')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                            </div>                            
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        
    </div> <!-- container-fluid -->
</div>
@endsection
