@auth()
        <div id="respond" class="comment-respond">
            <p>
                میخواهی به بحث بپیوندی؟!  مطمعا باش نشانی ایمیلت منتشر نخواهد شد.
            </p>
            <form action="{{ route("comment.add")  }}" method="post" id="commentform" class="comment-form">
                @csrf
                @if(isset($type) && $type=="product_questions" )
                    <input name="type" type="hidden" value="question"  >

                @else
                    <input name="type" type="hidden" value="comment"  >
                @endif
                <p class="comment-form-comment mt-3">
                    <label for="comment">نظر شما</label>
                    <textarea id="comment" name="text" cols="45" rows="8" maxlength="65525" required="required"></textarea>
                </p>
                <p class="form-submit">
                    <input name="submit" type="submit" id="submit" class="submit" value="ارسال ">
                    <input type="hidden" name="post_id" value="{{ $post_id }}" >
                    <input type="hidden" name="post_type" value="{{ $post_type }}" >
                    <input type="hidden" name="parent_id" value="0" >

                </p>

            </form>
        </div>
    @else
    <div id="respond" class="comment-respond">
        <form action="{{ route("comment.add")  }}" method="post" id="commentform" class="comment-form">
            @csrf
            @if(isset($type) && $type=="product_questions" )
                <input name="type" type="hidden" value="question"  >

            @else
                <input name="type" type="hidden" value="comment"  >
            @endif
            <p class="comment-form-author">
                <label for="name">نام&nbsp;</label>
                <input id="name" name="name" type="text" value="" size="30" required="">
            </p>
            <p class="comment-form-email">
                <label for="email">ایمیل&nbsp;</label>
                <input id="email" name="email" type="email" value="" size="30" required="">
            </p>
            <p class="comment-form-comment">
                <label for="comment">دیدگاه</label>
                <textarea id="comment" name="text" cols="45" rows="8" maxlength="65525" required="required"></textarea>
            </p>

            <p class="form-submit">
                <input name="submit" type="submit" id="submit" class="submit" value="ارسال ">
                <input type="hidden" name="post_id" value="{{ $post_id }}" >
                <input type="hidden" name="post_type" value="{{ $post_type }}" >
                <input type="hidden" name="parent_id" value="0" >

            </p>

        </form>
    </div>
@endif
