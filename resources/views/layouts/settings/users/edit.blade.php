@extends('layouts.app')
@section('profile')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{ 'Profile' }}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{'Profile'}}<small>{{$users->name}}</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                                <form action="{{ route('update_user') }}" method="POST" enctype="multipart/form-data">
                                    <div class="row"> 
                                         <!-- profile picture  column 1 -->
                                        @csrf
                                        <input type="hidden" value="{{$user->id}}" name="id"/>
                                        <div class="col-sm-6">
                                            <div class="item form-group d-flex justify-content-center">
                                                <img class="w-50 h-50 p-3" style="border-radius:5%;" id="image" src="{{ $users->profilePicture() === "" ? asset('template-assets/images/avatar.png') : $users->profilePicture() }}"/>
                                            </div>
                                            <div class="item form-group d-flex justify-content-center">
                                                <input type="file"  id="fileUpload" name="image" onChange="previewImage()" style="display: none;"/>
                                                <button type="button" id="upload" onclick="uploadBtn()" class="btn btn-primary btn-sm col-5" >Upload</button>
                                            </div>
                                        </div>
                                        <!-- end profile picture  column 1 here -->

                                        <!-- profile details column 2 -->
                                        <div class="col-sm-6">

                                            <p>
                                            <div class="item form-group">
                                                <div class="col-md-8 col-sm-8  form-group has-feedback">
                                                    <input type="text" class="form-control has-feedback-left" name="fullname" value="{{ $users->name}}" id="inputSuccess2" placeholder="Full Name">
                                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            </p>
                                            <p>
                                            <div class="item form-group">
                                                <div class="col-md-8 col-sm-8  form-group has-feedback">
                                                    <input type="text" class="form-control has-feedback-left" name="username" value="{{ $users->username }}" id="inputSuccess2" placeholder="Username">
                                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            </p>
                                            <p>        
                                            <div class="item form-group">
                                                <div class="col-md-8 col-sm-8  form-group has-feedback">
                                                    <input type="text" class="form-control has-feedback-left" name="email" value="{{ $users->email }}" id="inputSuccess2" placeholder="email">
                                                    <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            </p>
                                            <p>
                                            <div class="item form-group">
                                                <div class="col-md-8 col-sm-8  form-group has-feedback">
                                                    <input type="text" class="form-control has-feedback-left " name="phone" value="{{ $users->phone }}" id="inputSuccess2" placeholder="phone">
                                                    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <div class="col-md-8 col-sm-8  form-group has-feedback">
                                                    <input type="text" class="form-control has-feedback-left " name="points" value="{{ $users->points }}" id="inputSuccess2" placeholder="points">
                                                    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <div class="col-md-8 col-sm-8  form-group has-feedback">
                                                    <select name="country[]" id="country" class="form-control" type="dropdown">
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->id}}" {{ $users->country->contains($country->id) ? 'selected': ''}} >{{ $country->country }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <div class="col-md-8 col-sm-8  form-group has-feedback">
                                                    <select name="role[]" id="role" class="form-control" type="dropdown">
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}" {{$users->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            </p>
                                            <div class="form-group">
                                                <div class="col-md-8 col-sm-8  form-group has-feedback">
                                                    <button id="submitBtn" type="submit" class="btn btn-success btn-sm col-12">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end profile details column 2 here -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script>
        function uploadBtn(){
            $('#fileUpload').trigger('click');
        }

        function previewImage(){
            const image = document.getElementById('image');
            const file = document.getElementById('fileUpload').files[0];
            const reader = new FileReader();

            reader.addEventListener("load",(event)=>{
                image.src = event.target.result;
                console.log("logs "+event.target.result);
            },false);

            if(file){
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
