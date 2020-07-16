@extends('frontEnd.layouts.master')
@section('title','List Products')
@section('slider')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('frontEnd.layouts.category_menu')
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <?php
                            if($byCate!=""){
                                $products=$list_product;
                                echo '<h2 class="title text-center">Category '.$byCate->name.'</h2>';
                            }else{
                                echo '<h2 class="title text-center">List Products</h2>';
                            }
                    ?>
                    @foreach($products as $product)

                            <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{url('/product-detail',$product->id)}}"><img src="{{url('products/small/',$product->image)}}" alt="" /></a>
                                        <h2>$ {{$product->price}}</h2>
                                        <p>{{$product->p_name}}</p>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>$ {{$product->price}}</h2>
                                            <p>{{$product->p_name}}</p>
                                            <p>{{$product->p_code}}</p>
                                            <p>{{$product->p_color}}</p>


                                        </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                         <li><a href="{{route('addToCart')}}">
                                        <form action="{{route('addToCart')}}" method="post" role="form">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" name="products_id" value="{{$product->id}}">
                                            <input type="hidden" name="product_name" value="{{$product->p_name}}">
                                            <input type="hidden" name="product_code" value="{{$product->p_code}}">
                                            <input type="hidden" name="product_color" value="{{$product->p_color}}">
                                            <input type="hidden" name="price" value="{{$product->price}}" id="dynamicPriceInput">
                                            <input type="hidden" name="quantity" value="1" id="quantity">
                                            <button type="submit" class="btn btn-fefault cart" id="buttonAddToCart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Add to cart
                                            </button></a></li>
                                        </form>
                                        <li><a href="{{url('/product-detail',$product->id)}}"><i class="fa fa-plus-square"></i>Detail</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    {{--<ul class="pagination">
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">&raquo;</a></li>
                    </ul>--}}
                </div><!--features_items-->
            </div>
        </div>
    </div>
@endsection
