@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Items</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Item</a></li>
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
                        @if(isset($product))
                        <h4 class="card-title mb-4">Edit Item</h4>
                        @else
                        <h4 class="card-title mb-4">Create Item</h4>
                        @endif

                        <form  method="post"
                        action="{{(@$product) ? route('product.update',$product->id) : route('product.store')}}" enctype="multipart/form-data">
                            @csrf

                                @if(isset($product))
                                @method('put')
                                @endif
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Item Name</label>
                                        <input type="text" name="name" class="form-control" id="formrow-email-input" value="{{@$product->name}}" placeholder="Enter Your Name">
                                        @error('name')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label">Item Code</label>
                                        <input type="text" name="code" class="form-control" id="formrow-password-input" value="{{@$product->code}}" placeholder="Enter Your Item Code">
                                        @error('code')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-inputCity" class="form-label">Item Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="formrow-inputCity" value="{{@$product->quantity}}" placeholder="Enter Your Item Quantity">
                                        @error('quantity')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label">Item Price</label>
                                        <input type="text" name="price" class="form-control" id="formrow-password-input" value="{{@$product->price}}" placeholder="Enter Your Item Price">
                                        @error('price')
                                        <code>*{{$message}}</code>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-inputCity" class="form-label">Details</label>
                                        <input type="text" name="details" class="form-control" id="formrow-inputCity" value="{{@$product->details}}" placeholder="Enter Your Details">
                                        @error('details')
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
