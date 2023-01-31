@extends('layouts.app')
@section('roles')
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ 'Roles' }}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{' Roles and permissions '}}<small>List</small></h2>
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
                                        <a href="{{ route('create_role') }}" class="btn btn-success btn-sm pull-right" type="link">Create role</a>
                                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{'Role'}}</th>
                                                <th>{{'Permissions'}}</th>
                                                <th>{{'Action'}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($roles as $role)
                                                    <tr>
                                                        <td>{{$role->name}}</td>
                                                        <td>
                                                            @foreach($role->permissions as $key => $item)
                                                                <span class="badge badge-pill badge-info">{{$item->name}}</span>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('edit_roles',$role->id) }}" class="btn btn-primary btn-sm">{{'Edit'}}</a>
                                                            <a href="{{ route('delete_roles',$role->id) }}" class="btn btn-danger btn-sm">{{'Delete'}}</a>
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
                </div>
            </div>
        </div>
    </div>
@endsection