@extends('frontEnd.layouts.master')
@section('title','checkOut Page')
@section('slider')
@endsection
@section('content')
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
        <div class=" row ">
            <form action="{{url('/submit-checkout')}}" method="POST" class="form-horizontal">
                @csrf
                <div class="col-sm-4">

                </div>
                <div class="col-sm-4 offset-2 " >
                    <div class="signup-form"><!--sign up form-->
                        <legend>Shipping To</legend>
                        <div class="form-group {{$errors->has('name')?'has-error':''}}">
                            <input type="text" class="form-control" name="name" id="name" value="" placeholder="Name">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('email')?'has-error':''}}">
                            <input type="text" class="form-control" value="" name="email" id="email" placeholder="Email">
                            <span class="text-danger">{{$errors->first('email')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('phone')?'has-error':''}}">
                            <input type="text" class="form-control" name="phone" value="" id="phone" placeholder="Phone">
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('address')?'has-error':''}}">
                            <input type="text" class="form-control" name="address" value="" id="address" placeholder="Address">
                            <span class="text-danger">{{$errors->first('address')}}</span>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">CheckOut</button>
                    </div><!--/sign up form-->
                </div>
            </form>
        </div>
    </div>
    <div style="margin-bottom: 20px;"></div>
@endsection
