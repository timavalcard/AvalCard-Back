
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
        <form action="{{ route("admin_group_action") }}" method="post">
            @csrf
            <div class="admin-table-content">
                <div class="admin-order-select-box mb-3">
                    <div class="admin-order-by-box">

                        <label>مرتب سازی بر اساس : </label>
                    </div>




                </div>
                <table class="admin-table final-table">
                    <tr>
                        <th>شناسه</th>
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

                                    <a class="admin-table-actions-delete"
                                       href="{{ route("admin_delete_ticket",["id"=>$ticket->id]) }}"><span>حذف</span></a>


                                </div>
                            </td>
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
