<x-base-layout>
<!-- start hero section -->
<div class="hero-image">

</div>
<!-- end hero section -->
<!-- start page content -->
<div class="container">
                <!-- start filter section -->
                <div class="row mb-1">
                <div class="col-md-12" style="">
                    <h4 class="filter-header">
                        By Category
                    </h4>
                    <ul class="filter-ul index-ul">
                        @foreach ($categories as $category)
                            <li class="index-li"><a class="text-center text-primary fs-6 fw-bold" href="{{ route('shop.index', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                    {{-- <h4 class="filter-header">
                        By Tag
                    </h4>
                    <ul class="filter-ul">
                        @foreach ($tags as $tag)
                            <li><a class="text-center {{ $tag->name == $tagName ? 'active-cat' : '' }}" href="{{ route('shop.index', ['tag' => $tag->slug]) }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul> --}}
                </div>
            </div>
    <h2 class="fs-2 fw-bold text-center text-dark">Featured Products</h2>
    <!-- start products row -->
    <div class="row">
        @foreach ($products as $product)
            <!-- start single product -->
            <div class="col-md-6 col-sm-12 col-lg-4 product">
                <a href="{{ route('shop.show', $product->slug) }}" class="custom-card">
                    <div class="card view overlay zoom">
                        <img src="{{ productImage($product->image) }}" class="card-img-top img-fluid" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}<span class="float-right">$ {{ format($product->price) }}</span></h5>
                            {{-- <div class="product-actions" style="display: flex; align-items: center; justify-content: center">
                                <a class="cart" href="#" style="margin-right: 1em"><i style="color:blue; font-size: 1.3em" class="fas fa-cart-plus"></i></a>
                                <a class="like" href="#" style="margin-right: 1em"><i style="color:blue; font-size: 1.3em" class="fa fa-thumbs-up"></i></a>
                                <a class="heart" href="#"><i style="color:blue; font-size: 1.3em" class="fa fa-heart-o"></i></a>
                            </div> --}}
                        </div>
                    </div>
                </a>
            </div>
            <!-- end single product -->
        @endforeach
    </div>
    <!-- end products row -->
    <div class="show-more">
        <a href="{{ route('shop.index') }}">
            <button class="btn custom-border-n">Show more</button>
        </a>
    </div>
    <hr>
    <!-- start products row -->
    <div class="row">
        @foreach ($hotProducts as $product)
            <!-- start single product -->
            <div class="col-md-6 col-sm-12 col-lg-4 product">
                <a href="{{ route('shop.show', $product->slug) }}" class="custom-card">
                    <div class="card view overlay zoom">
                        <img src="{{ productImage($product->image) }}" class="card-img-top img-fluid" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}<span class="float-right">$ {{ format($product->price) }}</span></h5>
                            {{-- <div class="product-actions" style="display: flex; align-items: center; justify-content: center">
                                <a class="cart" href="#" style="margin-right: 1em"><i style="color:blue; font-size: 1.3em" class="fas fa-cart-plus"></i></a>
                                <a class="like" href="#" style="margin-right: 1em"><i style="color:blue; font-size: 1.3em" class="fa fa-thumbs-up"></i></a>
                                <a class="heart" href="#"><i style="color:blue; font-size: 1.3em" class="fa fa-heart-o"></i></a>
                            </div> --}}
                        </div>
                    </div>
                </a>
            </div>
            <!-- end single product -->
        @endforeach
    </div>
    <!-- end products row -->
</div>
<!-- end page content -->


</x-base-layout>
