@extends('layouts.auth.app')
@section('content')
            <div class="animate form login_form">
                <section class="login_content">
                    @if ($errors->any())
                        <div class="alert alert-danger" style="padding: 10px;">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                        </div>
                    @endif
                    <form action="{{ route('postlogin') }}" method="POST">
                        @csrf
                        <h1>Login</h1>
                        <div>
                            <input type="text" name="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                            <a class="reset_pass" href="{{ route('password.reset') }}">Lost your password?</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <!-- <p class="change_link">{{'New to site?'}}
                                <a href="{{ route('register') }}" class="to_register">{{' Create Account '}}</a>
                            </p> -->

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

