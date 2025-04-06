<a href="{{ $product->url  }}">
    <div class="hidi-product-item">
        <div class="hidi-product-item-img">
            <img  data-src="{{ asset(store_image_link($product->media_id)) }}" src="{{ asset(store_image_link($product->media_id)) }}" alt="{{ !empty($product->media->alt) ?$product->media->alt: $product->title }}">


        </div>

        <div class="hidi-product-item-content">
            <p>{{ $product->title }}</p>

            <div class="hidi-product-item-content-price">
                @if($product->offerpercent >0)
                    <span class="offer-adad">
                                                    {{ $product->offerpercent }}
                                                </span>
                @endif
                 {!! $product->product_price() !!}                                  </div>
        </div>
    </div>
</a>
