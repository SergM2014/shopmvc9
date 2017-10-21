
@extends('layouts.admin')

@section('content')



<div class="clearfix" id="addCommentBlock">
    <h1 class="text-center alert-danger">Edit Comment</h1>
    <div id="parentCommentBlock" class="parent_comment_block">

    </div>

    @include('custom.partials.addImage')

    <form id="productCommentForm" action="/admin/comments/{{ $comment->id }}" method="post">

        <input type="hidden" name="imagesData" id="imagesData" >
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $comment->name ?>">
            <span id="nameHelpBlock" class="help-block"></span>
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $comment->email ?>">
            <span id="emailHelpBlock" class="help-block"></span>
        </div>



        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea class="form-control" id="comment" placeholder="comment" name="comment" rows="5"><?= $comment->comment ?></textarea>
            <span id="commentHelpBlock" class="help-block"></span>
        </div>



        <button type="submit" id="productCommentSubmit" class="btn btn-default" @click="makeComment">Submit</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>

<script src="{{ mix('js/admin/updateComment.js') }}"></script>

@endsection
