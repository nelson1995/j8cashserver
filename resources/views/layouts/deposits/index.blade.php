@extends('layouts.app')
@section('deposits')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ 'Deposits' }}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Deposits <small>Users</small></h2>
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
                                                <th>{{'Payment method'}}</th>
                                                <th>{{'Date of transaction'}}</th>
                                                <th>{{'Wallet Balance'}}</th>
                                                <th>{{'Transaction reference'}}</th>
                                                <th>{{'Message'}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($deposits as $deposit)
                                                    <tr>
                                                        <td>{{$deposit->user->name}}</td>
                                                        <td>{{$deposit->amount}}</td>
                                                        <td>{{$deposit->phone}}</td>
                                                        <td>{{$deposit->payment_method}}</td>
                                                        <td>{{$deposit->date}}</td>
                                                        <td>{{$deposit->wallet_balance}}</td>
                                                        <td>{{$deposit->tx_ref}}</td>
                                                        <td>{{$deposit->message}}</td>
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
