<x-admin-panel-layout>
    <x-slot name="title">
        بررسی درخواست تسویه
    </x-slot>
    <x-slot name="main">
        <!-- Checked checkbox -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">بررسی درخواست تسویه</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            {{--                            <li class="breadcrumb-item"><a href="#">خانه</a></li>--}}
                            <li class="breadcrumb-item">مدیریت پرداخت ها</li>
                            <li class="breadcrumb-item active">بررسی درخواست تسویه </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content mt-sm-3">
            <div class="card p-0 card-primary col-md-8 mx-auto">
                <div class="card-header">
                    <h3 class="card-title"> بررسی درخواست تسویه</h3>
                </div>
                @if(session()->exists('status'))
                    <div class="alert alert-danger col-md-11 mx-auto mt-2 mb-0" role="alert" id="alertAddCategory">
                        موجودی کاربر برای تسویه کافی نیست و به سقف عدم موجودی میرسد
                    </div>
                @endif

            <!-- /.card-header -->
                <!-- form start -->
                <form class="mt-3 p-2" action="{{route('settlement.update',$settlement->id)}}" method="post">
                    @csrf

                    {{--<div class="form-group">
                        <label for="transaction_id">کد پیگیری پرداخت</label>
                        <input type="text" name='transaction_id' class="form-control" id="transaction_id"
                               placeholder="" value="{{old('transaction_id',$settlement->transaction_id)}} " >
                        @error('transaction_id')
                        <div class="invalid">
                            <p class="text-danger" style="font-size: 0.8rem;padding-right: 0.2rem">{{$message}}</p>
                        </div>
                        @enderror
                    </div>--}}

                    <div class="form-group">
                        <label for="cart">شماره شبا</label>
                        <input type="text" name='cart_number' class="form-control" id="cart"
                                value="{{ $settlement->cart_number }}" required>
                        @error('cart')
                        <div class="invalid">
                            <p class="text-danger" style="font-size: 0.8rem;padding-right: 0.2rem">{{$message}}</p>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">مبلغ درخواستی</label>
                        <input type="text" name='' class="form-control" id=""
                               placeholder="" value="{{old('amount',$settlement->amount)}}" readonly>
                        @error('amount')
                        <div class="invalid">
                            <p class="text-danger" style="font-size: 0.8rem;padding-right: 0.2rem">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">وضعیت تسویه</label>
                        <select class="form-control" name="status" id="status">
                            <option value="{{\CMS\Settlement\Models\Settlement::STATUS_PENDING}}" @if($settlement->status == \CMS\Settlement\Models\Settlement::STATUS_PENDING) selected @endif>@lang(\CMS\Settlement\Models\Settlement::STATUS_PENDING)</option>
                            <option value="{{\CMS\Settlement\Models\Settlement::STATUS_SETTLED}}" @if($settlement->status == \CMS\Settlement\Models\Settlement::STATUS_SETTLED) selected @endif>@lang(\CMS\Settlement\Models\Settlement::STATUS_SETTLED)</option>
                            <option value="{{\CMS\Settlement\Models\Settlement::STATUS_REJECTED}}" @if($settlement->status == \CMS\Settlement\Models\Settlement::STATUS_REJECTED) selected @endif>@lang(\CMS\Settlement\Models\Settlement::STATUS_REJECTED)</option>
                            <option value="{{\CMS\Settlement\Models\Settlement::STATUS_CANCELED}}" @if($settlement->status == \CMS\Settlement\Models\Settlement::STATUS_CANCELED) selected @endif>@lang(\CMS\Settlement\Models\Settlement::STATUS_CANCELED)</option>
                        </select>
                        @error('status')
                        <div class="invalid">
                            <p class="text-danger" style="font-size: 0.8rem;padding-right: 0.2rem">{{$message}}</p>
                        </div>
                        @enderror
                    </div>


                    <div class="row mt-4 ">
                        <div class="col-sm-6 col-12">
                            <input type="text" class="form-control" disabled value="موجودی باقیمانده شخص : ({{$settlement->user->amount}}) تومان">
                        </div>
                    </div>

                    <button type="submit" class="btn-blue btn-block mt-3">ویرایش و ثبت</button>
            </form>
            </div>
        </section>
    </x-slot>
    @if(session()->get('status') == 'NotAllowedToSettlementRequest')
        <x-slot name="linkScript">
            <script>
                Swal.fire({
                    icon: 'error',
                    text: 'موجودی کاربر برای تسویه کافی نیست و به سقف عدم موجودی میرسد',
                })
            </script>
        </x-slot>
    @endif

</x-admin-panel-layout>
