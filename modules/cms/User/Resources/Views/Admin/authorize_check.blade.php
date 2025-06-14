<x-admin-panel-layout>
    <x-slot name="title">
         درخواست  احراز هویت
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">         درخواست احراز هویت</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item active">        لیست درخواست های احراز هویت</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    اطلاعات کاربر
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                            $fields = [
                                'نام' => $user->authorize_name,
                                'نام خانوادگی' => $user->authorize_last_name,
                                'کد ملی' => $user->authorize_national_code,
                                'شماره موبایل' => $user->authorize_phone,
                                'سال تولد' => $user->authorize_year,
                                'ماه تولد' => $user->authorize_month,
                                'روز تولد' => $user->authorize_day,
                                'شهر' => $user->authorize_city,
                                'استان' => $user->authorize_state,
                                'کد پستی' => $user->authorize_postal_code,
                                'تلفن ثابت' => $user->authorize_static_phone,
                                'آدرس' => $user->authorize_address,
                            ];
                        @endphp

                        @foreach($fields as $label => $value)
                            <div class="col-md-6 mb-3">
                                <strong>{{ $label }}:</strong> {{ $value }}
                            </div>
                        @endforeach

                        <div class="col-md-6 mb-3">
                            <strong>کارت ملی:</strong><br>
                            @if($user->authorize_national_cart_image)
                                <a href="{{ $user->authorize_national_cart_image }}" class="btn btn-outline-primary btn-sm mt-2" download>
                                    <img src="{{$user->authorize_national_cart_image}}" style="width: 250px;" alt="">

                                </a>
                            @else
                                <span class="text-muted">ثبت نشده</span>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>عکس سلفی:</strong><br>
                            @if($user->authorize_self_image)
                                <a href="{{ $user->authorize_self_image }}" class="btn btn-outline-primary btn-sm mt-2" download>
                                    <img src="{{$user->authorize_self_image}}" style="width: 250px;" alt="">

                                </a>
                            @else
                                <span class="text-muted">ثبت نشده</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <form method="POST" action="{{ route('authorize_accept', $user->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">پذیرش</button>
                        </form>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#declineModal">
                            رد کردن
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Modal -->
        <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <i class="fa fa-times" style="
    color: #fff;
    font-size: 24px;
    margin-bottom: 15px;
"></i>
                <form method="POST" action="{{ route('authorize_decline', $user->id) }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="declineModalLabel">دلیل رد شدن</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="reason" class="form-label">دلیل رد شدن را وارد کنید:</label>
                                <textarea style="
    background: #f6f6f6;
" class="form-control" name="reason" id="reason" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">ثبت دلیل رد شدن</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var declineButton = document.querySelector('[data-bs-target="#declineModal"]');
                var declineModal = new bootstrap.Modal(document.getElementById('declineModal'));

                declineButton.addEventListener('click', function () {
                    declineModal.show();
                });
                document.getElementById('closeModalBtn').addEventListener('click', function () {
                    var modalEl = document.getElementById('declineModal');
                    var modalInstance = bootstrap.Modal.getInstance(modalEl);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                });
            });
        </script>

    </x-slot>
</x-admin-panel-layout>
