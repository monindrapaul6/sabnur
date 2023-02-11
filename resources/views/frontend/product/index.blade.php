@extends('frontend.layout.app')
@section('content')
    <main class="main-content">

        <!--== Start Product Detail Area Wrapper ==-->
        <div class="product-detail-area section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-detail-thumb me-lg-6">
                            <div class="swiper single-product-thumb-slider">
                                <div class="swiper-wrapper">
                                    @if(count($product->productPictures) > 0)
                                    @foreach($product->productPictures as $productPic)
                                    <a class="lightbox-image swiper-slide" data-fancybox="gallery" href="{{asset($productPic->image_full)}}">
                                        <img src="{{asset($productPic->image_full)}}" width="640" height="530" alt="Image">
                                    </a>
                                    @endforeach
                                    @else
                                        <a class="lightbox-image swiper-slide" data-fancybox="gallery" href="{{asset(\App\Models\Picture::getDefaultImage()->image_full)}}">
                                            <img src="{{asset(\App\Models\Picture::getDefaultImage()->image_full)}}" width="640" height="530" alt="Image">
                                        </a>
                                    @endif
                                </div>
                                <!-- swiper pagination -->
                                <div class="swiper-pagination"></div>
                            </div>
                            <div class="single-product-nav-wrp">
                                <div class="swiper single-product-nav-slider">
                                    <div class="swiper-wrapper">
                                        @if(count($product->productPictures) > 0)
                                            @foreach($product->productPictures as $productPic)
                                            <div class="nav-item swiper-slide">
                                                <img src="{{asset($productPic->image_thumb)}}" alt="Image" width="50" height="50" style="max-width: 125px; max-height: 125px;">
                                            </div>
                                            @endforeach
                                        @else
                                            <div class="nav-item swiper-slide">
                                                <img src="{{asset(\App\Models\Picture::getDefaultImage()->image_thumb)}}" alt="Image" width="50" height="50" style="max-width: 125px; max-height: 125px;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="swiper-button-style11">
                                    <!--== Start Swiper Navigation ==-->
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-detail-content">
                            <h2 class="product-detail-title mt-n1 me-10">{{$product->product_name}}</h2>
                            <div class="product-detail-review">
                                <div class="yotpo bottomLine"
                                     data-yotpo-product-id="{{$product->id}}">
                                </div>
                            </div>
                            <div class="product-detail-price">
                                @if(!in_array($product->product_category->id, \App\Models\Offer::notApplicableCats))
                                    <span class="extraDiscountOffer">extra {{\App\Models\Offer::first()->offer_value}} off on first purchase</span>
                                @endif
                                <div class="d-block mt-3">
                                @if($product->product_discount > 0)<span class="discountPrice">{{'-' . $product->product_discount}}%</span>@endif
                                {{'₹ ' . number_format($product->product_current_price, 2)}}
                                @if($product->product_mrp_price != $product->product_current_price)<span class="price-old">M.R.P: {{'₹ ' . number_format($product->product_mrp_price, 2)}}</span>@endif
                                </div>
                            </div>
                            <div class="product-detail-desc">{!! $product->product_summary !!}</div>

                            <div class="productCondition py-3 mb-5">
                                <label class="d-block mb-3">Product Condition:</label>
                                <span class="{{$product->product_condition == 'Brand New' ? 'ConditionActive' : 'ConditionInactive'}}">Brand New</span>
                                <span class="{{$product->product_condition == 'Refurbished' ? 'ConditionActive' : 'ConditionInactive'}}">Refurbished</span>
                                <span class="{{$product->product_condition == 'Open Box' ? 'ConditionActive' : 'ConditionInactive'}}">Open Box</span>
                            </div>

                            <input type="hidden" name="id" id="id" value="{{$product->id}}"/>

                            @if($product->stock_status == false)
                            <h5>Sorry! Product is Out of Stock</h5>
                            @else
                            <div class="mb-3">
                                <div class="pro-qty">
                                    <input type="text" title="Quantity" name="quantity" id="quantity" value="1">
                                </div>
                                <button class="product-detail-cart-btn" type="button" data-bs-toggle="modal" data-bs-target="#action-CartAddModal" id="cartnow">Add to cart</button>
                            </div>
                            @endif

                        <!-- Add Pixel Events to the button's click handler -->
                            <script type="text/javascript">
                                var button = document.getElementById('cartnow');
                                button.addEventListener(
                                    'click',
                                    function() {
                                        fbq('track', 'AddToCart', {
                                            content_name: "{{$product->product_name}}",
                                            content_category: "{{$product->product_category->category_name}}",
                                            content_type: 'product',
                                            content_ids: ["{{$product->id}}"],
                                            value: "{{$product->product_current_price}}",
                                            currency: 'INR'
                                        });
                                    },
                                    false
                                );
                            </script>

                            <!--<div>
                                <button type="button" class="product-detail-compare-btn" data-bs-toggle="modal" data-bs-target="#action-CompareModal">
                                    <i class="icon icon-shuffle"></i> Compare
                                </button>
                                <button type="button" class="product-detail-wishlist-btn" data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                                    <i class="icon icon-heart"></i> Add to wishlist
                                </button>
                            </div>-->
                            <div class="features-two-area">
                                <div class="row mb-n3">
                                    <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4 mb-3">
                                        <!--== Start Feature Item ==-->
                                        <div class="feature-two-item">
                                            <img class="icon" src="{{asset('static/images/support.png')}}" width="30" height="30" alt="Icon"> <span class="feature-two-title">Support 24/7</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4 mb-3">
                                        <div class="feature-two-item">
                                            <img class="icon" src="{{asset('static/images/card.png')}}" width="30" height="30" alt="Icon"> <span class="feature-two-title">Card Payment</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-6 col-xl-4 mb-3">
                                        <div class="feature-two-item">
                                            <img class="icon" src="{{asset('static/images/shipment.png')}}" width="30" height="30" alt="Icon"> <span class="feature-two-title">Free Shipping</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="product-detail-meta">
                                <li><span>Category:</span> <a href="{{url('/collections/' . $product->product_category->category_slug)}}">{{$product->product_category->category_name}}</a></li>
                                <li><span>Brand</span> <a href="{{url('/brand/' . $product->productBrand->brand_slug)}}">{{$product->productBrand->brand_name}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--== Start Product Detail Tab Area Wrapper ==-->
                <div class="col-12 col-md-12 col-lg-8 mx-auto">
                <div class="nav product-detail-nav" id="product-detail-nav-tab" role="tablist">
                    <button class="product-detail-nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                    @if($product->product_category->category_slug != 'accessories')<button class="product-detail-nav-link" id="specification-tab" data-bs-toggle="tab" data-bs-target="#specification" type="button" role="tab" aria-controls="specification" aria-selected="false">Specification</button>@endif
                    <button class="product-detail-nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Review</button>
                </div>
                <div class="tab-content" id="product-detail-nav-tabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        {!! $product->product_details !!}
                    </div>

                    @if($product->product_category->category_slug != 'accessories')
                    <div class="tab-pane" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                        <table class="table" style="width: 80%; margin-left: auto; margin-right: auto">
                            <tr>
                                <td><strong>OS</strong></td>
                                <td>@isset($product->productAttribute->os){!! $product->productAttribute->os !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>RAM</strong></td>
                                <td>@isset($product->productAttribute->ram){!! $product->productAttribute->ram !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Product Dimensions</strong></td>
                                <td>@isset($product->productAttribute->product_dimensions){!! $product->productAttribute->product_dimensions !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Batteries</strong></td>
                                <td>@isset($product->productAttribute->batteries){!! $product->productAttribute->batteries !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Item Model Number</strong></td>
                                <td>@isset($product->productAttribute->item_model_number){!! $product->productAttribute->item_model_number !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Wireless communication technologies</strong></td>
                                <td>@isset($product->productAttribute->wireless_com_tech){!! $product->productAttribute->wireless_com_tech !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Connectivity Technologies</strong></td>
                                <td>@isset($product->productAttribute->conn_tech){!! $product->productAttribute->conn_tech !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Special Features</strong></td>
                                <td>@isset($product->productAttribute->special_features){!! $product->productAttribute->special_features !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Display Technology</strong></td>
                                <td>@isset($product->productAttribute->display_technology){!! $product->productAttribute->display_technology !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Other Display Features</strong></td>
                                <td>@isset($product->productAttribute->other_display_features){!! $product->productAttribute->other_display_features !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Device Interface Primary</strong></td>
                                <td>@isset($product->productAttribute->device_interface_primary){!! $product->productAttribute->device_interface_primary !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Resolution</strong></td>
                                <td>@isset($product->productAttribute->resolution){!! $product->productAttribute->resolution !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Other camera features</strong></td>
                                <td>@isset($product->productAttribute->other_camera_features){!! $product->productAttribute->other_camera_features !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Form factor</strong></td>
                                <td>@isset($product->productAttribute->form_factor){!! $product->productAttribute->form_factor !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Colour</strong></td>
                                <td>@isset($product->productAttribute->colour){!! $product->productAttribute->colour !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Battery Power Rating</strong></td>
                                <td>@isset($product->productAttribute->battery_power_rating){!! $product->productAttribute->battery_power_rating !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>What’s in the box</strong></td>
                                <td>@isset($product->productAttribute->what_in_the_box){!! $product->productAttribute->what_in_the_box !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Manufacturer</strong></td>
                                <td>@isset($product->productAttribute->manufacturer){!! $product->productAttribute->manufacturer !!}@endisset</td>
                            </tr>
                            <tr>
                                <td><strong>Item Weight</strong></td>
                                <td>@isset($product->productAttribute->item_weight){!! $product->productAttribute->item_weight !!}@endisset</td>
                            </tr>
                        </table>
                    </div>
                    @endif

                    <div class="tab-pane" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <div class="yotpo yotpo-main-widget"
                             data-product-id="{{$product->id}}"
                             data-price="{{$product->product_current_price}}"
                             data-currency="INR"
                             data-name="{{$product->product_name}}"
                             data-url="{{url('/product/' . $product->product_slug)}}"
                             data-image-url="{{asset($product->productDPImage->image_thumb)}}">
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!--== Start Related Product Area Wrapper ==-->
        <div class="product-area section-bottom-space">
            <div class="container">
                <h2 class="section-title text-center mt-n3">Related Products</h2>
                <div class="swiper related-product-slider">
                    <div class="swiper-wrapper">
                        @foreach($relatedProducts as $relatedProduct)
                        <div class="swiper-slide">
                            <div class="product-item">
                                <a class="product-item-thumb" href="{{url('product/' . $relatedProduct->product_slug)}}">
                                    <img src="{{asset($relatedProduct->productDPImage->image_thumb)}}" width="270" height="264" alt="Image-HasTech">
                                </a>
                                @if($relatedProduct->product_discount > 0)<span class="badges">{{'-' . $relatedProduct->product_discount}}%</span>@endif
                                <div class="product-item-info text-center pb-6">
                                    <h5 class="product-item-title mb-2">
                                        <a href="{{url('product/' . $relatedProduct->product_slug)}}">{{ mb_strimwidth($relatedProduct->product_name, 0, 75)}}</a>
                                    </h5>
                                    <span class="productCondition mb-3 mb-lg-0 d-block">{{$product->product_condition}}</span>
                                    <div class="product-item-price">{{'Rs. ' . $relatedProduct->product_current_price}} - <span class="price-old">{{'Rs. ' . $relatedProduct->product_mrp_price}}</span></div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <!--== End Related Product Area Wrapper ==-->
    </main>
    <script>
        $(document).ready(function () {
            $('#cartnow').click(function (e) {
                var id = $('#id').val();
                var quantity = $('#quantity').val();
                /*if(quantity > 1){
                    alert('Due to high demand you can order 1 quantity of this product.');
                }*/
                window.location.href = '{{url("cart/add/")}}'+'/'+id+'/'+quantity;
                return false;
            });
        });
    </script>
@endsection
