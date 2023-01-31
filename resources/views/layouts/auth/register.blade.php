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
            <form action="{{ route('postregister') }}" method="POST">
                @csrf
                <h1>{{'Create Account'}}</h1>
                <div>
                    <input type="text" class="form-control" name="name" placeholder="full name" required="" />
                </div>
                <div>
                    <input type="text" class="form-control" name="username" placeholder="Username" required="" />
                </div>
                <div>
                    <input type="email" class="form-control" name="email" placeholder="Email" required="" />
                </div>
                <div>
                    <input type="text" class="form-control" name="phone" placeholder="phone number" required="" />
                </div>
                <div>
                    <input type="password" id ="input-pwd" class="form-control" name="password" placeholder="Password" required=""/>
                </div>
                <div>
                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign up</button>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">{{'Already a member ?'}}
                        <a href="{{ route('login') }}" class="to_register">{{' Log in '}}</a>
                    </p>

                    <div class="clearfix"></div>
                    <br />

                    <div>
                        <h1>{{'J8Cash'}}</h1>
                        <p>{{'©'.date('Y').' All Rights Reserved.Privacy and Terms' }}</p>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
