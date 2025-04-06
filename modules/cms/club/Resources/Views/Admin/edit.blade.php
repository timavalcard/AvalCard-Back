 <x-admin-panel-layout>
        <x-slot name="title">
            ویرایش امتیاز کاربر {{ $club->user->name }}
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">            ویرایش امتیاز کاربر {{ $club->user->name }}</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_club_index") }}">باشگاه مشتریان </a></li>
                                <li class="breadcrumb-item active">            ویرایش امتیاز کاربر {{ $club->user->name }}
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>

    <div class="col-lg-9">
        <h4>
        </h4>

        <form action="{{ route("admin_edit_club",["id"=>$club->id]) }}" method="post">
            @csrf
            @method("put")
            <div class="mb-4 mt-4">
                <p class="mt-4">
                 <input placeholder="نام کاربر" type="text" value="{{ $club->user->name }}" readonly>
                </p>
                <p class="mt-4">
                    <label>امتیاز کاربر در باشگاه مشتریان</label>
                    <input  type="number" value="{{ $club->meta_value }}" name="club_point"  min="0">
                </p>

                <p class="mt-4">
                <button type="submit" class="btn-blue">ویرایش</button>

                </p>
            </div>
        </form>
    </div>
        </x-slot>
 </x-admin-panel-layout>
