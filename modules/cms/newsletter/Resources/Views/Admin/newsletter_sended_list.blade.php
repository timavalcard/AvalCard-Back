
    <x-admin-panel-layout>
        <x-slot name="title">
            لیست خبرنامه ها
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">لیست خبرنامه های ارسال شده</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item active">
                                    لیست خبرنامه های ارسال شده
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <form action="{{ route("admin_group_action") }}" method="post">
        @csrf
        <div class="admin-order-select-box mt-3">
            <div class="admin-order-by-box">

                <label>مرتب سازی بر اساس : </label>


                <a href="{{ route("admin_newsletter_list_sent" ,["orderBy"=>"desc"]) }}"
                   class="btn btn-sm btn-outline-dark @if(request("orderBy")=="desc" ) btn-dark text-white @endif">تاریخ
                    ارسال نزولی</a>
                <a href="{{ route("admin_newsletter_list_sent" ,["orderBy"=>"asc"]) }}"
                   class="btn btn-sm btn-outline-dark @if(!isset($_GET["orderBy"]) || request("orderBy")=="asc" ) btn-dark text-white @endif">تاریخ
                    ارسال صعودی</a>


            </div>



        </div>
        <table class="admin-table final-table">
            <tr>
                 <th>نام</th>
                <th>ارسال شده به</th>

                <th>تاریخ ارسال</th>
            </tr>
            @foreach($emails as $email)

                <tr>

                    <td><a href="{{ route("admin_article_edit",["id"=>$email->id]) }}">{{ $email->title }}</a>
                        <div class="admin-table-actions">
                            <a  href="{{ route("admin_newsletter_send_edit",["id"=>$email->id]) }}"><span>بروزرسانی</span></a>
                            <a class="admin-table-actions-delete" href="{{ route("admin_newsletter_send_delete",["id"=>$email->id]) }}"><span>حذف</span></a>
                            <a href="{{ route("admin_newsletter_send_again",["id"=>$email->id]) }}" class="text-success">ارسال دوباره</a>
                        </div>
                    </td>
                    @php($sendTo=unserialize($email->sendsTo)=="all" ? "همه عضو ها": (is_int(unserialize($email->sendsTo)) ? count(unserialize($email->sendsTo))." عضو " : 1 . " عضو " ))
                    <td>{{ $sendTo }}</td>
                    <td>{{ toShamsi($email->updated_at) }}</td>
                </tr>        @endforeach
            <tr>
                <th><label>انتخاب همه موارد</label>
                    <input type="checkbox" class="admin-select-all-checkbox-btn ml-3"></th>
                <th>نام</th>
                <th>ارسال شده به</th>
                <th>تاریخ ارسال</th>
            </tr>
        </table>

    </form>
    <div class="admin-paginator">
        {{ $emails->links() }}
    </div>
    <div class="admin-delete-modal">
        <form action="" method="post">
            @csrf
            @method("delete")
            <p>شما می خواهید اینرا پاک کنید؟
                این کار غیر قابل برگشت است</p>
            <span class="admin-modal-close btn-blue">انصراف</span>
            <button class="btn btn-danger">حذف</button>
        </form>
    </div>
        </x-slot>
    </x-admin-panel-layout>
