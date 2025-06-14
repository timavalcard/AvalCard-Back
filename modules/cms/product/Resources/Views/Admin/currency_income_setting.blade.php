
<x-admin-panel-layout>
    <x-slot name="title">
        ویرایش کارمزد
    </x-slot>
    <x-slot name="main">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-dark">        ویرایش کارمزد</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                            <li class="breadcrumb-item active">        ویرایش کارمزد</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin_currency_income_setting') }}" class="p-4 bg-white rounded shadow-sm">
            @csrf

            <h3 class="mb-4 text-lg font-semibold">فرم کارمزد نقد کردن درآمد</h3>

            {{-- کارمزد پایه --}}
            <div class="mb-4">
                <label for="base_fee" class="block mb-1 font-medium">کارمزد پایه (٪)</label>
                <input
                    type="number"
                    name="base_fee"
                    id="base_fee"
                    class="w-full border rounded px-3 py-2"
                    value="{{ old('base_fee', $setting['base_fee'] ?? '') }}"
                    required>
            </div>

            {{-- شرط اول --}}
            <div class="mt-5 mb-5">
                <label class="block mb-1 font-medium">اگر بیشتر از مبلغ (تومان):</label>
                <input
                    type="number"
                    name="threshold_1_amount"
                    class="w-full border rounded px-3 py-2"
                    value="{{ old('threshold_1_amount', $setting['thresholds'][0]['amount'] ?? '') }}"
                    placeholder="مثلاً 1000000">

                <label class="block mt-2 mb-1 font-medium">کارمزد دوم (٪)</label>
                <input
                    type="number"
                    name="threshold_1_fee"
                    class="w-full border rounded px-3 py-2"
                    value="{{ old('threshold_1_fee', $setting['thresholds'][0]['fee'] ?? '') }}"
                    placeholder="مثلاً 5">
            </div>

            {{-- شرط دوم --}}
            <div class="mt-5 mb-5">
                <label class="block mb-1 font-medium">اگر بیشتر از مبلغ (تومان):</label>
                <input
                    type="number"
                    name="threshold_2_amount"
                    class="w-full border rounded px-3 py-2"
                    value="{{ old('threshold_2_amount', $setting['thresholds'][1]['amount'] ?? '') }}"
                    placeholder="مثلاً 5000000">

                <label class="block mt-2 mb-1 font-medium">کارمزد سوم (٪)</label>
                <input
                    type="number"
                    name="threshold_2_fee"
                    class="w-full border rounded px-3 py-2"
                    value="{{ old('threshold_2_fee', $setting['thresholds'][1]['fee'] ?? '') }}"
                    placeholder="مثلاً 3">
            </div>

            <button type="submit" class="btn btn-primary">
                ذخیره کارمزدها
            </button>
        </form>


    </x-slot>
</x-admin-panel-layout>
