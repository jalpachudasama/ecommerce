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
                                <h4 class="card-title">Variation Type</h4>
                                <form class="mt-3" method="POST" action="{{url('/variationtype')}}" >
                                    @csrf
                                    <div class="form-group">
                                        <select class="form-control" name="variation_id">
                                            <option value="0">Select Variation</option>
                                            @foreach($data as $key => $value)
                                            <option value="{{ $value->variation_id }}">{{ $value->variation_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="divadd" aria-describedby="name" />
                                        <small class="form-text text-muted">Variation Type Field Number</small>
                                    </div>
                                    <div class="form-group" id="multidiv">
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
	$('#divadd').keyup(function(){
		var num = $(this).val();
		$.ajax({
			url : '{{ url('/jsmethod') }}',
			type : 'GET',
			data :
			{
				number : num,
			},
			success:function(res)
			{
				$('#multidiv').html(res);
			}
		});
	})
</script>
@endsection
