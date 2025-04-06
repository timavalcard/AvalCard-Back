
<x-admin-panel-layout>
      <x-slot name="title">
          لیست ایمیل های وارد شده
      </x-slot>
      <x-slot name="main">
          <div class="content-header">
              <div class="container-fluid">
                  <div class="row mb-4">
                      <div class="col-sm-6">
                          <h3 class="m-0 text-dark"> لیست ایمیل های وارد شده</h3>
                      </div><!-- /.col -->
                      <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-left">
                              <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                              <li class="breadcrumb-item active">
                                  لیست ایمیل های وارد شده
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


                <a href="{{ route("admin_newsletter_list" ,["orderBy"=>"desc"]) }}"
                   class="btn btn-sm btn-outline-dark @if(request("orderBy")=="desc" ) btn-dark text-white @endif">تاریخ
                    ورود نزولی</a>
                <a href="{{ route("admin_newsletter_list" ,["orderBy"=>"asc"]) }}"
                   class="btn btn-sm btn-outline-dark @if(!isset($_GET["orderBy"]) || request("orderBy")=="asc" ) btn-dark text-white @endif">تاریخ
                    ورود صعودی</a>
                <a href="{{ route("admin_newsletter_list" ,["orderBy"=>"email"]) }}"
                   class="btn btn-sm btn-outline-dark @if(request("orderBy")=="email") btn-dark text-white @endif">ایمیل</a>


            </div>


            <div class="admin-select-all-checkbox">

                <label>کارهای دسته جمعی : </label>
                <input type="hidden" value="newsletter" name="type">
                <select name="action">
                    <option value="delete" selected="">حذف</option>
                </select>
                <button class="btn-blue mr-3">انجام عملیات</button>
            </div>
        </div>
        <table class="admin-table final-table">
            <tr>
                <th><label>انتخاب همه موارد</label>
                    <input type="checkbox" class="admin-select-all-checkbox-btn ml-3"></th>
                <th>ایمیل</th>

                <th>تاریخ ورود</th>
            </tr>
            @foreach($emails as $email)

                <tr>
                    <td><input type="checkbox" name="checkbox_item[]" value="{{ $email->id }}"></td>
                    <td><a href="{{ route("admin_article_edit",["id"=>$email->id]) }}">{{ $email->email }}</a>
                        <div class="admin-table-actions"><a
                                    href="{{ route("admin_edit_page",["id"=>$email->id]) }}"><span></span></a>
                            <a class="admin-table-actions-delete"
                               href="{{ route("admin_newsletter_delete",["id"=>$email->id]) }}"><span>حذف</span></a>

                        </div>
                    </td>
                    <td>{{ toShamsi($email->created_at) }}</td>
                </tr>        @endforeach
            <tr>
                <th><label>انتخاب همه موارد</label>
                    <input type="checkbox" class="admin-select-all-checkbox-btn ml-3"></th>
                <th>ایمیل</th>

                <th>تاریخ ورود</th>
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
