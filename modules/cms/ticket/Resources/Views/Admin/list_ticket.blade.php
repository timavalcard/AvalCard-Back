
<x-admin-panel-layout>
    <x-slot name="title">
        لیست تیکت ها
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark"> لیست تیکت ها</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item active">
                                لیست تیکت ها
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <form method="GET" action="{{ route('tickets.index', ['status' => request()->status]) }}" class="mb-4">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label for="mobile" class="form-label">عنوان تیکت</label>
                    <input value="{{request()->title}}" style="border-radius: 10px;" type="text" name="title" placeholder="جستجو بر اساس  عنوان تیکت">
                </div>
                <div class="col-md-3">
                    <label for="mobile" class="form-label">موبایل کاربر</label>
                    <input value="{{request()->mobile}}" style="border-radius: 10px;" type="text" name="mobile" placeholder="جستجو بر اساس موبایل کاربر">
                </div>

                {{-- دکمه فیلتر --}}
                <div class="col-md-3 d-grid">
                    <input type="hidden" name="status" value="{{ request()->status }}">

                    <button type="submit" class="btn btn-primary text-sm">اعمال فیلتر</button>
                </div>
            </div>
        </form>
        <div class="admin-order-by-box mt-3 mb-3">
            <label>فیلتر بر اساس وضعیت :</label>

            {{-- لینک همه سفارشات (بدون status ولی با حفظ بقیه فیلترها) --}}
            <a class="btn btn-sm @if(!request()->has('status')) text-white btn-dark @else btn-outline-dark @endif"
               href="{{ request()->fullUrlWithQuery(['status' => null]) }}">
                همه تیکت ها
            </a>

            {{-- لینک وضعیت‌های دیگر --}}
            @php
                $statuses = ['پاسخ داده شده', 'در حال بررسی', 'بسته', 'در انتظار پاسخ کاربر'];
            @endphp

            @foreach($statuses as $status)
                <a class="btn btn-sm @if(request()->status == $status) text-white btn-dark @else btn-outline-dark @endif"
                   href="{{ request()->fullUrlWithQuery(['status' => $status]) }}">
                    {{ $status }}
                </a>
            @endforeach

        </div>


        <form action="{{ route("admin_group_action") }}" method="post">
            @csrf
            <div class="admin-table-content">
                <div class="admin-order-select-box mb-3">





                </div>
                <table class="admin-table final-table">
                    <tr>
                        <th>شناسه</th>
                        <th>کاربر</th>
                        <th>عنوان</th>
                        <th>وضعیت</th>
                        <th>دپارتمان</th>
                        <th>تاریخ نوشتن</th>
                        <th>آخرین بروزرسانی</th>

                    </tr>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td><a href="{{ route("admin_edit_ticket",["id"=>$ticket->id]) }}">{{$ticket->id}}</a>
                                <div class="admin-table-actions d-block" style="
    display: block !important;
">
                                    <a
                                        href="{{ route("admin_answer_ticket",["id"=>$ticket->id]) }}"><span>پاسخ</span></a>

                                    {{--<a class="admin-table-actions-delete"
                                       href="{{ route("admin_delete_ticket",["id"=>$ticket->id]) }}"><span>حذف</span></a>--}}


                                </div>
                            </td>
                            <td>{{ $ticket->user? $ticket->user->name : "" }}</td>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ $ticket->status }}</td>
                            <td>{{ $ticket->department }}</td>
                            <td>{{ toShamsi($ticket->created_at,"Y/m/d H:i") }}</td>
                            <td>{{ toShamsi($ticket->updated_at,"Y/m/d H:i") }}</td>

                        </tr>

                    @endforeach

                </table>
            </div>

        </form>


        <div class="admin-paginator">        {{ $tickets->links() }}    </div>
        <div class="admin-delete-modal">
            <form action="" method="post">            @csrf            @method("delete") <p>شما می خواهید اینرا پاک کنید؟
                    این کار غیر قابل برگشت است</p>            <span class="admin-modal-close btn-blue">انصراف</span>
                <button class="btn btn-danger">حذف</button>
            </form>
        </div>
    </x-slot>
</x-admin-panel-layout>
