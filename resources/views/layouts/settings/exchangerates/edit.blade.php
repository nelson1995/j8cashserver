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
                            <h2>{{'Exchange rates'}}<small>Edit</small></h2>
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
									<form action="{{route('update_forex')}}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                        {!! csrf_field() !!}
										
										<input type="hidden" name="id" value="{{ $exchangeRates->id }}">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">From country<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="last-name" name="from_country" required="required" value="{{ $exchangeRates->from_country}}"class="form-control">
											</div>
										</div>
										<div class="item form-group">
											<label for="from_currency" class="col-form-label col-md-3 col-sm-3 label-align">From currency</label>
											<div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="from_currency" name="from_currency" required="required" value ="{{ $exchangeRates->from_currency}}" class="form-control">
											</div>
                                        </div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="to_country">To country<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="to_country" name="to_country" required="required" value ="{{ $exchangeRates->to_country}}" class="form-control">
											</div>
										</div>
										<div class="item form-group">
											<label for="to_currency" class="col-form-label col-md-3 col-sm-3 label-align">To currency</label>
											<div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="to_currency" name="to_currency" required="required" value ="{{ $exchangeRates->to_currency }}" class="form-control">
											</div>
                                        </div>

										<div class="item form-group">
											<label for="forexrate" class="col-form-label col-md-3 col-sm-3 label-align">Exchange rate</label>
											<div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="forexrate" name="rate" required="required" value ="{{ $exchangeRates->rate}}" class="form-control">
											</div>
                                        </div>

										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<a href="{{ route('exchange_rates') }}" class="btn btn-primary btn-sm" type="link">Cancel</a>
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