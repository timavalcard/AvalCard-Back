 <x-admin-panel-layout>
        <x-slot name="title">
            ویرایش کیف پول {{ $wallet->user->name }}
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">     ویرایش کیف پول {{ $wallet->user->name }}</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_wallet_index") }}">کیف پول ها</a></li>
                                <li class="breadcrumb-item active">     ویرایش کیف پول {{ $wallet->user->name }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>

    <div class="col-lg-9">
        <h4>
        </h4>

        <form action="{{ route("admin_edit_wallet",["id"=>$wallet->id]) }}" method="post">
            @csrf
            @method("put")
            <div class="mb-4 mt-4">
                <p class="mt-4">
                 <input placeholder="نام کاربر" type="text" value="{{ $wallet->user->name }}" readonly>
                </p>
                <p class="mt-4">
                    <label>مبلغ کیف پول</label>
                    <input  type="number" value="{{ $wallet->price }}" name="price" step="1000"  min="0" max="9999999">
                </p>

                <p class="mt-4">
                <button type="submit" class="btn-blue">ویرایش</button>

                </p>
            </div>
        </form>
    </div>
        </x-slot>
 </x-admin-panel-layout>
