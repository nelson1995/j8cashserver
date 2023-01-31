@extends('layouts.app')
@section('transfers')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ 'Transfers' }}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{'Transfers'}}<small>Users</small></h2>
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
                                                <th>{{'Sender\'s name'}}</th>
                                                <th>{{'Date sent (Sender) '}}</th>
                                                <th>{{'Amount sent by sender'}}</th>
                                                <th>{{'Recepient\'s name'}}</th>
                                                <th>{{'Date received (Recepient)'}}</th>
                                                <th>{{'Amount received (Recepient)'}}</th>
                                                <th>{{'Text message'}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($transfers as $transfer)
                                                    <tr>
                                                        <td>{{$transfer->sender->name}}</td>
                                                        <td>{{$transfer->sender_date}}</td>
                                                        <td>{{$transfer->amount}}</td>
                                                        <td>{{$transfer->receiver->name}}</td>
                                                        <td>{{$transfer->receiver_date}}</td>
                                                        <td>{{$transfer->converted_amount}}</td>
                                                        <td>{{$transfer->text}}</td>
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
