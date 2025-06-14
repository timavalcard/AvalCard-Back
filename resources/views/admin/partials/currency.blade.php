@php
    $value = $value ?? null;
@endphp

<select name="{{ $name }}">
    <option value="137203" {{ ($value == '137203' || (empty($value))) ? 'selected' : '' }}>دلار آمریکا </option>
    @if(!empty($select_by_user))
        <option value="user_select" {{ $value == 'user_select' ? 'selected' : '' }}>انتخاب توسط کاربر</option>
    @endif
    <option value="137220" {{ $value == '137220'? 'selected' : '' }}>دلار کانادا</option>
    <option value="137225" {{ $value == '137225'? 'selected' : '' }}>دلار هنگ کنگ</option>
    <option value="137219" {{ $value == '137219'? 'selected' : '' }}>دلار استرالیا</option>
    <option value="137206" {{ $value == '137206' ? 'selected' : '' }}>پوند انگلیس </option>
    <option value="137204" {{ $value == '137204' ? 'selected' : '' }}>یورو </option>
    <option value="137205" {{ $value == '137205'? 'selected' : '' }}>درهم امارات</option>
    <option value="520837" {{ $value == '520837'? 'selected' : '' }}>رئال برزیل</option>
    <option value="137209" {{ $value == '137209' ? 'selected' : '' }}>ین ژاپن </option>
    <option value="137221" {{ $value == '137221' ? 'selected' : '' }}>یوان چین </option>
    <option value="137224" {{ $value == '137224' ? 'selected' : '' }}>لیر ترکیه</option>
    <option value="137227" {{ $value == '137227' ? 'selected' : '' }}>روپیه هند </option>
    <option value="137211" {{ $value == '137211' ? 'selected' : '' }}>دینار کویت</option>
    <option value="520841" {{ $value == '520841' ? 'selected' : '' }}>پزوی آرژانتین</option>
    <option value="520846" {{ $value == '520846' ? 'selected' : '' }}>هریونیا اوکراین</option>
    <option value="520835" {{ $value == '520835' ? 'selected' : '' }}>پزوی مکزیک</option>
</select>
