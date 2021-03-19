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
                                  <form class="mb-3" action="{{ url('/search_admin') }}" >
                                      <div class="form-group">
                                          <input type="text" name="search_name" value="{{ $s_key->search_name ?? '' }}" class="form-control" placeholder="Search......" />
                                      </div>
                                      <div class="form-group">
                                          <select class="form-control" name="search_state">
                                              <option value="0">Select State</option>
                                              @foreach($sdata as $key => $value )
                                              <option value="{{ $value->state_id }}" {{ ($value->state_id == @$s_key->search_state) ? 'selected' : '' }}>{{ $value->state_name }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                  </form>
                                  <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>E-mail</th>
                                                <th>Gender</th>
                                                <th>Hooby</th>
                                                <th>Date-of-Birth</th>
                                                <th>State Name</th>
                                                <th>City Name</th>
                                                <th>Address</th>
                                                <th>Multiple Image</th>
                                                <th>Profile</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $k => $v)
                                            <tr>
                                                <td>{{$v->id}}</td>
                                                <td>{{$v->name}}</td>
                                                <td>{{$v->email}}</td>
                                                <td>{{$v->gender}}</td>
                                                <td>{{$v->hobby}}</td>
                                                <td>{{$v->dob}}</td>
                                                <td>{{$v->state_name}}</td>
                                                <td>{{$v->city_name}}</td>
                                                <td>{{$v->address}}</td>
                                                <td>
                                                    @foreach($v->multiple as $key => $value)
                                                        <img src="{{ asset('user_image/'.$value['user_image_name']) }}" width="100">
                                                    @endforeach
                                                </td>
                                                <td><img src="{{ asset('image/'.$v->profile) }}" width="100px"/></td>
                                                <td>
                                                    <div style="display:block;">
                                                        <form action="{{ url('/admin/'.$v->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                                        </form>
                                                    </div>
                                                    <div>
                                                        <a href="{{ url('/admin/'.$v->id).'/edit' }}">
                                                            <button class="btn btn-sm btn-primary">Update</button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                    </table>
                                    {{ $data->links() }}
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
