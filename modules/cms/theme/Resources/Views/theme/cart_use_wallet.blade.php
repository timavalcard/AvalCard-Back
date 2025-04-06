@if($wallet && !session()->get("wallet"))
    <a href="{{ route("wallet.use") }}" class="btn red-btn btn-sm mr-3">استفاده از کیف پول</a>

@endif

@if(session()->get("wallet"))
    <a href="{{ route("wallet.cancel_use") }}" class="btn red-btn btn-sm mr-3">لفو استفاده از کیف پول</a>

@endif 
