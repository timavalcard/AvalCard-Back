<header class="admin-header">
    <div class="admin-header-right">
        <ul>
            <li>
                <a href="/"><i class="fa fa-home"></i>
                    رفتن به سایت 
                </a>
            </li>
             <li><a href="{{ route("admin_list_comment") }}" class="{{ request()->is('admin/comment*') ? 'active' : '' }}"><i class="fa fa-comment"></i>نظرات
        @php
$commentCount=get_comment_unApproved_count();
@endphp
        @if($commentCount >0)
        <span class="admin-count">{{ $commentCount }}</span>
        @endif
        </a></li>
        </ul>
    </div>
    <div class="admin-header-left">
          <ul>
            <li>
                <a href="{{ route("admin_edit_user",["id"=>auth()->id()]) }}"><i class="fa fa-user"></i>
                    یوزر : {{ auth()->user()->name }}
                </a>
                <ul>
                    <li><a href="{{ route("admin_edit_user",["id"=>auth()->id()]) }}">ویرایش حساب</a></li>
                    <li>
                        <a href="{{ route("logout") }}" onclick="event.preventDefault();document.getElementById('form-logout').submit() ">بیرون رفتن</a>
                    </li>
                    <form id="form-logout" action="{{ route("logout") }}" method="post">
                        @csrf
                    </form>
                </ul>
            </li>
        </ul>
    </div>
</header>