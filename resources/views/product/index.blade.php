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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                  @isset($msg)
                                      {{ $msg }}
                                  @endisset
                                  <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Category Name</th>
                                                <th>Sub Category Name</th>
                                                <th>Product Name</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Selling Price</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $k => $v)
                                            <tr>
                                                <td>{{ $v['product_id'] }}</td>
                                                <td>{{ $v['name'] }}</td>
                                                <td>{{ $v['category_name'] }}</td>
                                                <td>{{ $v['sub_cat_name'] }}</td>
                                                <td>{{ $v['product_name'] }}</td>
                                                <td>{{ $v['product_title'] }}</td>
                                                <td>{{ $v['product_des'] }}</td>
                                                <td>${{ $v['product_price'] }}</td>
                                                <td>${{ $v['product_selling_price'] }}</td>
                                                <td>{{ $v['product_quantity'] }}</td>
                                                <td>
                                                    <form class="" action="{{ url('/product/'.$v['product_id']) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                    <a href="{{ url('/product/'.$v['product_id'].'/edit') }}" class="btn btn-sm btn-primary">Update</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <!-- <th  style="vertical-align:middle">Variations</th> -->
                                                <td colspan="10">
                                                    <table>
                                                        @foreach($data['v_name'] as $m=>$n)
                                                        <tr>

                                                            <th>{{$m}}</th>
                                                            @foreach($n as $p=>$q)
                                                            <td>{{$q['variation_type_name']}}</td>
                                                        @endforeach
                                                        </tr>
                                                        @endforeach
                                                    </table>

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
