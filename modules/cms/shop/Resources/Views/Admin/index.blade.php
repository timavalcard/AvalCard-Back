
<x-admin-panel-layout>
    <x-slot name="title">
         فروشگاه
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">فروشگاه</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item active">فروشگاه</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>

        <div class="shop-index-content px-4">
            <div class="d-flex flex-wrap justify-content-around align-items-stretch  align-content-stretch mb-5">

                <div class="p-1 col-6 col-sm-3 mb-3">
                    <div class="card border-primary">
                        <div class="card-header text-center">سفارشات امروز</div>
                        <div class="card-body text-primary">
                            <h5 class="card-title text-center">
                                <span>{{$get_Orders_today}}</span>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="p-1 col-6 col-sm-3 mb-3">
                    <div class="card border-primary">
                        <div class="card-header text-center">سفارشات ۷ روز گذشته</div>
                        <div class="card-body text-primary">
                            <h5 class="card-title text-center">
                                <span>{{$past_7_days_orders}}</span>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="p-1 col-6 col-sm-3 mb-3">
                    <div class="card border-primary">
                        <div class="card-header text-center">سفارشات ۳۰ روز گذشته</div>
                        <div class="card-body text-primary">
                            <h5 class="card-title text-center">
                                <span>{{$past_30_days_orders}}</span>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="p-1 col-6 col-sm-3 mb-3">
                    <div class="card border-primary">
                        <div class="card-header text-center">کل سفارشات</div>
                        <div class="card-body text-primary">
                            <h5 class="card-title text-center">
                                <span>{{$all_orders}}</span>
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="card col-12">
                    <div class="card-body p-0">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                        </figure>

                    </div>
                </div>


            </div>
            <h5 class="mb-4">پر فروش ترین محصولات</h5>
            <table class="admin-table final-table">
                <tr>
                    <th>شناسه</th>
                    <th>نام محصول</th>
                    <th>نوع محصول</th>
                    <th>قیمت</th>
                    <th>تعداد خریداری شده</th>
                </tr>
                @foreach($most_selled_product as $product)

                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><a href="{{ route("admin_product_edit",["id"=>$product->id]) }}">{{ $product->title }}</a>
                            <div class="admin-table-actions"><a href="{{ route("admin_product_edit",["id"=>$product->id]) }}"><span>بروزرسانی</span></a>
                                <a class="admin-table-actions-delete"
                                   href="{{ route("admin_delete_product",["id"=>$product->id]) }}"><span>حذف</span></a> <a href="{{ $product->url }}"><span>نمایش در سایت</span></a>
                            </div>
                        </td>
                        <td>
                            @if($product->product_type=="group_product")
                                زیر محصول گروهی
                            @else
                                محصول تکی
                            @endif
                        </td>
                        <td>{!! $product->product_price() !!}</td>
                        <td>{{ $product->selled }}</td>


                    </tr>        @endforeach

            </table>
        </div>

        @if(auth()->user()->hasPermissionTo(\CMS\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN) || auth()->user()->hasPermissionTo(\CMS\RolePermissions\Models\Permission::PERMISSION_MANAGE_SHOP))
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
                        categories: [@foreach($datesOrder as $date => $value) "{{IR_TimestampToDate($date,'Y-m-d')}}", @endforeach]
                    },
                    yAxis: {
                        title: {
                            text: 'عدد'
                        },
                        labels: {
                            formatter: function () {
                                return 'عدد' + this.value;
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
                    series: [
                        {
                            type: 'column',
                            name: 'سفارشات محصولات',
                            color: ' #58d68d ',
                            data: [@foreach($datesOrder as $date => $value) @if($summeryOrder->where('date',$date)->first()) {{$summeryOrder->where('date',$date)->first()->total}}, @else 0, @endif @endforeach]
                        },
                        {
                            type: 'spline',
                            name: 'سفارشات محصولات spline',
                            data: [@foreach($datesOrder as $date => $value) @if($summeryOrder->where('date',$date)->first()) {{$summeryOrder->where('date',$date)->first()->total}}, @else 0, @endif @endforeach],
                            marker: {
                                lineWidth: 2,
                                lineColor: '#5dade2',
                                fillColor: 'white'
                            }
                        },
                    ]
                })
                ;

            </script>
        @endif


    </x-slot>
</x-admin-panel-layout>
