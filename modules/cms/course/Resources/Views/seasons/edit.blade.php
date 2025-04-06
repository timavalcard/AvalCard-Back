<x-admin-panel-layout>
    <x-slot name="title">
        بروزرسانی سرفصل
    </x-slot>
    <x-slot name="main">
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی سرفصل</p>
            <form action="{{ route('seasons.update', $season->id) }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <x-input type="text" name="title" placeholder="عنوان سرفصل" class="text" value="{{ $season->title }}" required />
                <x-input type="text" name="number" placeholder="شماره سرفصل" class="text" value="{{ $season->number }}" />
                <br>
                <button class="btn btn-cafeamooz">بروزرسانی سرفصل</button>
            </form>
        </div>
    </div>
    </x-slot>
</x-admin-panel-layout>
