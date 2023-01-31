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
                <div class="alert alert-info" style="padding: 10px;">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <h1>{{'Forgot password'}}</h1>
        
                <div>
                    <input type="email" class="form-control" name="email" placeholder="Email" required="" />
                </div>
                
                <div>
                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">{{'Send reset password link'}}</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">{{'back to login'}}
                        <a href="{{ route('login') }}" class="to_register">{{' Log in '}}</a>
                    </p>

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