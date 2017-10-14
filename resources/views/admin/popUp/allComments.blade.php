<a href="/admin/comments/<?= $_POST['id'] ?>/edit">Update</a>


<form id="commentPublishForm" action ="/admin/comments/<?= $_POST['id'] ?>/publish"  method="POST">

    {{ csrf_field() }}
    <button type="button" class="button-link" id="commentPublishBtn"  data-comment-id="<?= $_POST['id'] ?>">Publish</button>
</form>

<form id="commentUnpublishForm" action ="/admin/comments/<?= $_POST['id'] ?>/unpublish"  method="POST">

    {{ csrf_field() }}
    <button type="button" class="button-link" id="commentUnpublishBtn"  data-comment-id="<?= $_POST['id'] ?>">Unpublish</button>
</form>

<form id="commentDeleteForm" action ="/admin/comments/<?= $_POST['id'] ?>"  method="POST">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="button" class="button-link" id="commentDeleteBtn" @click="showModalWindow" data-comment-id="<?= $_POST['id'] ?>">Delete</button>
</form>


