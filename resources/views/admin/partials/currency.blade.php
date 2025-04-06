@php $value = $value ?? null; @endphp
<select  name="{{ $name }}" >
    <option value="irr" {{ ($value == 'irr' || empty($value)) ? 'selected' : '' }}>تومان ایران (IRR)</option>
    <option value="usd" {{ $value == 'usd' ? 'selected' : '' }}>دلار آمریکا (USD)</option>
    <option value="eur" {{ $value == 'eur' ? 'selected' : '' }}>یورو (EUR)</option>
    <option value="gbp" {{ $value == 'gbp' ? 'selected' : '' }}>پوند انگلیس (GBP)</option>
    <option value="jpy" {{ $value == 'jpy' ? 'selected' : '' }}>ین ژاپن (JPY)</option>
    <option value="cny" {{ $value == 'cny' ? 'selected' : '' }}>یوان چین (CNY)</option>
    <option value="inr" {{ $value == 'inr' ? 'selected' : '' }}>روپیه هند (INR)</option>

</select>
