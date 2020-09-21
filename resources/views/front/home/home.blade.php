@extends('front.master')

@section('content')
    <section>
        @foreach($show_slider as $key => $slider)
        <div class="slideshow-container">
            <div class="mySlides fade">
                <div class="numbertext"></div>
                <img src="{{ asset('/slider-images/'.$slider->image) }}" style="width:100%; height: 600px;">
                <div class="text">{{ $slider->title }}</div>
            </div>
        </div>
        @endforeach
        <br>
        <div style="text-align:center">
            @foreach($show_slider as $key => $slider)
            <span class="dot"></span>
            @endforeach
        </div>
    </section>
    <section class="featured-area section--padding bgcolor" style="box-shadow: 8px 4px 8px 0 rgba(0, 0, 0, 0.2), 10px 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background-color: #1DC9B7">
                    <div class="section-title">
                        <h1 style="color: white; font-weight: bold; margin-top: 20px;">Featured Products</h1>
                    </div>
                </div><!-- Ends: .col-md-12 -->
                <div class="col-md-12">
                    <div class="row">
                        @if(!empty($show_featurd))
                            @foreach($show_featurd as $key => $featurd)
                                <div class="col-md-2" style="margin-top: 15px;">
                                    <div class="card">
                                        @if(!empty($featurd->image))
                                            <img src="{{ asset('product-images/'.$featurd->image) }}" class="fet-img"/>
                                        @else
                                            <img src="{{ asset('frontend/img/sold.jpg') }}" class="fet-img"/>
                                        @endif
                                        <span style="font-weight: bold; color: #0d0f13; margin-left: 25px;">BDT.{{ number_format($featurd->price, 2) }}</span>
                                        <a href="{{ url('/featured-details/'.$featurd->id.'/'.$featurd->featured_name) }}" style="font-weight: normal; color: #0d0f13; margin-bottom: 15px; margin-left: 25px;">{{ substr($featurd->featured_name, 0, 18) }}</a>
                                        <button type="button" class="btn btn-block addCart" data-id="{{ $featurd->id }}" style="background-color: #1DC9B7; color: white">Add to Cart</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div style="margin-top: 30px;">
                        {{ $show_featurd->links() }}
                    </div>
                    <div class="more-item-btn">
                        <a href="{{ url('/more/featured') }}" class="btn btn--lg btn-secondary">More Featured Items</a>
                    </div>
                </div><!-- Ends: .produ-slide-area -->
            </div>
        </div>
    </section><!-- ends: .featured-area -->
    <section class="latest-product section--padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background-color: #8c00ff">
                    <div class="section-title">
                        <h1 style="color: white; font-weight: bold; margin-top: 20px;">Fashionable Products</h1>
                    </div>
                </div><!-- Ends: .col-md-12 -->
                <div class="col-lg-12" style="margin-top: 30px;">
                    <div class="product-list">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <!---Main Categories list--->
                                    @include('front.include.categories')
                                </div>
                                <div class="col-md-9">
                                    <div class="tab-content" id="lp-tab-content">

                                        <div class="tab-pane fade show active" id="all_tab" role="tabpanel" aria-labelledby="tab-one">
                                            <div class="row">
                                                @foreach($products as $key => $product)
                                                    <div  class="col-md-3">
                                                        <div class="product-single latest-single card">
                                                            <div class="product-thumb">
                                                                <figure>
                                                                    <img src="{{ asset('/product-images/'.$product->image) }}" class="product-dimention"/>
                                                                </figure>
                                                            </div>
                                                            <!-- Ends: .product-thumb -->
                                                            <div class="product-excerpt">
                                                                <ul class="titlebtm">
                                                                    <li>
                                                                        <p><span style="font-weight: bold; color: black">BDT. {{ number_format($product->balance,2) }}</span></p><br/>
                                                                        <a href="{{ url('/new/product/details/' .$product->id) }}" style="color: black; font-weight: normal; font-family: Arial">{{ substr($product->name, 0, 20) }}</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <button type="button" class="btn btn-block addToCart" data-id="{{ $product->id }}" style="background-color: #6E4FF6; color: white">Add to Cart</button>
                                                            <!-- Ends: .product-excerpt -->
                                                        </div><!-- Ends: .product-single -->
                                                    </div>
                                                @endforeach
                                            </div>
                                            {{ $products->links() }}
                                        </div><!-- Ends: .tab-pane -->

                                        @foreach($all_category as $c_info)
                                            <div class="tab-pane fade show" id="tab-{{$c_info->id}}" role="tabpanel" aria-labelledby="tab-one">
                                                <div class="row">
                                                    <?php
                                                    $chield = DB::table('sub_categories')
                                                        ->where('main_category_id', $c_info->id)
                                                        ->get();

                                                    foreach ($chield as $ch) {
                                                    $category_by_tab_products_info_1 = DB::table('products')
                                                        ->where('sub_category_id', $ch->id)
                                                        ->get();
                                                    ?>
                                                    @foreach($category_by_tab_products_info_1 as $product)
                                                        <div  class="col-lg-4 col-md-6">
                                                            <div class="product-single latest-single">
                                                                <div class="product-thumb">
                                                                    <figure>
                                                                        <img src="{{ asset('/product-images/'.$product->image) }}"/>
                                                                        <figcaption>
                                                                            <ul class="list-unstyled">
                                                                                {{--                                                            <li><a href="" data-toggle="modal" data-target="#BuyNow"><span class="icon-basket"></span></a></li>--}}
                                                                                <li><a href="{{ url('/new/product/details/'.$product->id) }}" >Buy Now</a></li>
                                                                                <li><a href="">Live Demo</a></li>
                                                                            </ul>
                                                                        </figcaption>
                                                                    </figure>
                                                                </div>
                                                                <!-- Ends: .product-thumb -->
                                                                <div class="product-excerpt">
                                                                    <h5>
                                                                        <a href="{{ url('/new/product/details/' .$product->id) }}">{{ substr($product->short_description,0,50)}}</a>
                                                                    </h5>
                                                                    <ul class="titlebtm">
                                                                        <li>
                                                                            <img src="{{ asset('/product-images/'.$product->image) }}" height="30" width="30"/>
                                                                            <p><a href="{{ url('/new/product/details/' .$product->id) }}">{{ $c_info->main_category }}  </a></p>
                                                                        </li>
                                                                    </ul>
                                                                    <ul class="product-facts clearfix">
                                                                        <li class="price">TK. {{ number_format($product->balance,2) }}</li>
                                                                        <li class="sells">
                                                                            <span class="icon-basket"></span>{{ $product->view_count }}
                                                                        </li>
                                                                        <li class="product-fav">
                                                                            <span class="icon-heart" title="Add to collection" data-toggle="tooltip"></span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- Ends: .product-excerpt -->
                                                            </div><!-- Ends: .product-single -->
                                                        </div>
                                                    @endforeach
                                                    <?php } ?>
                                                </div>
                                            </div><!-- Ends: .tab-pane -->
                                    @endforeach
                                    <!-- Ends: .tab-pane -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center m-top-20">
                            <a href="{{ url('/more/product') }}" target="_blank" class="btn btn--lg btn-primary" style="margin-left: 313px;">More New Products</a>
                        </div>
                    </div>
                    <!-- Ends: .product-list -->
                </div>
            </div>
        </div>
    </section><!-- ends: .latest-product -->
    <section class="counter-up-area bgimage">
        <div class="bg_image_holder">
            <img src="{{ asset('/frontend/') }}/img/bg.jpg" alt="">
        </div><!-- start .container -->
        <div class="container content_above">
            <div class="row">
                <div class="col-md-12">
                    <div class="counter-up">
                        <div class="counter warning">
                            <span class="icon-briefcase"></span>
                            <span class="count_up">38,436</span>
                            <p>Items for sale</p>
                        </div><!-- ends: .counter -->
                        <div class="counter info">
                            <span class="icon-basket"></span>
                            <span class="count_up">68,257</span>
                            <p>Total Sale</p>
                        </div><!-- ends: .counter -->
                        <div class="counter secondary">
                            <span class="icon-emotsmile"></span>
                            <span class="count_up">25,567</span>
                            <p>Happy Customers</p>
                        </div><!-- ends: .counter -->
                        <div class="counter danger">
                            <span class="icon-people"></span>
                            <span class="count_up">76,458</span>
                            <p>Members</p>
                        </div><!-- ends: .counter -->
                    </div><!-- ends: .counter-up -->
                </div><!-- end .col-md-12 -->
            </div>
        </div><!-- end .container -->
    </section>
    <!-- ends: .testimonial2 -->
    <!-- ends: .cta -->
    <section class="featured-area section--padding bgcolor" style="box-shadow: 8px 4px 8px 0 rgba(0, 0, 0, 0.2), 10px 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background-color: #ff4c00">
                    <div class="section-title">
                        <h1 style="color: white; font-weight: bold; margin-top: 20px;">Fresh Vegetables</h1>
                    </div>
                </div><!-- Ends: .col-md-12 -->
                <div class="col-md-12">
                    <div class="row">
                        @if(!empty($homeProducts))
                            @foreach($homeProducts as $key => $home)
                                <div class="col-md-2" style="margin-top: 15px;">
                                    <div class="card">
                                        @if(!empty($home->image))
                                            <img src="{{ asset('product-images/'.$home->image) }}" class="fet-img"/>
                                        @else
                                            <img src="{{ asset('frontend/img/sold.jpg') }}" class="fet-img"/>
                                        @endif
                                        <span style="text-align: center; font-weight: bold; color: #0d0f13">BDT.{{ number_format($home->balance, 2) }} 1Kg</span>
                                        <a href="#" style="text-align: center; font-weight: normal; color: #0d0f13; margin-bottom: 15px;">{{ substr($home->name, 0, 20) }}</a>
                                        <button type="button" class="btn btn-block addToCart" data-id="{{ $home->id }}" style="background-color: #ff4c00; color: white">Add to Cart</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div style="margin-top: 30px;">
                        {{ $homeProducts->links() }}
                    </div>
                </div><!-- Ends: .produ-slide-area -->
            </div>
        </div>
    </section><!-- ends: .featured-area -->
    @endsection

@section('scripts')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-bottom-right"
        };

        $(document).ready(function (){
            $('.addCart').on('click', function (){
                let id = $(this).data('id');
                if (id){
                    $.ajax({
                        url:"{{ url('/add-to-card/') }}/"+id,
                        type: 'GET',
                        dataType: 'json',
                        success:function (data){
                            console.log(data.totalItems)
                            //console.log(JSON.parse(data))
                             $('#totalItems').html(data.totalItems)
                             toastr.success(data.success);
                        }
                    })
                }
            });
        });

        $('.addToCart').on('click', function (){
            let id = $(this).data('id')
            if (id){
                $.ajax({
                    url: "{{ url('/add-to-card/') }}/"+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data){
                        $('#totalItems').html(data.totalItems)
                        toastr.success(data.success);
                    }
                })
            }
        });
    </script>
    <script>
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
    </script>
@endsection
