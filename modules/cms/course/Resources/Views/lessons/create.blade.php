<x-admin-panel-layout>
    <x-slot name="title">
        ایجاد جلسه جدید
    </x-slot>
    <x-slot name="main">
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">ایجاد جلسه جدید</p>
            <form action="{{ route('lessons.store', $course->id) }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                <x-input name="title" placeholder="عنوان درس *" type="text" required/>
                <x-input type="text" name="slug" placeholder="نام انگلیسی درس اختیاری" class="text-left" />
                <x-input type="number" name="time" placeholder="مدت زمان جلسه *" class="text-left" required />
                <x-input type="number" name="number" placeholder="شماره جلسه" class="text-left"/>
                <x-input type="number" name="price" required="required" placeholder="مبلغ جلسه" class="text-left"/>

                @if(count($seasons))
                    <x-select name="season_id" required>
                        <option value="">انتخاب سرفصل درس *</option>
                        @foreach($seasons as $season)
                        <option value="{{ $season->id }}" @if($season->id == old('season_id')) selected @endif>{{ $season->title }}</option>
                        @endforeach
                    </x-select>
                @endif

                <div class="w-50">
                    <p class="box__title">ایا این درس رایگان است ؟ * </p>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-1" name="is_free" value="0" type="radio" checked="">
                        <label for="lesson-upload-field-1">خیر</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-2" name="is_free" value="1" type="radio">
                        <label for="lesson-upload-field-2">بله</label>
                    </div>
                </div>
                <x-file placeholder="آپلود درس *" name="lesson_file" required />
                <x-text-area placeholder="توضیحات درس" name="body" />
                <br>
                <button class="btn btn-cafeamooz">ایجاد درس</button>
            </form>
        </div>
    </div>
    </x-slot>
</x-admin-panel-layout>
