
    <x-admin-panel-layout>
        <x-slot name="title">
            لیست ورودی های فرم {{ $form->name }}
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">            لیست ورودی های فرم {{ $form->name }}
                            </h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_list_forms") }}">لیست فرم ها</a></li>
                                <li class="breadcrumb-item active">            لیست ورودی های فرم {{ $form->name }}
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>

    <table class="admin-table final-table">
        <tr>
            <th>شناسه</th>
            <th>وضعیت</th>
            <th>تاریخ ارسال</th>
        </tr>
        @foreach($entrances as $entrance)

        <tr>
            <td><a href="{{ route("admin_form_entrance_show",["id"=>$entrance->id]) }}">{{ $entrance->id }}</a>
                <div class="admin-table-actions">
                    <a
                       href="{{ route("admin_form_entrance_show",["id"=>$entrance->id]) }}"><span>نمایش جزییات</span></a>
                    @if($entrance->status=="accepted")
                        <a href="{{ route("admin_form_entrance_status",["id"=>$entrance->id,"status"=>"not_accepted"]) }}"
                           style="color:#d98500"><span>نپذیرفتن</span></a>
                    @else
                        <a href="{{ route("admin_form_entrance_status",["id"=>$entrance->id,"status"=>"accepted"]) }}"
                           style="color:#006505"><span>پذیرفتن</span></a>

                    @endif
                    <a class="admin-table-actions-delete"
                       href="{{ route("admin_delete_form_entrance",["id"=>$entrance->id]) }}"><span>حذف</span></a>
                </div>
            </td>
            <td>
                @lang($entrance->status)
            </td>
            <td>{{ toShamsi($entrance->created_at) }}</td>

        </tr>
        @endforeach

    </table>

   @includeIf("admin.partials.delete_modal")
        </x-slot>
    </x-admin-panel-layout>
