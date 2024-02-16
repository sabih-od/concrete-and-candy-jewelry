@extends('front.layout.app')

@section('content')

    <section class="innerBan"
             style="background-image: url('{{ $homeData->cmsImages('background_banner_image') ?? '' }}')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mainHeading text-center text-white">{{ $homeData->content['shop_banner_title'] }}</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="newarrivalSec jewelryInnr">
        <div class="container">
            <div class="freshHeading">
                <h2 class="mainHeading text-center mb-5">{{ isset($category) ? $category->name : "Products" }}</h2>
            </div>
            <div class="row">

                <x-front.product-listing :products="$products" :shop="true"/>

                <div class="col-md-12">
                    <nav class="pagination">
                        {{ $products->links('alerts.custom-pagination') }}
                    </nav>
                </div>

            </div>
        </div>
    </section>


@endsection
