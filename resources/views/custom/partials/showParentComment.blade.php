<div class="parent_comment">
    <div class="close_parent_comment-container"><img id="closeParentComment" class="close_parent_comment" src="/img/small-close.png"  ></div>
    <h2 class="text-center alert-info">Comment to responde</h2>

        <div class="parent_comment-block">
            Name: {{ $comment->name }}
            <br>
            Added at: {{ $comment->created_at }}
            @if($comment->avatar)
                 <img src="/uploads/avatars/{{ $comment->avatar}}" alt="">
            @endif
        </div>



    <div class="parent_comment-block">
        {{ $comment->comment }}
    </div>

</div>