@extends('layouts.app')
@section('airtime')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ 'Airtimes' }}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{'Airtime '}}<small>Users</small></h2>
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
                                                <th>{{'Sender'}}</th>
                                                <th>{{'Amount'}}</th>
                                                <th>{{'Currency'}}</th>
                                                <th>{{'Phone'}}</th>
                                                <th>{{'Discount'}}</th>
                                                <th>{{'Date of transaction'}}</th>
                                                <th>{{'Wallet Balance'}}</th>
                                                <th>{{'Transaction reference'}}</th>
                                                <th>{{'Status'}}</th>
                                                <th>{{'Message'}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($airtimes as $airtime)
                                                    <tr>
                                                        <td>{{$airtime->users->name}}</td>
                                                        <td>{{$airtime->amount}}</td>
                                                        <td>{{$airtime->currency}}</td>
                                                        <td>{{$airtime->phone}}</td>
                                                        <td>{{$airtime->discountString}}</td>
                                                        <td>{{$airtime->date}}</td>
                                                        <td>{{$airtime->wallet_balance}}</td>
                                                        <td>{{$airtime->requestId}}</td>
                                                        <td>{{$airtime->status}}</td>
                                                        <td>{{$airtime->message}}</td>
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
