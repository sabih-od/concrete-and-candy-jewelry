@extends('front.layout.app')

@section('content')
    <!-- breadcrumb -->
    <section class="innerBan" style="background-image: url('images/innerBg.jpg') ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mainHeading text-center text-white">Wishlists</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb -->
    <!--==================== Wishlist Section Start ====================-->
    <div class="full-row mt-5">
        <div class="container" id="ajaxContent">
            <div class="row wish_load">
                <div class="col-12">
                    <table class="shop_table cart d-block wishlist_table wishlist_view traditional table" data-pagination="no"
                           data-per-page="5" data-page="1" data-id="3989" data-token="G5CZRAZPRKEY">
                        <thead>
                        <tr>
                            <th class="product-thumbnail">{{ __('Product Image') }}</th>
                            <th class="product-name"><span class="nobr"> {{ __('Product name') }} </span></th>
                            <th class="product-price"><span class="nobr"> {{ __('Unit price') }} </span></th>
                            <th class="product-stock-status"><span class="nobr"> {{ __('Stock status') }} </span></th>
                            <th class="product-add-to-cart"><span class="nobr"> </span>{{ __('Actions') }}</th>
                            <th class="product-remove"><span class="nobr"> </span></th>
                        </tr>
                        </thead>
                        <tbody class="wishlist-items-wrapper">
                        @foreach($wishlists as $wishlist)
                            <tr id="yith-wcwl-row-103" data-row-id="103">
                                <td class="product-thumbnail">
                                    <a href="{{ route('front.shop.product', $wishlist->slug) }}"> <img
                                            src="{{$wishlist->productImage()}}"
                                            alt=""> </a>
                                </td>
                                <td class="product-name"><a class="text-dark"
                                        href="{{ route('front.shop.product', $wishlist->slug) }}">{{  mb_strlen($wishlist->name,'UTF-8') > 35 ? mb_substr($wishlist->name,0,35,'UTF-8').'...' : $wishlist->name }}</a>
                                </td>
                                <td class="product-price"> <span class="woocommerce-Price-amount amount"><bdi><span
                                                class="woocommerce-Price-currencySymbol">${{ $wishlist->price ?? '' }}  <small>
                        </small></bdi>
                        </span>
                                </td>
                                <td class="product-stock-status">
                                    @if($wishlist->stock_quantity < 1 )
                                        <div class="stock-availability out-stock">{{ ('Out Of Stock') }}</div>
                                    @else
                                        <div class="stock-availability in-stock text-bold">{{ ('In Stock') }}</div>
                                    @endif
                                </td>
                                <td class="product-add-to-cart">
                                    <!-- Date added -->
                                    {{-- PRODUCT QUANTITY SECTION ENDS --}}
                                    @if($wishlist->stock_quantity < 1)
                                        <li class="addtocart">
                                            <a href="javascript:;" class="cart-out-of-stock">
                                                {{ __('Out Of Stock') }}</a>
                                        </li>
                                    @else
                                        <form action="{{ route('front.cart.add' , $wishlist->id) }}" method="POST">
                                            @csrf
                                            <li class="addtocart">
                                                <button
                                                    class="add-cart">{{ __('Add to Cart')}}</button>
                                            </li>
                                        </form>

                                @endif
                                <!-- Remove from wishlist -->
                                </td>
                                <td class="product-remove">
                                    <div>
                                        <a href="{{ route('user-wishlist-remove', App\Models\Wishlist::where('user_id','=',$user->id)->where('product_id','=',$wishlist->id)->first()->id ) }}"
                                           class="remove wishlist-remove remove_from_wishlist"
                                           title="Remove this product">×</a>
                                    </div>
                                </td>
                                <input type="hidden" id="product_id" value="{{ $wishlist->id }}">
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
