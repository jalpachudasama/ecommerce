@extends('layouts.default')

@section('content')
			<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Form Inputs</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Aug 19</option>
                                <option value="1">July 19</option>
                                <option value="2">Jun 19</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Product</h4>
                                <form class="mt-3" method="POST" action="{{url('/product')}}" >
                                    @csrf
                                    <div class="form-group">
                                        <select class="form-control" name="product_user_id">
                                            <option value="0">Select User</option>
                                            @foreach($udata as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <small id="name" class="form-text text-muted">User Name</small>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="product_cat_id" id="category_id">
                                            <option value="0">Select Category</option>
                                            @foreach($cdata as $key => $value)
                                            <option value="{{ $value->category_id }}">{{ $value->category_name }}</option>
                                            @endforeach
                                        </select>
                                        <small id="name" class="form-text text-muted">Category Name</small>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="product_sub_id" id="subcategory_id">
                                            <option value="0">Select Sub Category</option>
                                            
                                        </select>
                                        <small id="name" class="form-text text-muted">Sub Category Name</small>
                                    </div>
									<table class="table table-striped table-bordered no-wrap table-responsive">
										@foreach($vdata as $key => $value)
										<tr>
											<th>{{ $key }}</th>
											@foreach($value as $k => $v)
											<td><label style="cursor:pointer;"><input type="checkbox" class="mr-2" name="product_variation_id[]" value="{{ $v['variation_type_id'] }}">{{ $v['variation_type_name'] }}<label></td>
											@endforeach
										</tr>
										@endforeach
									</table>
                                    <div class="form-group">
                                        <small id="name" class="form-text text-muted">Variation</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="product_name" class="form-control" />
                                        <small id="name" class="form-text text-muted">Product Name</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="product_title" class="form-control" />
                                        <small id="name" class="form-text text-muted">Product Title</small>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="product_des" rows="8" class="form-control"></textarea>
                                        <small id="name" class="form-text text-muted">Product Des</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="product_price" class="form-control" />
                                        <small id="name" class="form-text text-muted">Product Price</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="product_selling_price" class="form-control" />
                                        <small id="name" class="form-text text-muted">Product Selling Price</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="product_quantity" class="form-control" />
                                        <small id="name" class="form-text text-muted">Product Quantity</small>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control btn btn-primary" type="submit" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
@endsection
@section('customjs')
<script type="text/javascript">
    $(document).ready(function(){
        $('#category_id').change(function(){
                // alert($('input[name=_token]').val());
                var c = $(this).val();
                var token = $('input[name=_token]').val();

                $.ajax({

                    url:"{{url('/getsubcategory')}}",
                    type:'POST',
                    data:{
                        cat_id:c,
                        _token:token
                    },
                    success: function(data)
                    {
                        $('#subcategory_id').html(data);
                    }
                });

        });
    });
</script>
@endsection
