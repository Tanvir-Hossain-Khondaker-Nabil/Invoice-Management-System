@extends('backend.layouts.master')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Taxs</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tax</a></li>
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
                        @if(isset($tax))
                        <h4 class="card-title mb-4">Edit Tax</h4>
                        @else
                        <h4 class="card-title mb-4">Create Tax</h4>
                        @endif

                        <form  method="post"
                        action="{{(@$tax) ? route('tax.update',$tax->id) : route('tax.store')}}" enctype="multipart/form-data">
                            @csrf
                                @if(isset($tax))
                                @method('put')
                                @endif
                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label">Tax</label>
                                        <input type="text" name="tax" class="form-control" id="formrow-email-input" value="{{@$tax->tax}}" placeholder="Enter Your Tax">
                                        @error('tax')
                                        <code>*{{$tax}}</code>
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
