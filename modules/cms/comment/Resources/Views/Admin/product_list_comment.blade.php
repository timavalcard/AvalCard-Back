
<x-admin-panel-layout>
    <x-slot name="title">
        لیست نظرات
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark"> لیست نظرات</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item active">
                                لیست نظرات
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


                            <a href="{{ route("product_comments.index" ,["orderBy"=>"all"]) }}" class="btn btn-sm btn-outline-dark @if(!isset($_GET["orderBy"]) || request("orderBy")=="all" ) btn-dark text-white @endif">همه</a>
                            <a href="{{ route("product_comments.index" ,["orderBy"=>"unapproved"]) }}" class="btn btn-sm btn-outline-dark @if(request("orderBy")=="unapproved") btn-dark text-white @endif" >نپذیرفته شده ها</a>
                            <a href="{{ route("product_comments.index" ,["orderBy"=>"approved"]) }}" class="btn btn-sm btn-outline-dark @if(request("orderBy")=="approved") btn-dark text-white @endif" >پذیرفته شده ها</a>



                </div>




            </div>
            <table class="admin-table final-table">
            <tr>
                <th>نام فرستنده</th>
                <th>متن</th>
                <th>برای پست</th>

                <th>تاریخ نوشتن</th>

            </tr>
            @foreach($comments as $comment)
                <tr class="@unless($comment->status) {{"comment-not-approved"}} @endif">
                    <td><a href="{{ route("admin_edit_comment",["id"=>$comment->id]) }}">@if( $comment->name){{ $comment->name }}@endif</a>
                        <div class="admin-table-actions d-block" style="
    display: block !important;
"><a href="{{ route("admin_edit_comment",["id"=>$comment->id]) }}"><span>بروزرسانی</span></a>
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
                        {{ strip_tags($comment->text) }}

                    </td>
                    <td>
                        @if(is_object($comment->commentable))
                            <a href="{{ $comment->commentable->url }}">{{ $comment->commentable->title }}</a>
                        @else
                            -
                        @endif
                    </td>

                    <td>{{ toShamsi($comment->created_at) }}</td>

                </tr>
                @if($comment->children)
                    @foreach($comment->children as $child_comment)
                        <tr style="border:solid 1px #209c20" class="@unless($child_comment->status) {{"comment-not-approved"}} @endif">
                            <td><a href="{{ route("admin_edit_comment",["id"=>$child_comment->id]) }}">@if( $child_comment->name){{ $child_comment->name }}@endif</a>
                                <div class="admin-table-actions"><a href="{{ route("admin_edit_comment",["id"=>$child_comment->id]) }}"><span>بروزرسانی</span></a>
                                    <a class="admin-table-actions-delete"
                                       href="{{ route("admin_delete_comment",["id"=>$child_comment->id]) }}"><span>حذف</span></a>
                                    <a
                                        href="{{ route("admin_answer_comment",["id"=>$child_comment->id]) }}"><span>پاسخ</span></a>
                                    @if($child_comment->status)
                                        <a href="{{ route("admin_ChangeState_comment",["id"=>$child_comment->id]) }}"
                                           style="color:#d98500"><span>نپذیرفتن</span></a>
                                    @else
                                        <a href="{{ route("admin_ChangeState_comment",["id"=>$child_comment->id]) }}"
                                           style="color:#006505"><span>پذیرفتن</span></a>

                                    @endif

                                </div>
                            </td>
                            <td>
                                @if($child_comment->parent_id !=0)
                                    <p class="mb-3">
                                        در پاسخ به
                                        {{ $child_comment->parent->name }}
                                    </p>
                                @endif
                                {!! $child_comment->text !!}

                            </td>
                            <td>

                                @if(is_object($child_comment->commentable))
                                    <a href="{{ $child_comment->commentable->url }}">{{ $child_comment->commentable->title }}</a>
                                @else
                                -
                                @endif
                            </td>

                            <td>{{ toShamsi($child_comment->created_at) }}</td>
                        </tr>
                    @endforeach
                @endif
            @endforeach

        </table>
        </div>

    </form>


    <div class="admin-paginator">        {{ $comments->links() }}    </div>
    <div class="admin-delete-modal">
        <form action="" method="post">            @csrf            @method("delete") <p>شما می خواهید اینرا پاک کنید؟
                این کار غیر قابل برگشت است</p>            <span class="admin-modal-close btn-blue">انصراف</span>
            <button class="btn btn-danger">حذف</button>
        </form>
    </div>
    </x-slot>
</x-admin-panel-layout>
