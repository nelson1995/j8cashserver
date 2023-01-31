@extends('layouts.app')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row" style="display: inline-block;" >
            <div class="tile_count">
                <div class="col-md-2 col-sm-4  tile_stats_count">
                    <!-- <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                    <div class="count" id="user_count"></div> -->
                </div>

            </div>
        </div>

        <!-- /top tiles -->
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="dashboard_graph">
                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>{{'Transactions'}}</h3>
                        </div>
                        <div class="col-md-6">
                            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span>June 30, 2020 - July 9, 2020</span> <b class="caret"></b>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-12">
                       <canvas id="transactionsChart" class="rounded shadow"></canvas>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <br />
        <!-- /top tiles -->
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="dashboard_graph">

                    <div class="row x_title">
                        <div class="col-md-6">
                            <h3>{{'User\'s '}}</h3>
                        </div>
                        <div class="col-md-6">
                            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span>June 10, 2020 - July 9, 2020</span> <b class="caret"></b>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 ">
                        <!-- user's line graph  -->
                        <div class="x_panel tile fixed_height_320 overflow_hidden">
                            <div class="x_title">
                                <h5>{{'Registered user\'s'}}</h5>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        
                            <canvas id="usersGraph" class="rounded shadow"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="x_panel tile fixed_height_320 overflow_hidden">
                            <div class="x_title">
                                <h5>{{'Registered user\'s per country'}}</h5>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table class="" style="width:100%">
                                    <tr>
                                        <th style="width:37%;">
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <canvas id="bargraph"></canvas>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <br/>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script type="text/javascript"> 
        $(document).ready(function(){
            var ctx = document.getElementById("usersGraph").getContext("2d");
            var url = "{{url('/home/charts')}}";
            var lineChart = new Chart(ctx,{
                type: 'line',
                data: {
                    labels: '',
                    datasets: [{
                        label: 'registered users',
                        data: [],
                        backgroundColor:'',
                        borderWidth: 1,
                        fill:true
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            usersLineChart(lineChart,url);

            var ctx1 = document.getElementById("bargraph").getContext("2d");
            var countryChart = new Chart(ctx1,{
                type: 'bar',
                data: {
                    labels: '',
                    datasets: [{
                        label: 'no of users',
                        data: [],
                        backgroundColor:'',
                        borderWidth: 1,
                        fill:true
                    }]
                },
                options: {}
            });

            countryBarchart(countryChart,url);

            var ctx2 = document.getElementById("transactionsChart").getContext("2d");
            var transactionsChart = new Chart(ctx2,{
                type: 'line',
                data: {
                    labels: '',
                    datasets: [{
                        label: 'Airtime',
                        data: [],
                        backgroundColor:'',
                        borderWidth: 1,
                        fill:false
                    },
                    {
                        label: 'Deposits',
                        data: [],
                        backgroundColor:'',
                        borderWidth: 1,
                        fill:false
                    },
                    {
                        label: 'WithDraws',
                        data: [],
                        backgroundColor:'',
                        borderWidth: 1,
                        fill:false
                    },
                    {
                        label: 'Transfers',
                        data: [],
                        backgroundColor:'',
                        borderWidth: 1,
                        fill:false
                    }]
                },
                options: {}
            });
            transactions(transactionsChart,url);
        });

        function usersLineChart(chart,url){
            $.get(url, function(response){
                chart.data.datasets[0].data = response.registeredUsers;
                console.log("users: "+response.registeredUsers);
                chart.data.labels = ['January','February','March','April','May','June','July','August','September','November','December'];
                chart.data.datasets[0].backgroundColor = '#3498db';
                chart.update();
                $('#user_count').val(response.registeredUsers);
            });
        }
        function countryBarchart(chart,url){
            $.get(url, function(response){
                let rwanda = response.registeredUsersPerCountry['Rwanda'];
                let kenya = response.registeredUsersPerCountry['Kenya'];
                let uganda = response.registeredUsersPerCountry['Uganda'];
                let zambia = response.registeredUsersPerCountry['Zambia'];
                chart.data.datasets[0].data = [rwanda,kenya,uganda,zambia];
                chart.data.labels = ['Rwanda','Kenya','Uganda','Zambia'];
                chart.data.datasets[0].backgroundColor = '#008000';
                chart.update();
            });
        } 

        function transactions(chart,url){
            $.get(url, function(response){
                chart.data.labels = ['January','February','March','April','May','June','July','August','September','November','December'];
                chart.data.datasets[0].backgroundColor = '#f39c12';
                chart.data.datasets[1].backgroundColor = '#3498db';
                chart.data.datasets[2].backgroundColor = '#e74c3c';
                chart.data.datasets[3].backgroundColor = '#008000';

                chart.data.datasets[0].data = response.airtimeMonthlyTransactions;
                chart.data.datasets[1].data = response.monthlyDeposits;
                chart.data.datasets[2].data = response.monthlyWithDraws;
                chart.data.datasets[3].data = response.monthlyTransfers;
                
                chart.update();
            });
        }
    </script>
@endsection
