@extends("admin.adminMain.main")
@section("admin_title")

    لیست خدمات
@endsection

@section("AdminContent")
    <table class="admin-table final-table">
        <tr>
            <th>نام خدمت </th>
            <th>عکس خدمت</th>
            <th>تاریخ ساخت</th>
        </tr>
        @foreach($services as $service)
        <tr>
            <td><a href="{{ route("admin_service_edit",["id"=>$service->id]) }}">
                {{ $service->name}}</a>
                <div class="admin-table-actions">

                    <a href="{{ route("admin_service_edit",["id"=>$service->id]) }}"><span>بروزرسانی</span></a>
                    <a class="admin-table-actions-delete"
                       href="{{ route("admin_delete_service",["id"=>$service->id]) }}"><span>حذف</span></a>
                    <a href="{{ route("admin_sub_services",["parent"=>$service->id]) }}"><span>زیر خدمات</span></a>

                </div>
            </td>
            <td>
                @if($service->media_id)
                    @php($image=$service->getSmallImage())

                    <img  src="{{ $image }}"/>

                @else{{"_"}}

                @endif
            </td>

            <td>{{ $service->created_at }}</td>
        </tr>        @endforeach
        <tr>
            <th>نام خدمت </th>
            <th>عکس خدمت</th>
            <th>تاریخ ساخت</th>
        </tr>
    </table>
    <div class="admin-paginator">
        {{ $services->links() }}
    </div>
   @includeIf('admin.partials.delete_modal')
@endsection
