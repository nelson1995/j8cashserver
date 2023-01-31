@extends('layouts.app')
@section('permissions')
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ 'Permissions' }}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{'Permissions'}}<small>List</small></h2>
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
                                        <a href="{{ route('create_permission') }}" class="btn btn-success btn-sm pull-right" type="link">Create permission</a>
                                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{'Name'}}</th>
                                                <th>{{'Action'}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($permissions as $permission)
                                                    <tr>
                                                        <td>{{$permission->name}}</td>
                                                        <td>
                                                            <a href="{{ route('edit_permission',$permission->id) }}" class="btn btn-primary btn-sm">{{'Edit Permission'}}</a>
                                                            <a href="{{ route('delete_permission',$permission->id) }}" class="btn btn-danger btn-sm">{{'Delete Permission'}}</a>
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