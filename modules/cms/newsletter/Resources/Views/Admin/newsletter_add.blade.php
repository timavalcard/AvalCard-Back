
    <x-admin-panel-layout>
        <x-slot name="title">
            افزودن خبرنامه
        </x-slot>
        <x-slot name="main">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h3 class="m-0 text-dark">خبرنامه تازه</h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("admin_newsletter_list_sent") }}">لیست خبرنامه های ارسال شده</a></li>
                                <li class="breadcrumb-item active">
                                    خبرنامه تازه
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div>
            </div>
    <form action="{{ route("admin_newsletter_add") }}" method="post" class="w-100" enctype="multipart/form-data">

        <div class="row">
            <div class="col-lg-9">
                @csrf
                <input type="hidden" value="{{ auth()->id() }}" name="user_id">
                <p><input type="text" placeholder="نام خبرنامه" name="title" value="{{old("title")}}"></p>
                <div class="admin-metabox-item metabox-close">
                    <div class="admin-metabox-item-title"><h5>محتوای خبرنامه</h5>                        <span
                                class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span></div>
                    <p class="col-12 form-item"><textarea name="contents" id="contents" cols="30" rows="10"></textarea>
                    </p></div>

                <p>
                    <button class="btn-blue">انتشار</button>
                </p>
            </div>
            <div class="col-lg-3">

                <div class="admin-metabox-item metabox-close admin_newsletter_email">
                    <div class="admin-metabox-item-title"><h5>ارسال به</h5>
                        <span class="admin-metabox-item-btn-up"><i class="fa fa-angle-up"></i></span>
                    </div>
                    <div class="col-12 form-item mt-3">
                        <div class="admin-search-box">
                            <label for="">جستجو:</label>
                            <input type="text" class="admin-search-input mb-3">
                        </div>
                    <ul>

                        <li class="mb-3">
                            <input name="send_to[]" type="checkbox" checked value="all">
                            <label class="ml-2">همه</label>

                        </li>
                        @foreach($emails as $email)
                            <li class="mb-3">
                                <input name="send_to[]" type="checkbox" value="{{$email->email }}">
                                <label class="ml-2">{{$email->email }}</label>

                            </li>
                        @endforeach
                    </ul>
                    </div>

                </div>
            </div>
        </div>
    </form>
    @push("admin-scripts")
    <script>
        CKEDITOR.replace('contents');

        CKEDITOR.instances['contents'].setData(`{!! old("contents") !!}`);
    </script>
    <script>
        document.querySelector(".admin-search-input").addEventListener("keyup",function (e) {
            var val= e.target.value;
            $.ajax({
                type : 'get',
                url : '{{ route("admin_newsletter_search") }}',
                data:{'search':val},
                success:function(data){
                    console.log(data)
                    $('.admin_newsletter_email ul').html(data);
                }
            });

        })
    </script>
    @endpush
        </x-slot>
    </x-admin-panel-layout>
