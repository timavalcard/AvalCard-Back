@includeIf(config("theme.theme_header_path"))
<div class="main-content">
    <div class="container">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    </div>
    @yield("content")
</div>


@includeIf(config("theme.theme_footer_path"))
