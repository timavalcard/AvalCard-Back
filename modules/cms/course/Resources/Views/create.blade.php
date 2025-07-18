<x-admin-panel-layout>
    <x-slot name="title">
        ایجاد دوره
    </x-slot>
    <x-slot name="main">
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">ایجاد دوره</p>
            <form action="{{ route('courses.store') }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ request()->course_type??"video" }}" name="course_type">
                <x-input name="title" placeholder="عنوان دوره" type="text" required/>
                <x-input type="text" name="slug" placeholder="نام انگلیسی دوره" class="text-left" required />


                <div class="d-flex multi-text">
                    <x-input type="text" class="text-left mlg-15" name="priority" placeholder="ردیف دوره" />
                    <x-input type="text" placeholder="مبلغ دوره" name="price" class="text-left" required />
                    <x-input type="number" placeholder="درصد مدرس" name="percent" class="text-left" required />
                </div>
                <x-select name="teacher_id">
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" @if($teacher->id == old('teacher_id')) selected @endif>{{ $teacher->name }}</option>
                    @endforeach
                </x-select>

                <x-select name="type" required>
                    <option value="">نوع دوره</option>
                    @foreach(\CMS\Course\Models\Course::$types as $type)
                        <option value="{{ $type }}"
                                @if($type == old('type')) selected @endif
                        >@lang($type)</option>
                    @endforeach
                </x-select>

                <x-select name="status" required>
                    <option value="">وضعیت دوره</option>
                    @foreach(\CMS\Course\Models\Course::$statuses as $status)
                        <option value="{{ $status }}"
                                @if($status == old('status')) selected @endif
                        >@lang($status)</option>
                    @endforeach
                </x-select>

                <x-select name="category_id">
                    <option value="">دسته بندی</option>
                    @foreach($categories  as $category)
                        <option value="{{ $category->id }}"
                                @if($category->id == old('category_id')) selected @endif
                        >{{ $category->title }}</option>
                    @endforeach
                </x-select>

                <x-file placeholder="آپلود بنر دوره" name="image" required />
                <x-text-area placeholder="توضیحات دوره" name="body" />
                <br>
                <button class="btn btn-cafeamooz">ایجاد دوره</button>
            </form>
        </div>
    </div>
    </x-slot>
    @push('admin-scripts')
        <script src="/panel/js/tagsInput.js?v=12"></script>
    @endpush
</x-admin-panel-layout>

