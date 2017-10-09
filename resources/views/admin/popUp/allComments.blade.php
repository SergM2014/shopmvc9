<a href="/admin/comments/create">Create New</a>
<br>
<a href="/admin/comments/<?= $_POST['id'] ?>/edit">Update</a>
<br>
<form id="commentDeleteForm" action ="/admin/comments/<?= $_POST['id'] ?>"  method="POST">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="button" class="button-link" id="commentDeleteBtn" @click="showModalWindow" data-comment-id="<?= $_POST['id'] ?>">Delete</button>
</form>


