<div class="post-item-review-content">
    @foreach($comments as $comment)
    <div class="post-item-review-content-item">
        <div class="post-item-review-content-item-top">
            <div class="post-item-review-content-item-top-right">
                <img @if(is_object($comment->user)) data-src="{{ $comment->user->profile_avatar }}" @else data-src="{{ theme_asset("img/user_avatar.png") }}" @endif>
               <div class="post-item-review-content-item-top-right-right">
                    <span>{{ $comment->name }}</span>
                    <div class="">
                       <span>
                           {{ toShamsi($comment->created_at) }}
                       </span>
                    </div>
                </div>
            </div>


        </div>
        <div class="post-item-review-content-item-bottom">
            <p>{!!   $comment->text  !!}</p>
        </div>


    </div>
        @foreach($comment->children as $child_comment)

            <div class="comment_children_box">
                <div class="post-item-review-content-item">
                    <div class="post-item-review-content-item-top">
                        <div class="post-item-review-content-item-top-right">
                            <img  data-src="{{ theme_asset("img/logo.png") }}" >
                            <div class="post-item-review-content-item-top-right-right">
                                <span>@if(is_object($child_comment->user)){{ $child_comment->user->name }}@endif</span>
                                <div class="">
                       <span>
                           {{ toShamsi($child_comment->created_at) }}
                       </span>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="post-item-review-content-item-bottom">
                        <p>{!!   $child_comment->text  !!}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>
