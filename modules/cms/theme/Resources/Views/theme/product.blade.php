@extends(config("theme.theme_mainContent_path"))

@section("title")
    @if(isset($product->post_meta_array["meta_title"]) && !is_null($product->post_meta_array["meta_title"])){{ $product->post_meta_array["meta_title"] }}@else{{ $product->title }}@endif
@endsection

@section("meta")
    <meta name="description" content="@if(isset($product->post_meta_array["meta_description"])&& !is_null($product->post_meta_array["meta_description"])){{ $product->post_meta_array["meta_description"] }}@else{{ strip_tags($product->post_excerpt) }}@endif">
    <meta name="robots" content="@if(isset($product->post_meta_array["meta_follow"])&& !is_null($product->post_meta_array["meta_follow"])){{ $product->post_meta_array["meta_follow"] }}@endif, @if(isset($product->post_meta_array["meta_index"]) && !is_null($product->post_meta_array["meta_index"])){{ $product->post_meta_array["meta_index"] }}@endif">
    <link rel="canonical" href="{{ $product->url }}/">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:type" content="product">
    <meta property="og:title" content="@if(isset($product->post_meta_array["meta_title"]) && !is_null($product->post_meta_array["meta_title"])){{ $product->post_meta_array["meta_title"] }}@else{{ $product->title }}@endif">
    <meta property="og:description" content="@if(isset($product->post_meta_array["meta_description"]) && !is_null($product->post_meta_array["meta_description"])){{ $product->post_meta_array["meta_description"] }}@else{{ strip_tags($product->post_excerpt) }}@endif">
    <meta property="og:url" content="{{ $product->url }}">
    <meta property="og:site_name" content="{{ get_site_title() }}">
    <meta property="og:updated_time" content="{{ $product->updated_at }}">
    <meta property="og:image" content="{{asset(store_image_link($product->media_id)) }}">
    <meta property="og:image:secure_url" content="{{asset(store_image_link($product->media_id)) }}">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="400">
    <meta property="og:image:alt" content="{{ $product->title }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@if(isset($product->post_meta_array["meta_title"]) && !is_null($product->post_meta_array["meta_title"])){{ $product->post_meta_array["meta_title"] }}@else{{ $product->title }}@endif">
    <meta name="twitter:description" content="@if(isset($product->post_meta_array["meta_description"]) && !is_null($product->post_meta_array["meta_description"])){{ $product->post_meta_array["meta_description"] }}@else{{ strip_tags($product->post_excerpt) }}@endif">
    <meta name="twitter:image" content="{{asset(store_image_link($product->media_id)) }}">


@endsection
@section("schema")
        <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $product->title }}",
  "image": "{{asset(store_image_link($product->media_id)) }}",
  "description": "@if(isset($product->post_meta_array["meta_description"]) && !is_null($product->post_meta_array["meta_description"])){{ $product->post_meta_array["meta_description"] }}@else{{ strip_tags($product->post_excerpt) }}@endif",
  "sku": "{{ $product->id }}",
  "mpn": "{{ $product->id }}",
  "brand": {
"@type": "Brand",
"name": "hidi"
},
  @if($product->offerpercent >0)
                "offers": {
           "@type": "Offer",
           "url": "{{ $product->url }}/",
       "priceCurrency": "IRR",
       "price": "{{$product->offer_price}}",
       "priceValidUntil": "2026-01-01",
       "availability": "https://schema.org/OnlineOnly",
       "itemCondition": "https://schema.org/NewCondition"
     },
@endif

            "aggregateRating": {
              "@type": "AggregateRating",
              "ratingValue": "5",
              "bestRating": "5",
              "worstRating": "5",
              "ratingCount": "{{  rand(100,1000) }}"
            }
          }
</script>

        <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "store",
    "item": "https://hidi.com/shop"
  },
  @if(isset($product->category[0]))
                {
                  "@type": "ListItem",
                  "position": 2,
                  "name": "{{ $product->category[0]->name }}",
    "item": "{{ $product->category[0]->url }}"
  },
  @endif
            {
              "@type": "ListItem",
              "position": @if(isset($product->category[0])) 3 @else 2 @endif,
    "name": "{{ $product->title }}",
     "item": "{{ $product->url }}"
  }
         ]
       }
</script>
@endsection


