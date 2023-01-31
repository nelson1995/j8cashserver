@extends('layouts.app')
@section('roles')
        <!-- page content -->
        <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ ' Role ' }}</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{' Role '}}<small>Edit</small></h2>
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
									<form action="{{ route('update_roles') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                        {!! csrf_field() !!}
										
                                        <input type="hidden" name="id" value="{{ $role->id }}">
                                        
										<div class="item form-group">
											<label for="roles" class="col-form-label col-md-3 col-sm-3 label-align">Role</label>
											<div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="roles" name="name" required="required" value ="{{ $role->name}}" class="form-control">
											</div>
                                        </div>

                                        <div class="item form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                                            <label for="permissions">{{ trans('cruds.role.fields.permissions') }}*
                                                <span class="btn btn-info btn-sm select-all">{{ trans('global.select_all') }}</span>
                                                <span class="btn btn-info btn-sm deselect-all">{{ trans('global.deselect_all') }}</span></label>
                                                    <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple" required>
                                                        @foreach($permissions as $permission)
                                                            <option value="{{$permission->id}}" {{ $role->permissions->contains($permission->id) ? 'selected' : '' }}>{{ $permission->name }}</option>
                                                        @endforeach
                                                    </select>                            
                                            @if($errors->has('permissions'))
                                                <p class="help-block">
                                                    {{ $errors->first('permissions') }}
                                                </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('cruds.role.fields.permissions_helper') }}
                                            </p>
                                        </div>  

                                        <div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="{{ route('roles') }}" class="btn btn-primary btn-sm" type="link">Cancel</a>
												<button type="submit" class="btn btn-success btn-sm">Save</button>
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