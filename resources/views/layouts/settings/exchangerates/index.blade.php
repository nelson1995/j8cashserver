@extends('layouts.app')
@section('exchangeRate')
        <!-- page content -->
        <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ 'Exchange Rates' }}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{'Exchange rates'}}<small>Countries</small></h2>
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
                                        <a href="{{ route('create_exchangerates') }}" class="btn btn-success btn-sm pull-right" type="link">Add forex</a>
                                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{'From country'}}</th>
                                                <th>{{'From currency'}}</th>
                                                <th>{{'To currency'}}</th>
                                                <th>{{'To country'}}</th>
                                                <th>{{'Exchange rate'}}</th>
                                                <th>{{'Date updated'}}</th>
                                                <th>{{'Action'}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($exchangeRates as $exchangeRate)
                                                    <tr>
                                                        <td>{{$exchangeRate->from_country}}</td>
                                                        <td>{{$exchangeRate->from_currency}}</td>
                                                        <td>{{$exchangeRate->to_currency}}</td>
                                                        <td>{{$exchangeRate->to_country}}</td>
                                                        <td>{{$exchangeRate->rate}}</td>
                                                        <td>{{$exchangeRate->date}}</td>
                                                        <td>
                                                            <a href="{{ route('edit_exchangerate',$exchangeRate->id) }}" class="btn btn-primary btn-sm">{{'Edit'}}</a>
                                                            <a href="{{ route('delete_exchangerate',$exchangeRate->id) }}" class="btn btn-danger btn-sm">{{'Delete'}}</a>
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