@section("content")
    <div class="container">
        <div class="bread-crumb-box">
            <div class="bread-crumb-box-item">
                <a href="/">خانه</a>
            </div>
            <div class="bread-crumb-box-item">
                <a href="{{ route("page.index","shop") }}">محصولات</a>
            </div>
            @if(isset($product->category[0]))
                @if($product->category[0]->parent !=0)
                    <div class="bread-crumb-box-item">
                        <a href="{{ $product->category[0]->parent2->url }}">{{ $product->category[0]->parent2->name }}</a>
                    </div>
                @endif
                <div class="bread-crumb-box-item">
                    <a href="{{ $product->category[0]->url }}">{{ $product->category[0]->name }}</a>
                </div>
            @endif
            <div class="bread-crumb-box-item current">
                <a >{{ $product->title }}</a>
            </div>
        </div>
        <div  class="product type-product  status-publish    has-post-thumbnail">
            <div class="single-product-box-top">
                <div class="row">
                    <div class="col-lg-4">

                        <div class="row">
                            <div class="col-12">
                                <div class="woocommerce-product-gallery__image single-product-main-image">
                                    <a href="#"   class="woocommerce-main-image image-link" data-mfp-src="{{ asset(store_image_link($product->media_id)) }}">
                                        <img alt="{{ !empty($product->media->alt) ?$product->media->alt: $product->title }}" data-src="{{ asset(store_image_link($product->media_id)) }}" class="attachment-shop_single" >
                                    </a>

                                    <div class="product-title-left">
                                        <div class="product-title-left-item">
                                        <span class="add-to-wishlist @if(!$is_wished) empty @endif">
                                            <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16 4.375C16 2.30393 14.2511 0.625 12.0938 0.625C10.4807 0.625 9.09607 1.56356 8.5 2.90285C7.90393 1.56356 6.51927 0.625 4.90625 0.625C2.74889 0.625 1 2.30393 1 4.375C1 10.3921 8.5 14.375 8.5 14.375C8.5 14.375 16 10.3921 16 4.375Z" stroke="#292929" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        </div>
                                        <div class="product-title-left-item">
                                        <span class="share_button" data-url="{{ $product->url }}">
                                            <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.51434 8.58925C4.19413 8.01409 3.58 7.625 2.875 7.625C1.83947 7.625 1 8.46447 1 9.5C1 10.5355 1.83947 11.375 2.875 11.375C3.58 11.375 4.19413 10.9859 4.51434 10.4107M4.51434 8.58925C4.66447 8.85891 4.75 9.16947 4.75 9.5C4.75 9.83053 4.66447 10.1411 4.51434 10.4107M4.51434 8.58925L12.4857 4.16075M4.51434 10.4107L12.4857 14.8393M12.4857 14.8393C12.3355 15.1089 12.25 15.4195 12.25 15.75C12.25 16.7855 13.0895 17.625 14.125 17.625C15.1605 17.625 16 16.7855 16 15.75C16 14.7145 15.1605 13.875 14.125 13.875C13.42 13.875 12.8059 14.2641 12.4857 14.8393ZM12.4857 4.16075C12.8059 4.73591 13.42 5.125 14.125 5.125C15.1605 5.125 16 4.28553 16 3.25C16 2.21447 15.1605 1.375 14.125 1.375C13.0895 1.375 12.25 2.21447 12.25 3.25C12.25 3.58053 12.3355 3.89109 12.4857 4.16075Z" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12">
                                @if(!empty($gallery))
                                    <div class="thumbnails">
                                        <ul class="thumbnail-nav slick-initialized slick-slider">


                                            <div class="slick-list draggable">
                                                <div class="slick-track" >
                                                    @foreach($gallery as $gallery_item)
                                                        @if($loop->index <=2)
                                                            <li class="slick-slide slick-current slick-active" style="width: 92px;">

                                                                <a href="{{ asset(store_image_link($gallery_item)) }}" class="image-link" data-mfp-src="{{ asset(store_image_link($gallery_item)) }}">
                                                                    <img data-src="{{ asset(store_image_link($gallery_item)) }}" alt="">
                                                                </a>
                                                            </li>
                                                        @elseif($loop->index ==3)
                                                            <li class="slick-slide slick-current slick-active show-more" style="width: 92px;">
                                                                <svg style="width: 24px; height: 24px; fill: #000;">
                                                                    <path fill-rule="evenodd" d="M16 12c0 1.1.9 2 2 2s2-.9 2-2-.9-2-2-2-2 .9-2 2zm-4-2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-8 2c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2z" clip-rule="evenodd"></path>
                                                                </svg>
                                                                <a href="{{ asset(store_image_link($gallery_item)) }}" class="image-link" data-mfp-src="{{ asset(store_image_link($gallery_item)) }}">
                                                                    <img data-src="{{ asset(store_image_link($gallery_item)) }}" alt="">
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li class="slick-slide slick-current slick-active d-none" style="width: 92px;">

                                                                <a href="{{ asset(store_image_link($gallery_item)) }}" class="image-link" data-mfp-src="{{ asset(store_image_link($gallery_item)) }}">
                                                                    <img data-src="{{ asset(store_image_link($gallery_item)) }}" alt="">
                                                                </a>
                                                            </li>
                                                        @endif

                                                    @endforeach

                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>



                    </div>
                    <div class="col-lg-5">

                        <div class="summary entry-summary">
                            @if($product->offerpercent >0)
                                <span class="product-item-content-price-percent">{{ $product->offerpercent }}</span>
                            @endif
                            <div class="product-title">
                                <h1 class="product_title entry-title">{{ $product->title }}</h1>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    @if(isset($product->category[0]) && is_object($product->category[0]))
                                        <div class="product_meta">
                                            <span class="posted_in">دسته بندی محصول:
                                                <a href="{{ $product->category[0]->url }}" rel="tag">{{ $product->category[0]->name }}</a>
                                            </span>
                                        </div>
                                    @endif

                                    @if(isset($product->brand[0]) && is_object($product->brand[0]))
                                        <div class="product_meta">
                                            <span class="posted_in">برند
                                                <a href="{{ $product->brand[0]->url }}" rel="tag">{{ $product->brand[0]->name }}</a>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($product->type == $product->type_variable)
                                <div class="variable-box-items">
                                    @foreach($table_variations as $table_variation_id=>$table_variation)
                                        @if($table_variation["item"])
                                            <div class="variable-box-item" data-variation-id="{{ $table_variation_id }}">
                                                <div class="variable-box-item-name">
                                                    <strong>
                                                        انتخاب
                                                        {{ $table_variation["parentName"] }}
                                                        :
                                                    </strong>
                                                    <span></span>
                                                </div>
                                                <div class="variable-box-item-items">
                                                    @foreach($table_variation["item"] as $item)

                                                        @if(isset($item["id"]))
                                                            @if(isset($item["color"]) && !empty($item["color"]))
                                                                <div class="variable-box-item-item variable-box-item-item-circle">
                                                                    <span data-id="{{ $item["id"] }}" data-name="{{ $item["name"] }}" style="background: {{$item["color"]}}"></span>
                                                                </div>
                                                            @else
                                                                <div class="variable-box-item-item variable-box-item-item-square">
                                                                    <span data-id="{{ $item["id"] }}" data-name="{{ $item["name"] }}">{{ $item["name"] }}</span>
                                                                </div>
                                                            @endif

                                                        @endif
                                                    @endforeach

                                               </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                                <table class="variations d-none" cellspacing="0">
                                    <tbody>
                                    @foreach($table_variations as $table_variation_id=>$table_variation)
                                        @if($table_variation["item"])
                                            <tr>
                                                <td class="label"><label for="pa_weight">{{ $table_variation["parentName"] }}</label></td>
                                                <td class="value">
                                                    <select  class="variation_select_box" id="variation_{{$table_variation_id}}" name="{{ $table_variation_id }}">
                                                        <option value="">یک گزینه را انتخاب کنید</option>
                                                        @foreach($table_variation["item"] as $item)
                                                            @if(isset($item["id"]))
                                                                <option value="{{ $item["id"] }}">{{ $item["name"] }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

                            @endif
                            @if(!empty($attributes))
                               <div class="product-attributes">
                                   <strong>ویژگی های محصول</strong>
                                   <ul class="product-attr-box">
                                       @foreach($attributes as $attribute)
                                           <li class="product-attr-box-item">
                                               <span class="product-attributes-item__label">{{ $attribute["parent"]["name"] }}</span>
                                               :
                                               <span class="product-attributes-item__value">
                                                   @foreach($attribute["values"] as $value)


                                                                        {{ $value["name"] }}



                                                   @endforeach
                                               </span>
                                           </li>
                                       @endforeach
                                   </ul>
                               </div>
                            @endif
                        </div>

                    </div>
                    <div class="col-lg-3 p-md-0">
                        <div class="selled-number" style="margin-bottom: 11px;">
                            <p style=""><i style="color: rgb(54 100 255); font-size: 18px;margin-left:2px" class="far fa-user-check"></i>
                                <span style="display: inline-block;margin:0 1px">{{ $product->buyer_count }}</span>
                                نفر این محصول را خریداری کرده اند.
                            </p>
                        </div>
                        <div class="product-description-boxes">
                            <div class="product-description-boxes-top">
                                <div class="product-description-boxes-top-item">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1071_452)">
                                            <path d="M9 21V17C9 16.4696 9.21071 15.9609 9.58579 15.5858C9.96086 15.2107 10.4696 15 11 15H13C13.5304 15 14.0391 15.2107 14.4142 15.5858C14.7893 15.9609 15 16.4696 15 17V21" stroke="rgb(54 100 255)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M3 21H21" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 21V10.85" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M19 21V10.85" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M3 7V8C3 8.79565 3.31607 9.55871 3.87868 10.1213C4.44129 10.6839 5.20435 11 6 11C6.79565 11 7.55871 10.6839 8.12132 10.1213C8.68393 9.55871 9 8.79565 9 8V7M9 8C9 8.79565 9.31607 9.55871 9.87868 10.1213C10.4413 10.6839 11.2044 11 12 11C12.7956 11 13.5587 10.6839 14.1213 10.1213C14.6839 9.55871 15 8.79565 15 8V7M15 8C15 8.79565 15.3161 9.55871 15.8787 10.1213C16.4413 10.6839 17.2044 11 18 11C18.7956 11 19.5587 10.6839 20.1213 10.1213C20.6839 9.55871 21 8.79565 21 8V7H3L5 3H19L21 7" stroke="rgb(54 100 255)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1071_452">
                                                <rect width="24" height="24" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>


                                    <span>
                            فروشنده: فروشگاه اول کارت
                        </span>
                                </div>
                                <div class="product-description-boxes-top-item">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1071_459)">
                                            <path d="M5.00046 7.19997C5.00046 6.6165 5.23225 6.05692 5.64483 5.64434C6.05741 5.23176 6.61698 4.99997 7.20046 4.99997H8.20046C8.78136 4.99964 9.33855 4.76957 9.75046 4.35997L10.4505 3.65997C10.6549 3.45437 10.898 3.29121 11.1657 3.17988C11.4334 3.06855 11.7205 3.01123 12.0105 3.01123C12.3004 3.01123 12.5875 3.06855 12.8552 3.17988C13.1229 3.29121 13.366 3.45437 13.5705 3.65997L14.2705 4.35997C14.6824 4.76957 15.2396 4.99964 15.8205 4.99997H16.8205C17.4039 4.99997 17.9635 5.23176 18.3761 5.64434C18.7887 6.05692 19.0205 6.6165 19.0205 7.19997V8.19997C19.0208 8.78087 19.2509 9.33806 19.6605 9.74997L20.3605 10.45C20.5661 10.6544 20.7292 10.8975 20.8406 11.1652C20.9519 11.4329 21.0092 11.72 21.0092 12.01C21.0092 12.2999 20.9519 12.587 20.8406 12.8547C20.7292 13.1225 20.5661 13.3655 20.3605 13.57L19.6605 14.27C19.2509 14.6819 19.0208 15.2391 19.0205 15.82V16.82C19.0205 17.4034 18.7887 17.963 18.3761 18.3756C17.9635 18.7882 17.4039 19.02 16.8205 19.02H15.8205C15.2396 19.0203 14.6824 19.2504 14.2705 19.66L13.5705 20.36C13.366 20.5656 13.1229 20.7287 12.8552 20.8401C12.5875 20.9514 12.3004 21.0087 12.0105 21.0087C11.7205 21.0087 11.4334 20.9514 11.1657 20.8401C10.898 20.7287 10.6549 20.5656 10.4505 20.36L9.75046 19.66C9.33855 19.2504 8.78136 19.0203 8.20046 19.02H7.20046C6.61698 19.02 6.05741 18.7882 5.64483 18.3756C5.23225 17.963 5.00046 17.4034 5.00046 16.82V15.82C5.00013 15.2391 4.77006 14.6819 4.36046 14.27L3.66046 13.57C3.45486 13.3655 3.2917 13.1225 3.18037 12.8547C3.06903 12.587 3.01172 12.2999 3.01172 12.01C3.01172 11.72 3.06903 11.4329 3.18037 11.1652C3.2917 10.8975 3.45486 10.6544 3.66046 10.45L4.36046 9.74997C4.77006 9.33806 5.00013 8.78087 5.00046 8.19997V7.19997" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M9.08301 12L11.1663 14.0834L15.333 9.91669" stroke="rgb(54 100 255)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1071_459">
                                                <rect width="24" height="24" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>



                                    <span>
                           ضمانت اصل بودن کالا
                        </span>
                                </div>
                                <div class="product-description-boxes-top-item">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_1071_447)">
                                            <path d="M3 21V8L12 4L21 8V21" stroke="#292929" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M13 13H17V21H7V15H13" stroke="rgb(54 100 255)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M13 21V12C13 11.7348 12.8946 11.4804 12.7071 11.2929C12.5196 11.1054 12.2652 11 12 11H10C9.73478 11 9.48043 11.1054 9.29289 11.2929C9.10536 11.4804 9 11.7348 9 12V15" stroke="rgb(54 100 255)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1071_447">
                                                <rect width="24" height="24" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>


                                @if($in_stock)

                                        <span>
                                            موجود در انبار اول کارت
                                        </span>
                                    @else
                                        <span>
                                        در انبار موجود نیست
                                         </span>
                                    @endif
                                </div>

                            </div>

                            <div class="product-description-boxes-bottom">
                                @if($in_stock)
                                    <div class="row">
                                    <div class="col-12">
                                        <div class="product-item-content-price">
                                            @if($product->offerpercent >0)
                                                <div class="product-item-content-price-offer">
                                                    تخفیف شما:
                                                    {{ format_price_with_currencySymbol($product->offered_price) }}
                                                </div>
                                            @endif

                                            {!! $product->product_price() !!}
                                        </div>
                                    </div>
                                </div>
                                @endif


                                <div class="add-tocart-page">


                                    @if($in_stock)
                                        <div class="add-tocart-page-product">
                                            <a class="add-to-cart-btn" href="{{ route("add_to_cart",["product"=>$product->id]) }}">
                                                <svg class="ml-2" width="20" height="23" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17.6055 8.00723L18.6 7.90254V7.90254L17.6055 8.00723ZM18.8687 20.0072L17.8742 20.1119L18.8687 20.0072ZM1.13033 20.0072L2.12483 20.1119L1.13033 20.0072ZM2.39348 8.00723L1.39898 7.90254V7.90254L2.39348 8.00723ZM12.7495 10C12.7495 10.5523 13.1972 11 13.7495 11C14.3018 11 14.7495 10.5523 14.7495 10H12.7495ZM5.24951 10C5.24951 10.5523 5.69722 11 6.24951 11C6.80179 11 7.24951 10.5523 7.24951 10H5.24951ZM16.611 8.11191L17.8742 20.1119L19.8632 19.9025L18.6 7.90254L16.611 8.11191ZM17.7499 20.25H2.24914V22.25H17.7499V20.25ZM2.12483 20.1119L3.38799 8.11191L1.39898 7.90254L0.13582 19.9025L2.12483 20.1119ZM3.5123 8H16.4867V6H3.5123V8ZM2.24914 20.25C2.17493 20.25 2.11706 20.1857 2.12483 20.1119L0.13582 19.9025C0.00374806 21.1572 0.987529 22.25 2.24914 22.25V20.25ZM17.8742 20.1119C17.882 20.1857 17.8241 20.25 17.7499 20.25V22.25C19.0115 22.25 19.9953 21.1572 19.8632 19.9025L17.8742 20.1119ZM18.6 7.90254C18.4862 6.82103 17.5742 6 16.4867 6V8C16.5507 8 16.6043 8.0483 16.611 8.11192L18.6 7.90254ZM3.38799 8.11191C3.39469 8.0483 3.44833 8 3.5123 8V6C2.42481 6 1.51282 6.82103 1.39898 7.90254L3.38799 8.11191ZM5.62451 10C5.62451 9.65482 5.90433 9.375 6.24951 9.375V11.375C7.0089 11.375 7.62451 10.7594 7.62451 10H5.62451ZM6.24951 9.375C6.59469 9.375 6.87451 9.65482 6.87451 10H4.87451C4.87451 10.7594 5.49012 11.375 6.24951 11.375V9.375ZM6.87451 10C6.87451 10.3452 6.59469 10.625 6.24951 10.625V8.625C5.49012 8.625 4.87451 9.24061 4.87451 10H6.87451ZM6.24951 10.625C5.90433 10.625 5.62451 10.3452 5.62451 10H7.62451C7.62451 9.24061 7.0089 8.625 6.24951 8.625V10.625ZM13.1245 10C13.1245 9.65482 13.4043 9.375 13.7495 9.375V11.375C14.5089 11.375 15.1245 10.7594 15.1245 10H13.1245ZM13.7495 9.375C14.0947 9.375 14.3745 9.65482 14.3745 10H12.3745C12.3745 10.7594 12.9901 11.375 13.7495 11.375V9.375ZM14.3745 10C14.3745 10.3452 14.0947 10.625 13.7495 10.625V8.625C12.9901 8.625 12.3745 9.24061 12.3745 10H14.3745ZM13.7495 10.625C13.4043 10.625 13.1245 10.3452 13.1245 10H15.1245C15.1245 9.24061 14.5089 8.625 13.7495 8.625V10.625ZM7.24951 5.5C7.24951 3.98122 8.48072 2.75 9.99951 2.75V0.75C7.37616 0.75 5.24951 2.87665 5.24951 5.5H7.24951ZM9.99951 2.75C11.5183 2.75 12.7495 3.98122 12.7495 5.5H14.7495C14.7495 2.87665 12.6229 0.75 9.99951 0.75V2.75ZM12.7495 5.5V10H14.7495V5.5H12.7495ZM5.24951 5.5V10H7.24951V5.5H5.24951Z" fill="white"/>
                                                </svg>


                                                افزودن به سبد خرید</a>
                                        </div>
                                    @else
                                        <div class="add-tocart-page-product">
                                            <a>در انبار موجود نیست</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="hidi-section related-product w-100">
                <div class="hidi-title">
                    <div class="row">
                        <div class="col-md-4">
                            <h2>
                                <svg class="ml-2" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.5 0L13.3214 7.67864L21 12.5L13.3214 13.3214L8.5 21L7.67864 13.3214L0 8.5L7.67864 7.67864L12.5 0Z" fill="rgb(54 100 255)"/>
                                </svg>

                                پیشنهادهای مشابه
                            </h2>
                        </div>
                        <div class="col-md-8">
                            <svg class="w-100" width="941" height="2" viewBox="0 0 941 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="0.75" y1="1.25" x2="940.25" y2="1.25008" stroke="#EAEAEA" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="5 5"/>
                            </svg>

                        </div>

                    </div>
                </div>
                <div class="row">

                    <div id="owl-1" class="owl-carousel owl-rtl owl-product2 owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" >
                                @foreach($related_products as $related_product)
                                    <div class="owl-item" >

                                        @includeIf(config("theme.theme_product_item_path"),["product"=>$related_product])

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="woocommerce-tabs mt-5 wc-tabs-wrapper page-content">
                    <ul class="tabs wc-tabs nav nav-tabs">
                        <li class="description_tab " id="tab-title-description" role="tab" aria-controls="tab-description">
                            <a class="active not-trilling-slash" data-toggle="tab" href="#tab-description">
                                معرفی محصول
                            </a>
                        </li>
                        @if(!empty($attributes))
                            <li class="attribute" id="attribute" role="tab" aria-controls="tab-reviews">
                                <a class="not-trilling-slash" data-toggle="tab" href="#tab-attribute">
                                    مشخصات محصول
                                </a>
                            </li>
                        @endif
                        <li class="reviews_tab" id="tab-title-reviews" role="tab" aria-controls="tab-reviews">
                            <a class="not-trilling-slash" data-toggle="tab" href="#tab-reviews">
                                نظرات کاربران
                            </a>
                        </li>
                        <li class="questions_tab " id="tab-title-questions" role="tab" aria-controls="tab-questions">
                            <a data-toggle="tab" href="#tab-questions" class="not-trilling-slash">
                                پرسش و پاسخ
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description tab-pane fade in active show" id="tab-description"  >

                            <div class="descriptio-product-tab">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="page-post-content">
                                            {!! $product->content !!}
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>
                        @if(!empty($attributes))
                            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--attribute tab-pane fade" id="tab-attribute">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="additionalproarea">
                                            <table class="woocommerce-product-attributes shop_attributes">
                                                <tbody>
                                                @foreach($attributes as $attribute)
                                                    <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_%d9%85%d9%88%d8%a7%d8%b1%d8%af-%d9%85%d8%b5%d8%b1%d9%81">
                                                        <th class="woocommerce-product-attributes-item__label">{{ $attribute["parent"]["name"] }}</th>
                                                        <td class="woocommerce-product-attributes-item__value">
                                                            @foreach($attribute["values"] as $value)
                                                                <span>

                                                                        {{ $value["name"] }}


                                                                </span>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        @endif
                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--reviews tab-pane fade in " id="tab-reviews" >
                            <div class="row">

                                <div class="col-12">
                                    <div id="reviews" class="woocommerce-Reviews">
                                        <div class="post-item-review">
                                            <h3 id="reply-title" class="comment-reply-title">دیدگاهتان را بنویسید </h3>
                                            @includeIf(config("theme.theme_comment_path"),["comments"=>$comments])
                                            @includeIf(config("theme.theme_comment_form_path"),["post_id"=>$product->id,"post_type"=>"product"])
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--reviews tab-pane fade in " id="tab-questions" >
                            <div id="reviews" class="woocommerce-Reviews">
                                <div class="post-item-review">
                                    <h3 id="reply-title" class="comment-reply-title">پرسش خود را بنویسید </h3>

                                    @includeIf(config("theme.theme_comment_path"),["comments"=>$questions])
                                    @includeIf(config("theme.theme_comment_form_path"),["post_id"=>$product->id,"post_type"=>"product","type"=>"product_questions"])
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>



        </div>



    </div>
    @push("css")
        <link rel="stylesheet" href="{{ theme_asset("css/lightbox.css") }}">
        <style>
            .mfp-wrap.mfp-gallery.mfp-close-btn-in.mfp-auto-cursor.mfp-ready {
                z-index: 9999999999999999999999;
            }.mfp-bg.mfp-ready {
                 z-index: 999999999999999999999;
             }img.mfp-img {
                  width: 500px;
              }.mfp-counter {
                   display: none;
               }
        </style>
    @endpush
    @push("js")
        @if($product->type == $product->type_variable)
            <script>
                jQuery(document).ready(function (){
                    jQuery("select.variation_select_box").val(jQuery("select.variation_select_box option:first-child").val())
                })
                jQuery(".variation_select_box").val(jQuery(".variation_select_box option:nth-child(2)").val() )

                function formatMoney(number, decPlaces, decSep, thouSep) {
                    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
                        decSep = typeof decSep === "undefined" ? "." : decSep;
                    thouSep = typeof thouSep === "undefined" ? "," : thouSep;
                    var sign = number < 0 ? "-" : "";
                    var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
                    var j = (j = i.length) > 3 ? j % 3 : 0;

                    return sign +
                        (j ? i.substr(0, j) + thouSep : "") +
                        i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
                        (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
                }
                jQuery("select.variation_select_box").change(function (){
                    var variations=JSON.parse('{!! json_encode($in_stock_variations)  !!}');
                    var selected_variations={};
                    jQuery("select.variation_select_box").each(function (item){
                        if(!jQuery(this).val()){
                            empty = true;
                            alert("لطفا همه مشخصات محصول را انتخاب کنید");
                            return false;
                        }
                        empty = false;
                        var parent_id=jQuery(this).attr("name")
                        var parentvalue_id=jQuery(this).val()
                        Object.assign(selected_variations,{
                            [parent_id]: parentvalue_id
                        })
                    })
                    var variation_by_parent_id=[];

                    jQuery(variations).each(function (){
                        var item_variations_object={};
                        var item_variations=this.variations;
                        var item_variation_id=this.id;
                        var that=this;
                        for (const [index, value] of Object.entries(item_variations)) {
                            if(item_variations_object[item_variation_id]){
                                item_variations_object[item_variation_id][index]=value[0].id;
                            } else{
                                Object.assign(item_variations_object,{[item_variation_id]:{[index]:value[0].id}})

                            }

                        }
                        variation_by_parent_id.push(item_variations_object)
                    })



                    var exist_variation=false;
                    var active_variation_id=false;
                    for (const [aa, value] of Object.entries(variation_by_parent_id)) {

                        for (const [id, child_value] of Object.entries(value)) {
                            active_variation_id=id;
                            for (const [index, child_child_value] of Object.entries(child_value)) {

                                if(selected_variations[index] == child_child_value){
                                    exist_variation=true;
                                } else{
                                    exist_variation=false;
                                    active_variation_id=false;
                                    break;
                                }
                            }
                            if(exist_variation) {
                                break;
                            }
                        }
                        if(exist_variation) {
                            break;
                        }
                    }

                    if(active_variation_id && exist_variation ){

                        for (const [id,item] of Object.entries(variations)) {
                            if(item.id == active_variation_id){
                                console.log(item)
                                if(item.offer_price){
                                    var price = `
<p class="price"><del>
${new Intl.NumberFormat().format((item.price))} تومان
</del>
<ins class="d-block " style="text-decoration: none">
${new Intl.NumberFormat().format((item.offer_price)) } تومان
</ins>
</p>
                        `;
                                } else{
                                    var price = `
<p class="price">
${new Intl.NumberFormat().format((item.price))} تومان


</p>
                        `;
                                }
                                console.log(price)
                                jQuery(".product-item-content-price").html(price)
                            }

                        }
                    }
                })

                var empty = false;
                    var variations=JSON.parse('{!! json_encode($in_stock_variations)  !!}');
                    jQuery(".add-to-cart-btn").click(function (e){

                        var selected_variations={};
                        jQuery("select.variation_select_box").each(function (item){
                            if(!jQuery(this).val()){
                                empty = true;
                                alert("لطفا همه مشخصات محصول را انتخاب کنید");
                                return false;
                            }
                            empty = false;
                            var parent_id=jQuery(this).attr("name")
                            var parentvalue_id=jQuery(this).val()
                            Object.assign(selected_variations,{
                                [parent_id]: parentvalue_id
                            })
                        })
                        if (empty) {
                            return false;
                        }

                        var variation_by_parent_id=[];

                        jQuery(variations).each(function (){
                            var item_variations_object={};
                            var item_variations=this.variations;
                            var item_variation_id=this.id;
                            var that=this;
                            for (const [index, value] of Object.entries(item_variations)) {
                                if(item_variations_object[item_variation_id]){
                                    item_variations_object[item_variation_id][index]=value[0].id;
                                } else{
                                    Object.assign(item_variations_object,{[item_variation_id]:{[index]:value[0].id}})

                                }

                            }
                            variation_by_parent_id.push(item_variations_object)
                        })



                        var exist_variation=false;
                        var active_variation_id=false;
                        for (const [aa, value] of Object.entries(variation_by_parent_id)) {

                            for (const [id, child_value] of Object.entries(value)) {
                                active_variation_id=id;
                                for (const [index, child_child_value] of Object.entries(child_value)) {

                                    if(selected_variations[index] == child_child_value){
                                        exist_variation=true;
                                    } else{
                                        exist_variation=false;
                                        active_variation_id=false;
                                        break;
                                    }
                                }
                                if(exist_variation) {
                                    break;
                                }
                            }
                            if(exist_variation) {
                                break;
                            }
                        }

                        if(active_variation_id && exist_variation ){
                            console.log(active_variation_id)
                                var href=jQuery(this).attr("href")
                                href=href+`?variation=${active_variation_id}`
                                jQuery(this).attr("href",href)
                        } else{
                            e.preventDefault();
                            alert("محصولی با ویژگی های مورد نظر شما موجود نیست لطفا مشخصات دیگری را انتخاب کنید")
                        }
                    })


                jQuery("[data-variation-id=1]").click(function (){
                    jQuery(".variable-box-item-item").removeClass("d-none")
                    var size_id=jQuery("select#variation_1").val();
                    var variations=JSON.parse('{!! json_encode($in_stock_variations)  !!}');
                    var available_variation= {}
                    jQuery(variations).each(function (){

                        if(this.variations[1]){
                            if(this.variations[1][0].id==size_id){
                                for (const [index, value] of Object.entries(this.variations)) {

                                    if (index != 1){
                                        if(available_variation[index]){
                                            available_variation[index].push(value[0].id)
                                        } else{
                                            Object.assign(available_variation,{[index]:[value[0].id]})

                                        }
                                    }
                                }
                            }
                        }
                    })


                    for (const [index, value] of Object.entries(available_variation)) {

                        var parent_html=jQuery(`[data-variation-id='${index}']`)
                        jQuery(`select#variation_${index}`).val(null)
                        jQuery(parent_html).find(".variable-box-item-item").addClass("d-none")
                        jQuery(parent_html).find(".variable-box-item-item").removeClass("active")
                        jQuery(parent_html).find(".variable-box-item-name span").html(null)

                        for (const [index2, value2] of Object.entries(value)) {
                            console.log(value2)
                            jQuery(parent_html).find(`[data-id="${value2}"]`).parent(".variable-box-item-item").removeClass("d-none")

                        }

                    }


                })
            </script>
            <script>

                jQuery(document).ready(function (){
                    jQuery(".variable-box-item-item").click(function (){
                        var name=jQuery(this).children("span").data("name")
                        var id=jQuery(this).children("span").data("id")
                        var variation_id=jQuery(this).parents(".variable-box-item").data("variation-id")
                        jQuery(this).parents(".variable-box-item").children(".variable-box-item-name").children("span").html(name)
                        jQuery(this).parents(".variable-box-item-items").children(".variable-box-item-item").removeClass("active")
                        jQuery(this).addClass("active")

                        jQuery(`#variation_${variation_id}`).val(id)
                    })
                })
            </script>
        @endif

        <script>
            jQuery(document).ready(function (){
                if(jQuery(".descriptio-product-tab >div:not(.grwwgw)").height()<340){
                    document.querySelector(".open-product-desc").style.cssText="display:none";
                    jQuery(".descriptio-product-tab").addClass("open");
                }
            })
            jQuery(".add-to-wishlist").click(function (){
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery("meta[name='csrf-token']").attr("content")
                    }
                });
                jQuery.ajax({
                    type:"POST",
                    url:"{{route("product.add_wishlist")}}",
                    data:{
                        "id":"{{ $product->id }}"
                    },
                    success:function (data) {
                        if(data.url){
                            window.location=data.url+"?return_to={{ url()->current() }}"
                        }
                        else{
                            jQuery(".add-to-wishlist").toggleClass("empty")
                        }
                    },
                    error:function (){
                        toastMessage("مشکلی رخ داده است لطفا دوباره امتحان کنید","ارور","error","red")
                    }
            })
            })

           jQuery(".share_button").click(function (){
                copyTextToClipboard(jQuery(this).data("url"))
                alert("لینک کپی شد.")
            })

            function fallbackCopyTextToClipboard(text) {
                var textArea = document.createElement("textarea");
                textArea.value = text;

                // Avoid scrolling to bottom
                textArea.style.top = "0";
                textArea.style.left = "0";
                textArea.style.position = "fixed";

                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                    console.log('Fallback: Copying text command was ' + msg);
                } catch (err) {
                    console.error('Fallback: Oops, unable to copy', err);
                }

                document.body.removeChild(textArea);
            }
            function copyTextToClipboard(text) {
                if (!navigator.clipboard) {
                    fallbackCopyTextToClipboard(text);
                    return;
                }
                navigator.clipboard.writeText(text).then(function() {
                    console.log('Async: Copying to clipboard was successful!');
                }, function(err) {
                    console.error('Async: Could not copy text: ', err);
                });
            }



        </script>
        <script src="{{ theme_asset("js/lightbox.js") }}"></script>
        <script>
            jQuery(document).ready(function() {

                jQuery('.image-link').magnificPopup({

                    gallery: {
                        enabled: true,

                    },

                    type:'image'
                });

                jQuery('.image-link2').magnificPopup({

                    gallery: {
                        enabled: true,

                    },

                    type:'image'
                });

            });
        </script>
    @endpush


@endsection
