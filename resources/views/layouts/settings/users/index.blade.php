@extends('layouts.app')
@section('users')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ 'User\'s' }}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{'User\'s'}}<small>list</small></h2>
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
                                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{'Avatar'}}</th>
                                                <th>{{'Full names'}}</th>
                                                <th>{{'Username'}}</th>
                                                <th>{{'Email'}}</th>
                                                <th>{{'Country'}}</th>
                                                <th>{{'Mobile'}}</th>
                                                <th>{{'Points'}}</th>
                                                <th>{{'Role'}}</th>
                                                <th>{{'Action'}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user1)
                                                    <tr>
                                                        <td class="d-flex justify-content-center"><img class="w-25 h25" src="{{ $user1->profilePicture() === "" ? asset('template-assets/images/avatar.png') : $user1->profilePicture() }}" /></td>
                                                        <td>{{$user1->name}}</td>
                                                        <td>{{$user1->username}}</td>
                                                        <td>{{$user1->email}}</td>
                                                        <td>{{$user1->country[0]->country}}</td>
                                                        <td>{{$user1->phone}}</td>
                                                        <td>{{$user1->points}}</td>
                                                        <td>{{$user1->getRoleNames()[0]}}</td>
                                                        <td>
                                                            <a href="{{ route('edit_users',$user1->id) }}" class="btn btn-primary btn-sm">{{'Edit'}}</a>
                                                            <a href="{{ route('delete_user',$user1->id) }}" class="btn btn-danger btn-sm">{{'Delete'}}</a>
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