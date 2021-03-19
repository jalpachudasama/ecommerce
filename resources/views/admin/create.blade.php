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
                                <h4 class="card-title">Admin</h4>
                                <form class="mt-3" method="POST" action="{{url('/admin')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nametext" aria-describedby="name"
                                            name="name" value="{{old('name')}}">
                                        <small id="name" class="form-text text-muted">Name</small>
                                        @error('name')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nametext" aria-describedby="name"
                                            name="email" value="{{old('email')}}">
                                        <small id="name" class="form-text text-muted">E-mail</small>
                                          @error('email')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nametext" aria-describedby="name"
                                            name="n_password" value="{{old('n_password')}}">
                                        <small id="name" class="form-text text-muted" >Password</small>
                                        @error('n_password')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Gender</h4>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                        value="Male" name="gender" {{ (old('gender') == 'Male') ? 'checked': ''}}>
                                                    <label class="form-check-label" for="inlineCheckbox1">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="inlineCheckbox2"
                                                        value="Female" name="gender">
                                                    <label class="form-check-label" for="inlineCheckbox2">Female</label>
                                                </div>
                                            </div>
                                                @error('gender')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Hobby</h4>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                        value="Playing" name="hobby[]">
                                                    <label class="form-check-label" for="inlineCheckbox1">Playing</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                        value="Dancing" name="hobby[]">
                                                    <label class="form-check-label" for="inlineCheckbox2">Dancing</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2"
                                                        value="Gaming" name="hobby[]">
                                                    <label class="form-check-label" for="inlineCheckbox2">Gaming</label>
                                                </div>
                                            </div>
                                             @error('hobby')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="nametext" aria-describedby="name"
                                            name="dob">
                                        <small id="name" class="form-text text-muted">Date of Birth</small>
                                    </div>
									<div class="form-group">
										<select class="form-control" name="state_id" id="state_select">
											<option value="-1">Select State</option>
											@foreach($sdata as $key => $value)
											<option value="{{ $value->state_id }}">{{ $value->state_name }}</option>
											@endforeach
										</select>
                                          @error('state_id')
                                            <div class="alert alert-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
										<small class="form-text text-muted">State</small>
									</div>
									<div class="form-group">
										<select class="form-control" name="city_id" id="city_select">
											<option value="0">Select City</option>
											@foreach($cdata as $key => $value)
											<option value="{{ $value->city_id }}">{{ $value->city_name }}</option>
											@endforeach
										</select>
										<small class="form-text text-muted">City</small>
									</div>
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" id="nametext" aria-describedby="name"
                                            rows="5" name="address"></textarea>
                                        <small id="name" class="form-text text-muted">Address</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control" id="nametext" aria-describedby="name"
                                            name="profile">
                                        <small id="name" class="form-text text-muted">Profile</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control" id="nametext" aria-describedby="name"
                                            name="user[]" multiple>
                                        <small id="name" class="form-text text-muted">Multiple Images</small>
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
	$('#state_select').change(function(){
		var id = $(this).val();
		$.ajax({
			url : '{{ url('/stateajax') }}',
			type : 'GET',
			data : {
				id : id,
			},
			success:function(res)
			{
				$('#city_select').html(res);
			}
		});
	});

	$('#city_select').change(function(){
		var id = $(this).val();
		$.ajax({
			url : '{{ url('/cityajax') }}',
			type : 'GET',
			data : {
				id : id,
			},
			success:function(res)
			{
				$('#state_select').html(res);
			}
		});
	});
</script>
@endsection
