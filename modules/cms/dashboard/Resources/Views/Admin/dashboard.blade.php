<x-admin-panel-layout>
    <x-slot name="title">
        پیشخوان
    </x-slot>
    <x-slot name="main">
        <!-- Checked checkbox -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            پیشخوان

                        </h1>
                    </div>
                    <div class="col-sm-6 text-left">

                    </div>
                </div>
            </div>
        </div>
        <section class="mr-2 mt-2">
            <div class="row">
                <div class="col-md-8">
                    <div class="admin-box">
                        <div class="admin-box-title">
                            <strong>
                                آمار فروش
                            </strong>
                        </div>
                        <div class="admin-box-content">

                            @if(auth()->user()->hasPermissionTo(\CMS\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN) || auth()->user()->hasPermissionTo(\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_SHOP))
                                <figure class="highcharts-figure">
                                    <div id="container"></div>
                                </figure>
                                <script src="https://code.highcharts.com/highcharts.js"></script>
                                <script src="https://code.highcharts.com/modules/series-label.js"></script>
                                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                                <script src="https://code.highcharts.com/modules/export-data.js"></script>
                                <script src="https://code.highcharts.com/modules/accessibility.js"></script>

                                <script>
                                    Highcharts.chart('container', {
                                        title: {
                                            text: 'نمودار  ۳۰ روز گذشته'
                                        },
                                        tooltip: {
                                            useHTML: true,
                                            style: {
                                                dir: 'ltr',
                                                fontFamily: 'tahoma',
                                            },
                                            formatter: function () {
                                                return (this.x ? 'تاریخ ' + this.x + '<br>' : '') + 'تعداد ' + this.y
                                            }
                                        },
                                        xAxis: {
                                            type: 'datetime',
                                            categories: [@foreach($datesOrder as $date => $value) "{{toShamsi($date,'d M')}}", @endforeach],
                                            labels: {
                                                step:5
                                            }
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'عدد'
                                            },
                                            labels: {
                                                formatter: function () {
                                                    return  this.value;
                                                }
                                            }
                                        },
                                        labels: {
                                            items: [{
                                                html: ' ',
                                                style: {
                                                    left: '50px',
                                                    top: '18px',
                                                    color: ( // theme
                                                        Highcharts.defaultOptions.title.style &&
                                                        Highcharts.defaultOptions.title.style.color
                                                    ) || 'black'
                                                }
                                            }]
                                        },
                                        plotOptions: {
                                            area: {
                                                fillColor: {
                                                    linearGradient: {
                                                        x1: 0,
                                                        y1: 0,
                                                        x2: 0,
                                                        y2: 1
                                                    },
                                                    stops: [
                                                        [0, Highcharts.getOptions().colors[0]],
                                                        [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                                                    ]
                                                },
                                                marker: {
                                                    radius: 2
                                                },
                                                lineWidth: 3,
                                                states: {
                                                    hover: {
                                                        lineWidth: 3
                                                    }
                                                },
                                                threshold: null
                                            }
                                        },
                                        series: [
                                            {
                                                type: 'area',
                                                name: 'سفارشات محصولات',
                                                data: [@foreach($datesOrder as $date => $value) @if($summeryOrder->where('date',$date)->first()) {{$summeryOrder->where('date',$date)->first()->total}}, @else 0, @endif @endforeach],
                                                marker: {
                                                    lineWidth: 1,
                                                    lineColor: '#5dade2',
                                                    fillColor: 'white'
                                                }
                                            },
                                        ]
                                    })
                                    ;

                                </script>
                            @endif
                        </div>
                    </div>
                    <div class="admin-box">
                        <div class="admin-box-title">
                            <strong>
                                پر فروش ترین محصولات
                            </strong>
                        </div>
                        <div class="admin-box-content">

                            <table class="admin-table dashboard-table final-table">
                                <tr>
                                    <th>شناسه</th>
                                    <th>نام محصول</th>
                                    <th>قیمت</th>
                                    <th>تعداد خریداری شده</th>
                                    <th></th>
                                </tr>
                                @foreach($most_selled_product as $product)

                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <a href="{{ route("admin_product_edit",["id"=>$product->id]) }}">{{ $product->title }}</a>

                                        </td>
                                        <td>{!! $product->product_price() !!}</td>
                                        <td>{{ $product->selled }}</td>
                                        <td class="icons">
                                            <div class="admin-table-actions">
                                                <a href="{{ route("admin_product_edit",["id"=>$product->id]) }}">
                                                    <span>
                                                        <svg id="Group_22" data-name="Group 22" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_71" data-name="Path 71" d="M0,0H20V20H0Z" fill="none"/>
  <path id="Path_72" data-name="Path 72" d="M8.167,7h-2.5A1.667,1.667,0,0,0,4,8.667v7.5a1.667,1.667,0,0,0,1.667,1.667h7.5a1.667,1.667,0,0,0,1.667-1.667v-2.5" transform="translate(-0.667 -1.167)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_73" data-name="Path 73" d="M9,12.98h2.5L18.583,5.9a1.768,1.768,0,1,0-2.5-2.5L9,10.48v2.5" transform="translate(-1.5 -0.48)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_21" data-name="Line 21" x2="2.5" y2="2.5" transform="translate(13.333 4.167)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>
                                                    </span>
                                                </a>
                                                <a href="{{ route("admin_delete_product",["id"=>$product->id]) }}">
                                                    <span>
                                                        <svg id="Group_23" data-name="Group 23" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_74" data-name="Path 74" d="M0,0H20V20H0Z" fill="none"/>
  <line id="Line_22" data-name="Line 22" x2="13.333" transform="translate(3.333 5.833)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_23" data-name="Line 23" y2="5" transform="translate(8.333 9.167)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <line id="Line_24" data-name="Line 24" y2="5" transform="translate(11.667 9.167)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_75" data-name="Path 75" d="M5,7l.833,10A1.667,1.667,0,0,0,7.5,18.667h6.667A1.667,1.667,0,0,0,15.833,17l.833-10" transform="translate(-0.833 -1.167)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_76" data-name="Path 76" d="M9,6.333v-2.5A.833.833,0,0,1,9.833,3h3.333A.833.833,0,0,1,14,3.833v2.5" transform="translate(-1.5 -0.5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>
                                                    </span>
                                                </a>
                                                <a href="{{ $product->url }}">
                                                    <span>
                                                        <svg id="Group_24" data-name="Group 24" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
  <path id="Path_77" data-name="Path 77" d="M0,0H20V20H0Z" fill="none"/>
  <circle id="Ellipse_8" data-name="Ellipse 8" cx="2" cy="2" r="2" transform="translate(8 8)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
  <path id="Path_78" data-name="Path 78" d="M18.667,10.833q-3.334,5.834-8.333,5.833T2,10.833Q5.334,5,10.333,5t8.333,5.833" transform="translate(-0.333 -0.833)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
</svg>
                                                    </span>
                                                </a>
                                            </div>
                                        </td>


                                    </tr>        @endforeach

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="admin-box">
                        <div class="admin-box-title d-flex justify-content-between align-items-center">
                            <strong>
                                آخرین دیدگاه ها
                            </strong>
                            <a href="{{ route("product_comments.index") }}" class="btn-blue">
                                همه دیدگاه ها
                            </a>
                        </div>
                        <div class="admin-box-content">
                            @foreach($comments as $comment)
                                <div class="review-content-item">
                                    <div class="review-content-item-top">
                                        <div class="review-content-item-top-right">
                                            <img @if(is_object($comment->user)) src="{{ $comment->user->profile_avatar }}" @else src="{{ theme_asset("img/user_avatar.png") }}" @endif>
                                            <div class="review-content-item-top-right-right">
                                                <span>{{ $comment->name }}</span>
                                                <div class="">
                                                       <span>
                                                           {{ toShamsi($comment->created_at) }}
                                                       </span>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="content-item-bottom">
                                        <p>{!!   $comment->text  !!}</p>
                                    </div>


                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </section>

    </x-slot>
</x-admin-panel-layout>
