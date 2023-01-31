@extends('layouts.app')
@section('permissions')
        <!-- page content -->
        <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ ' Permission ' }}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{' Permission '}}<small>Create</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
									@if ($errors->any())
										<div class="alert alert-danger" style="padding: 10px;">
											<ul>
												@foreach ($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
									@endif
									@if(session('status'))
										<div class="alert alert-success" style="padding: 10px;">
											{{ session('status') }}
										</div>
									@endif
									<form action="{{route('store_permission')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                        {!! csrf_field() !!}
										
										<div class="item form-group">
											<label for="permission" class="col-form-label col-md-3 col-sm-3 label-align">Name</label>
											<div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="permission" name="name" required="required" value ="" class="form-control">
											</div>
                                        </div>

										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="{{ route('permissions') }}" class="btn btn-primary btn-sm" type="link">Cancel</a>
												<button type="submit" class="btn btn-success btn-sm">Create</button>
											</div>
										</div>
									</form>
                                	</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection