@extends('layouts.admin')

@section('content')



    <div class="center-block flex-centered">

        <div class="auto-margin" id="commentsContainer">

            <modal-background v-if="showModalBackground"></modal-background>
            <popup-menu v-show="showPopupMenu"></popup-menu>

            <h1 class="bg-danger text-center">Comments</h1>

            <form action = "/admin/comments" method="get" class="form-horizontal">

                <div class="form-group">
                    <label for="order" class="col-sm-2 control-label">Order By:</label>
                    <div class="col-sm-8">
                        <select name="order" id="order" class="form-control">
                            <option value="newFirst">new first</option>
                            <option value="oldFirst">old first</option>
                            <option value="nameAZ">name AZ</option>
                            <option value="nameZA">name ZA</option>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-default">OK</button>
                    </div>

                </div>

            </form>

            <ul class="list"  @click="drawMenu" >

                @foreach ($comments as $comment)

                    <li class='comment_item' data-comment-id="<?= $comment->id ?>">
                        <div class='avatar_comment-block'>
                            <div class="product-area">
                                <h3 class="text-danger"><?= $comment->product ?> </h3>

                            </div>
                            <span class='text-warning'> Name:</span> <?= $comment->name ?><br>

                            <?php $avatarImage = $comment->avatar? "/uploads/avatars/$comment->avatar" : "/img/noavatar.jpg" ?>

                            <img src= <?= $avatarImage ?> alt='' class='comment_avatar'>
                            <br>

                            <span class='text-warning'> Added at: </span> <?= $comment->created_at ?> </div>




                        <div class='text_comment-block'>
                            <?= $comment->comment ?>
                        </div>

                        <div class="published_status">
                            <?= $comment->published == '1' ? '<h4 class="text-success">Published </h4>' :
                                '<h4 class="text-danger">Unpublished </h4>' ?>
                        </div>

                    </li>


                @endforeach

            </ul>
            <nav class="text-center">

                {{ $comments->appends(['order' => request('order')])->links() }}
            </nav>

        </div>


    </div>

    <script src="{{ mix('js/admin/comments.js') }}"></script>
@endsection















