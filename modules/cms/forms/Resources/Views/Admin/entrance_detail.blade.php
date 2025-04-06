 <x-admin-panel-layout>
        <x-slot name="title">
            جزییات ورودی: {{ $entrance->id }}
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">            جزییات ورودی: {{ $entrance->id }}</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_list_forms") }}">لیست فرم ها</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_form_entrances",$form->id) }}">لیست ورودی های فرم {{ $form->name }}</a></li>
                                <li class="breadcrumb-item active">            جزییات ورودی {{ $entrance->id }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="billing_information_items">
                    @foreach($entrance->values as $value)
                        @if($loop->index!=0 && $loop->iteration!=$loop->count)
                            <div class="billing_information_item">
                                <div class="billing_information_item_title">
                                    {!!   $value["label"]??"" !!} :
                                </div>
                                <div class="billing_information_item_value">
                                    {{ $value["userData"][0]??"" }}
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

            </div>
            <style>
                .billing_information_item_title br {
                    display: none;
                }.billing_information_item_title form {
                     display: none;
                 }
            </style>
        </x-slot>
    </x-admin-panel-layout>
