<x-admin-panel-layout>
        <x-slot name="title">
            لیست تغییر مسیر ها
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">لیست تغییر مسیر ها</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item active">
                                    لیست تغییر مسیر ها
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    {{--<form action="{{ route("admin_group_action") }}" method="post">
        @csrf--}}
        <div class="admin-order-select-box mt-3">
            <div></div>
            <div class="mb-3">
                <a href="{{ route("admin_seo_redirect_add") }}" class="btn-blue text-white">افزودن تغییر مسیر</a>
            </div>
        </div>

        <table class="admin-table final-table">
            <tr>

                <th>لینک</th>
                <th>تغییر مسیر به</th>
                <th>کد</th>
                <th>تاریخ انتشار</th>
            </tr>
            @foreach($redirects as $redirect)

                <tr>

                    <td><a href="{{ route("admin_seo_redirect_edit",["id"=>$redirect->id]) }}">{{ $redirect->redirect_from }}</a>
                        <div class="admin-table-actions"><a
                                    href="{{ route("admin_seo_redirect_edit",["id"=>$redirect->id]) }}"><span>بروزرسانی</span></a>
                            <a class="admin-table-actions-delete"
                               href="{{ route("admin_seo_redirect_delete",["id"=>$redirect->id]) }}"><span>حذف</span></a>
                        </div>
                    </td>
                    <td>{{ $redirect->redirect_to }}</td>
                    <td>{{ $redirect->status_code }}</td>
                    <td>{{ toShamsi($redirect->created_at) }}</td>
                </tr>        @endforeach

        </table>

    {{--</form>--}}
    <div class="admin-paginator">
        {{ $redirects->links() }}
    </div>
            @includeIf("admin.partials.delete_modal")
        </x-slot>
</x-admin-panel-layout>
