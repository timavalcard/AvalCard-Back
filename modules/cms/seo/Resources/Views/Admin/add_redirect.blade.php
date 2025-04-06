<x-admin-panel-layout>
    <x-slot name="title">
        افزودن تغییر مسیر
    </x-slot>
    <x-slot name="main">
    <form action="{{ route("admin_seo_redirect_add")}}" method="post" class="w-100"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-9"><h3>افزودن تغییر مسیر</h3> @csrf

                <p><input type="text" required placeholder="لینک را وارد کنید" name="redirect_from"
                          value="{{ old("redirect_from") }}"></p>
                <p><input type="text" required placeholder="به چه لینکی تغییر مسیر شود؟" name="redirect_to"
                          value="{{ old("redirect_to") }}"></p>
                <p>
                    <select name="status_code" id="" required>
                        <option value="">نوع ریدایرکت</option>
                        <option value="301">301</option>
                        <option value="302">302</option>
                    </select>
                </p>
            </div>
            <div class="col-lg-3">


            </div>
        </div>
        <p>
            <button class="btn-blue">افزودن</button>
        </p>
    </form>

</x-slot>
</x-admin-panel-layout>

