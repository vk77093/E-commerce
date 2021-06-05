@extends('layouts.main')
@section('mainContent')
<div class="content-wrapper">

    <div class="container">
        <div class="row pt120">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="heading align-center mb60">
                    <h4 class="h1 heading-title">Udemy E-commerce tutorial</h4>
                    <p class="heading-text">Buy books, and we ship to you.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- End Books products grid -->

    <div class="container">
        <div class="row pt120">
            <div class="books-grid">

            <div class="row mb30">
                @forelse ($products as $item)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                   <a href="{{route('product.show', $item->id)}}"><div class="books-item">
                        <div class="books-item-thumb">
                            <img src="{{asset('assets/')}}{{$item->pro_image}}" alt="book">
                            <div class="new">New</div>
                            <div class="sale">Sale</div>
                            <div class="overlay overlay-books"></div>
                        </div>

                        <div class="books-item-info">
                            <h5 class="books-title">{{$item->pro_name}}</h5>

                            <div class="books-price">{{$item->pro_price}}</div>
                        </div>
                    </a>
                        <a href="{{route('rapidadd',$item->id)}}" class="btn btn-small btn--dark add">
                            <span class="text">Add to Cart</span>
                            <i class="seoicon-commerce"></i>
                        </a>

                    </div>
                </div>
                @empty
                   <h4 class="text-center">Currently No image is here</h4> 
                @endforelse
            </div>
{{-- @include('includes.paginate') --}}
           
        </div>
        </div>
    </div>
   
</div>
<div class="row pb120">

    <div class="col-lg-12">
{{$products->links()}}
    </div>
</div>
@endsection