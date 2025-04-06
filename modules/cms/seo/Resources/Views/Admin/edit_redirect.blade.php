<x-admin-panel-layout>
    <x-slot name="title">
        ویرایش تغییر مسیر
    </x-slot>
    <x-slot name="main">
    <form action="{{ route("admin_seo_redirect_edit",$redirect->id)}}" method="post" class="w-100"
          enctype="multipart/form-data">
        @csrf
        @method("put")
        <div class="row">
            <div class="col-lg-9"><h3>ویرایش تغییر مسیر</h3>

                <p><input type="text" required placeholder="لینک را وارد کنید" name="redirect_from"
                          value="{{ $redirect->redirect_from }}"></p>
                <p><input type="text" required placeholder="به چه لینکی تغییر مسیر شود؟" name="redirect_to"
                          value="{{ $redirect->redirect_to }}"></p>
                <p>
                    <select name="status_code" id="" required>
                        <option value="">نوع ریدایرکت</option>
                        <option value="301" @if($redirect->status_code==301) selected @endif>301</option>
                        <option value="302" @if($redirect->status_code==302) selected @endif>302</option>
                    </select>
                </p>
            </div>
            <div class="col-lg-3">


            </div>
        </div>
        <p>
            <button class="btn-blue">بروزرسانی</button>
        </p>
    </form>

</x-slot>
</x-admin-panel-layout>

