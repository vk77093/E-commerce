<!DOCTYPE html>
<html lang="en">
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Shopping-{{$title ?? ''}}</title>

    <link rel="stylesheet" type="text/css"   href="{{asset('assets/css/fonts.css')}}">
    <link rel="stylesheet" type="text/css"   href="{{asset('assets/css/crumina-fonts.css')}}">
    <link rel="stylesheet" type="text/css"   href="{{asset('assets/css/normalize.css')}}">
    <link rel="stylesheet" type="text/css"  href="{{asset('assets/css/grid.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/styles.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!--Plugins styles-->

    <link rel="stylesheet" type="text/css"   href="{{asset('assets/css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css"   href="{{asset('assets/css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css"   href="{{asset('assets/css/primary-menu.css')}}">
    <link rel="stylesheet" type="text/css"   href="{{asset('assets/css/magnific-popup.css')}}">

    <!--Styles for RTL-->

    <!--<link rel="stylesheet" type="text/css" href="css/rtl.css">-->

    <!--External fonts-->

    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>

</head>


<body class=" ">

<header class="header" id="site-header">

    <div class="container">

        <div class="header-content-wrapper">

            <ul class="nav-add">
                <li class="cart">

                    <a href="#" class="js-cart-animate">
                        <i class="seoicon-basket"></i>
                        @if (Cart::count()<=0)
                        <span class="cart-count">0</span>  
                        @else
                        <span class="cart-count">{{Cart::count()}}</span>  
                        @endif
                    </a>

                    <div class="cart-popup-wrap">
                        <div class="popup-cart">
                            @if (Cart::count() <= 0)
                            <h4 class="title-cart">No products in the cart!</h4>
                            <p class="subtitle">Please make your choice.</p>  
                            @else
                            <h4 class="title-cart">You Have Total {{Cart::count()}} Product</h4>
                            <p class="subtitle">The Total Price For Product is {{Cart::total()}}</p> 
                            @endif
                          
                            <div class="btn btn-small btn--dark">
                                <a href="{{route('cart')}}"><span class="text">view all catalog</span></a>
                            </div>
                        </div>
                    </div>

                </li>
            </ul>
        </div>

    </div>

</header>
<div class="content-wrapper">
@yield('mainContent')

</div>
<!-- Footer -->

<footer class="footer">
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                </div>
            </div>
        </div>
    </div>
</footer>



<script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('assets/js/crum-mega-menu.js')}}"></script>
<script src="{{asset('assets/js/swiper.jquery.min.js')}}"></script>
<script src="{{asset('assets/js/theme-plugins.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/js/form-actions.js')}}"></script>
<script src="{{asset('assets/js/velocity.min.js')}}"></script>
<script src="{{asset('assets/js/ScrollMagic.min.js')}}"></script>
<script src="{{asset('assets/js/animation.velocity.min.js')}}"></script>

<!-- ...end JS Script -->


</body>

<!-- Mirrored from theme.crumina.net/html-seosight/16_shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 27 Nov 2016 13:03:04 GMT -->
</html>