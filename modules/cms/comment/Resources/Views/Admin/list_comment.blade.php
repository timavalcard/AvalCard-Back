@extends("admin.adminMain.main")
@section("admin_title")

    لیست نظرات
@endsection

@section("AdminContent")
    <form action="{{ route("admin_group_action") }}" method="post">
        @csrf
        <div class="admin-order-select-box">
            <div class="admin-order-by-box">

                    <label>مرتب سازی بر اساس : </label>


                        <a href="{{ route("admin_list_comment" ,["orderBy"=>"all"]) }}" class="btn btn-sm btn-outline-dark @if(!isset($_GET["orderBy"]) || request("orderBy")=="all" ) btn-dark text-white @endif">همه</a>
                        <a href="{{ route("admin_list_comment" ,["orderBy"=>"unapproved"]) }}" class="btn btn-sm btn-outline-dark @if(request("orderBy")=="unapproved") btn-dark text-white @endif" >نپذیرفته شده ها</a>
                        <a href="{{ route("admin_list_comment" ,["orderBy"=>"approved"]) }}" class="btn btn-sm btn-outline-dark @if(request("orderBy")=="approved") btn-dark text-white @endif" >پذیرفته شده ها</a>



            </div>



            <div class="admin-select-all-checkbox">

                <label>کارهای دسته جمعی : </label>
                <input type="hidden" value="comment" name="type">
                <select name="action">
                    <option value="delete" selected>حذف</option>
                    <option value="unapproved">نپذیرفتن</option>
                    <option value="approved">پذیرفتن</option>
                </select>
                <button class="btn btn-outline-success btn-sm mr-3">انجام عملیات</button>
            </div>
        </div>
        <table class="admin-table final-table">
            <tr>
                <th><label>انتخاب همه موارد</label>
                    <input type="checkbox" class="admin-select-all-checkbox-btn ml-3"></th>
                <th>نام فرستنده</th>
                <th>متن</th>
                <th>برای پست</th>

                <th>تاریخ نوشتن</th>
            </tr>
            @foreach($comments as $comment)
                <tr class="@unless($comment->status) {{"comment-not-approved"}} @endif">
                    <td><input type="checkbox" name="checkbox_item[]" value="{{ $comment->id }}"></td>
                    <td><a href="{{ route("admin_edit_comment",["id"=>$comment->id]) }}">@if( $comment->name){{ $comment->name }}@endif</a>
                        <div class="admin-table-actions"><a href="{{ route("admin_edit_comment",["id"=>$comment->id]) }}"><span>بروزرسانی</span></a>
                            <a class="admin-table-actions-delete"
                               href="{{ route("admin_delete_comment",["id"=>$comment->id]) }}"><span>حذف</span></a>
                            <a
                                    href="{{ route("admin_answer_comment",["id"=>$comment->id]) }}"><span>پاسخ</span></a>
                            @if($comment->status)
                                <a href="{{ route("admin_ChangeState_comment",["id"=>$comment->id]) }}"
                                   style="color:#d98500"><span>نپذیرفتن</span></a>
                            @else
                                <a href="{{ route("admin_ChangeState_comment",["id"=>$comment->id]) }}"
                                   style="color:#006505"><span>پذیرفتن</span></a>

                            @endif

                        </div>
                    </td>
                    <td>
                        @if($comment->parent_id !=0)
                            <p class="mb-3">
                                در پاسخ به
                                {{ $comment->parent->name }}
                            </p>
                        @endif
                        {!! $comment->text !!}

                    </td>
                    <td>

                        <a href="{{ $comment->commentable->url }}">{{ $comment->commentable->title }}</a>
                    </td>

                    <td>{{ toShamsi($comment->created_at) }}</td>
                </tr>        @endforeach
            <tr>
                <th><label>انتخاب همه موارد</label>
                    <input type="checkbox" class="admin-select-all-checkbox-btn ml-3"></th>
                <th>نام فرستنده</th>
                <th>متن</th>
                <th>برای پست</th>

                <th>تاریخ نوشتن</th>
            </tr>
        </table>
        <div class="admin-order-select-box mt-3">
            <div class="admin-order-by-box">

                <label>مرتب سازی بر اساس : </label>


                <a href="{{ route("admin_list_comment" ,["orderBy"=>"all"]) }}" class="btn btn-sm btn-outline-dark @if(!isset($_GET["orderBy"]) || request("orderBy")=="all" ) btn-dark text-white @endif">همه</a>
                <a href="{{ route("admin_list_comment" ,["orderBy"=>"unapproved"]) }}" class="btn btn-sm btn-outline-dark @if(request("orderBy")=="unapproved") btn-dark text-white @endif" >نپذیرفته شده ها</a>
                <a href="{{ route("admin_list_comment" ,["orderBy"=>"approved"]) }}" class="btn btn-sm btn-outline-dark @if(request("orderBy")=="approved") btn-dark text-white @endif" >پذیرفته شده ها</a>



            </div>


               {{--   <div class="admin-select-all-checkbox">

                <label>کارهای دسته جمعی : </label>
                <input type="hidden" value="comment" name="type">
                <select name="action">
                    <option value="delete" selected="">حذف</option>
                    <option value="unapproved">نپذیرفتن</option>
                    <option value="approved">پذیرفتن</option>
                </select>
                <button class="btn btn-outline-success btn-sm mr-3">انجام عملیات</button>
            </div>--}}
        </div>
    </form>
    <div class="admin-paginator">        {{ $comments->links() }}    </div>
    <div class="admin-delete-modal">
        <form action="" method="post">            @csrf            @method("delete") <p>شما می خواهید اینرا پاک کنید؟
                این کار غیر قابل برگشت است</p>            <span class="admin-modal-close btn-blue">انصراف</span>
            <button class="btn btn-danger">حذف</button>
        </form>
    </div>@endsection
