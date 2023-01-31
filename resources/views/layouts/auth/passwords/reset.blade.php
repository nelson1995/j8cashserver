@extends('layouts.auth.app')
@section('content')
<div id="register" class="animate form login_form">
        <section class="login_content">
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
            <form action="{{ route('password.update') }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{$token}}"/>

                <h1>{{' Change Password '}}</h1>
                <div>
                    <input type="hidden" name="email" class="form-control" placeholder="Email" value="{{ $email }}" />
                </div>
                <div>
                    <input type="password" id ="input-pwd" class="form-control" name="password" placeholder="Password" required=""/>
                </div>
                <div>
                    <input type="password" id ="input-pwd" class="form-control" name="password_confirmation" placeholder="Confirm Password" required=""/>
                </div>
                <div>
                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">{{'Submit'}}</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <h1><i class="fa fa-paw"></i>{{'J8Cash'}}</h1>
                        <p>{{'©'.date('Y').' All Rights Reserved.Privacy and Terms' }}</p>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection