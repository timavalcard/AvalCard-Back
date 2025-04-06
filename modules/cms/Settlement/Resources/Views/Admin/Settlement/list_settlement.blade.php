<x-admin-panel-layout>
    <x-slot name="title">
        لیست تسویه
    </x-slot>
    <x-slot name="main">
        <!-- Checked checkbox -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">لیست پرداخت ها</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            {{--                            <li class="breadcrumb-item"><a href="#">خانه</a></li>--}}
                            <li class="breadcrumb-item">مدیریت پرداخت ها</li>
                            <li class="breadcrumb-item active">لیست تسویه</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content mt-sm-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">لیست تسویه</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="alert alert-success col-md-11 mx-auto mt-2 d-none" role="alert" id="alertDelUser">
                        تسویه با موفقیت حذف گردید
                    </div>

                    <div class="mx-auto my-3 d-flex">
                        <button type="button" class="btn-blue mx-auto btn-sm" data-toggle="modal"
                                data-target="#exampleModalCenter">
                            جست و جو
                        </button>
                    </div>

                    <div class="tableSection bg-light smSmall p-0 pr-sm-4 pl-sm-4 pt-sm-4 pb-0 table-responsive">
                        <table class="table table-striped text-center small">
                            <thead>
                            <tr>
                                <th scope="col">شناسه</th>
                                <th scope="col">کاربر مربوطه</th>
                                <th scope="col">نام کاربر</th>
                                <th scope="col">کد ملی کاربر</th>
                                <th scope="col">شماره شبا</th>
                                <th scope="col">تاریخ درخواست</th>
                                <th scope="col">مبلغ</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settlements as $settlement)
                                <tr id="tr{{$settlement->id}}">
                                    <td scope="row">{{$settlement->id}}</td>
                                    <td>{{'id :'.$settlement->user->id .' |'.$settlement->user->mobile}}</td>
                                    <td>{{$settlement->user->name}}</td>
                                    <td>{{$settlement->user->national_code}}</td>

                                    <td>{{ $settlement->cart_number  }}</td>
                                    <td>{{IR_TimestampToDate($settlement->created_at)}}</td>
                                    {{--                                    <td>{{$settlement->setteld_at ? IR_TimestampToDate($settlement->setteld_at)  : '-'}}</td>--}}
                                    <td>{{$settlement->amount}}</td>
                                    <td class="@if($settlement->status == \CMS\Settlement\Models\Settlement::STATUS_SETTLED) text-success @elseif($settlement->status == \CMS\Settlement\Models\Settlement::STATUS_PENDING) text-warning @else text-danger @endif">@lang($settlement->status)</td>
                                    <td class="d-flex justify-content-around">
                                        @can(\CMS\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN)
                                            <a class="btn btn-sm btn-primary"
                                               href="{{route('settlement.edit',$settlement->id)}}"
                                               title="ویرایش">
                                                <i class="fa fa-pencil-square-o text-light"></i>
                                            </a>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $settlements->appends(request()->query())->links() }}
                </div>
                <!-- /.card-body -->
            </div>
        </section>

        {{-- small modal   --}}
        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-sm" style="margin-top: 7rem !important;">
                <div class="modal-content p-3" id="report_body">
                    پیام
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">موبایل</label>
                                <div class="col-sm-10">
                                    <input name="mobile" value="{{request()->mobile}}" class="form-control"
                                           id="inputEmail3">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">نام</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{request()->name}}" class="form-control"
                                           id="inputPassword3">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">از تاریخ</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start_day" value="{{request()->start_day}}"
                                           class="form-control" id="inputPassword3" placeholder="1400-06-08">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">تا تاریخ</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end_day" value="{{request()->end_day}}"
                                           class="form-control" id="inputPassword3" placeholder="1400-07-09">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">وضعیت</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status">
                                        <option selected value="">انتخاب</option>
                                        <option
                                            {{request()->status == CMS\Settlement\Models\Settlement::STATUS_SETTLED ? 'selected' : ''}} value="{{CMS\Settlement\Models\Settlement::STATUS_SETTLED}}">
                                            موفق
                                        </option>
                                        <option
                                            {{request()->status == CMS\Settlement\Models\Settlement::STATUS_CANCELED ? 'selected' : ''}} value="{{CMS\Settlement\Models\Settlement::STATUS_CANCELED}}">
                                            نا موفق
                                        </option>
                                        <option
                                            {{request()->status == CMS\Settlement\Models\Settlement::STATUS_PENDING ? 'selected' : ''}} value="{{CMS\Settlement\Models\Settlement::STATUS_PENDING}}">
                                            در انتظار
                                        </option>
                                        {{--                                        <option value="{{\CMS\Settlement\Models\Settlement::STATUS_PENDING}}">در حال انجام</option>--}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">کد رهگیری</label>
                                <div class="col-sm-8">
                                    <input type="text" name="ref_id" value="{{request()->ref_id}}" class="form-control"
                                           id="inputPassword3">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">کد سفارش</label>
                                <div class="col-sm-8">
                                    <input type="text" name="code" value="{{request()->code}}" class="form-control"
                                           id="inputPassword3">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label small sm">شناسه کاربر پورسانت
                                    گیرنده</label>
                                <div class="col-sm-6">
                                    <input type="text" name="seller_id" value="{{request()->seller_id}}"
                                           class="form-control" id="inputPassword3" placeholder="مثلا : ۱۲">
                                </div>
                            </div>
                            <div class="form-group row float-left">
                                <div class="col-sm-10 ">
                                    <button type="submit" class="btn-blue mx-auto">جست و جو</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end search form --}}

    </x-slot>
    @if(session()->get('status') == 'created')
        <x-slot name="linkScript">
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'ایجاد درخواست تسویه با موفقیت انجام شد',
                })
            </script>
        </x-slot>
    @endif
    @if(session()->get('status') == 'updated')
        <x-slot name="linkScript">
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'ویرایش تسویه با موفقیت انجام شد',
                })
            </script>
        </x-slot>
    @endif
    @if(session()->get('status') == 'CanNotSetNewSettlementRequest')
        <x-slot name="linkScript">
            <script>
                Swal.fire({
                    icon: 'error',
                    text: 'شما یک درخواست در حال انجام دارید',
                })
            </script>
        </x-slot>
    @endif
    @if(session()->get('status') == 'CanNotEditSettlementRequest')
        <x-slot name="linkScript">
            <script>
                Swal.fire({
                    icon: 'error',
                    text: 'فقط آخرین درخواست کاربر قابل ویرایش است و این درخواست بایگانی شده است',
                })
            </script>
        </x-slot>
    @endif
</x-admin-panel-layout>
