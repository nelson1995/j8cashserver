@extends('layouts.app')
@section('withdraws')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ 'Withdraws' }}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Withdraws <small>Users</small></h2>
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
                                                <th>{{'User'}}</th>
                                                <th>{{'Amount'}}</th>
                                                <th>{{'Phone'}}</th>
                                                <th>{{'Date of transaction'}}</th>
                                                <th>{{'Wallet Balance'}}</th>
                                                <th>{{'Transaction reference'}}</th>
                                                <th>{{'Message'}}</th>
                                                <th>{{'Status'}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($withdraws as $withdraw)
                                                    <tr>
                                                        <td>{{$withdraw->user->name}}</td>
                                                        <td>{{$withdraw->amount}}</td>
                                                        <td>{{$withdraw->phone}}</td>
                                                        <td>{{$withdraw->date}}</td>
                                                        <td>{{$withdraw->wallet_balance}}</td>
                                                        <td>{{$withdraw->tx_ref}}</td>
                                                        <td>{{$withdraw->message}}</td>
                                                        <td>{{$withdraw->status}}</td>
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
