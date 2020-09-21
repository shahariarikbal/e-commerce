@extends('front.master')

@section('content')

    <section class="latest-product section--padding">
        @if($message  = Session::get('message'))
            <div class="alert alert-success">
                <h3>{{ $message }}</h3>
            </div>
        @endif
        <div class="container-fluid">
            <span style="color: red; text-align: center; font-size: 30px;"> {{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>
            <span style="color: red; text-align: center; font-size: 30px;"> {{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</span>
            <div class="row">
                <!-- Ends: .col-md-12 -->
                <div class="col-md-3">
                    @include('front.include.categories')
                </div>
                <div class="col-lg-6" style="border: 0px solid #0d0d0d;">
                    <div class="product-list">
                        <div class="tab-content" id="lp-tab-content">
                            <div class="tab-pane fade show active" id="tab" role="tabpanel" aria-labelledby="tab-one">
                                <div class="row">
                                    <div  class="col-sm-12">

                                        <div class="product-single latest-single">

                                            <div class="product-thumb">
                                                <img id="myImg" src="{{ asset('/product-images/'.$featured_details->image) }}" alt="Snow" style="width:100%;height: 100%">
                                            </div>
                                            <!-- Ends: .product-thumb -->
                                            <div class="product-excerpt">
                                                <h5>
                                                    <h2><u>{{ $featured_details->category->main_category }}</u></h2>
                                                </h5>
                                                <h5>
                                                    {!! $featured_details->long_description !!}
                                                </h5>

                                            </div>
                                            <!-- Ends: .product-excerpt -->
                                        </div><!-- Ends: .product-single -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                </div>
                <!-- Ends: .product-list -->
                <div class="col-sm-3" style="border-left: 2px solid #d4edda;">
                    <div class="card-header bg-primary" style="border-radius: 8px 8px 0px 0px;"><h3 style="color: #ffffff;">Product Specification</h3></div>
                    <div class="card-header">
                        <h4 >
                            Name :  <em style="color: #0e90d2; font-size: 15px;">{{ substr($featured_details->featured_name, 0, 18) }}</em>
                        </h4>
                    </div>
                    <div class="card-header">
                        <h4 >
                            Price :  <em style="color: #0e90d2; font-size: 18px;">TK. {{ number_format($featured_details->price,2) }}</em>
                        </h4>
                    </div>
                    <div class="card-header">
                        <h4 >
                            Color : <em style="color: #0e90d2; font-size: 18px;">Blue</em>
                        </h4>
                    </div>
                    <div class="card-header">
                        <h4 >
                            Fabric : <em style="color: #0e90d2; font-size: 18px;">Cotton 160GSM</em>
                        </h4>
                    </div>
                    <div class="card-header bg-primary" style="border-radius: 0px 0px 8px 8px;"><h3 style="color: #ffffff; text-align: center;">Best Quality</h3></div>
                    <div class="text-center m-top-20">
                        <a href="#" class="btn btn--lg btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>

        {{--        Customer Order Form--}}

    </section>
    <div class="container-fluid">
        <div class="col-md-12">
            <h2 style="text-align: center; color: #0a8cf0; border-bottom: 2px solid lightslategray">Related Products</h2>
            <div class="row">
                @if(!empty($related))
                    @foreach($related as $featurd)
                    <div class="col-md-2" style="margin-top: 15px;">
                        <div class="card">
                            @if(!empty($featurd->image))
                                <a href="{{ url('/featured-details/'.$featurd->id.'/'.$featurd->featured_name) }}"> <img src="{{ asset('product-images/'.$featurd->image) }}" class="fet-img"/></a>
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
                {{ $related->links() }}
            </div>
        </div>
    </div>
    <br/>
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
    </script>
@endsection
