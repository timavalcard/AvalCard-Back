<x-admin-panel-layout>
    <x-slot name="title">
        درخواست تسویه جدید
    </x-slot>
    <x-slot name="main">
        <!-- Checked checkbox -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">ایجاد درخواست تسویه</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            {{--                            <li class="breadcrumb-item"><a href="#">خانه</a></li>--}}
                            <li class="breadcrumb-item">مدیریت پرداخت ها</li>
                            <li class="breadcrumb-item active">ایجاد تسویه جدید</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content mt-sm-3">
            <div class="card p-0 card-primary col-md-8 mx-auto">
                <div class="card-header">
                    <h3 class="card-title">درخواست تسویه</h3>
                </div>
                @if(session()->exists('status'))
                    <div class="alert alert-success col-md-11 mx-auto mt-2" role="alert" id="alertAddCategory">
                        تسویه جدید با موفقیت ایجاد گردید
                    </div>
            @endif

            <!-- /.card-header -->
                <!-- form start -->
                <form class="mt-3 p-2" action="{{route('settlement.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">نام کامل صاحب حساب</label>
                        <input type="text" name='name' class="form-control" id="name"
                               placeholder="" value="{{old('name')}}" required>
                        @error('name')
                        <div class="invalid">
                            <p class="text-danger" style="font-size: 0.8rem;padding-right: 0.2rem">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cart">شماره کارت</label>
                        <input type="text" name='cart' class="form-control" id="cart"
                               placeholder="مانند : 6037989823234545" value="{{old('cart')}}" required>
                        @error('cart')
                        <div class="invalid">
                            <p class="text-danger" style="font-size: 0.8rem;padding-right: 0.2rem">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="shaba">شماره شبا</label>
                        <input type="text" name='shaba' class="form-control" id="shaba"
                               placeholder="مانند : IR0696000000010324200001" value="{{old('shaba')}}" required>
                        @error('shaba')
                        <div class="invalid">
                            <p class="text-danger" style="font-size: 0.8rem;padding-right: 0.2rem">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="amount">مبلغ درخواستی</label>
                        <input type="text" name='amount' class="form-control" id="amount"
                               placeholder="حداقل 100000 تومان" value="{{old('amount')}}" required>
                        @error('amount')
                        <div class="invalid">
                            <p class="text-danger" style="font-size: 0.8rem;padding-right: 0.2rem">{{$message}}</p>
                        </div>
                        @enderror
                    </div>

                    <div class="row mt-4 ">
                        <div class="col-sm-6 col-12">
                            <input type="text" class="form-control" disabled value="موجودی شما : {{auth()->user()->amount}} تومان">
                        </div>
                        <div class="col-sm-6 col-12 mt-1 mt-sm-0">
                            <input type="text" class="form-control" disabled value="واریز تا حداکثر ۳ روز کاری">
                        </div>
                    </div>

                    <button type="submit" class="btn-blue btn-block mt-3">ثبت</button>
            </form>
            </div>
        </section>
    </x-slot>
    @if(session()->get('status') == 'created')
        <x-slot name="linkScript">
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'ایجاد تسویه با موفقیت انجام شد',
                })
            </script>
        </x-slot>
    @endif
</x-admin-panel-layout>
