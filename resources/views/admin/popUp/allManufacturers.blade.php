<a href="/admin/manufacturers/create">Create New</a>
<br>
<a href="/admin/manufacturers/<?= $_POST['id'] ?>/edit">Update</a>
<br>
<form id="manufacturerDeleteForm" action ="/admin/manufacturers/<?= $_POST['id'] ?>"  method="POST">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="button" class="button-link" id="manufacturerDeleteBtn" @click="showModalWindow" data-manufacturer-id="<?= $_POST['id'] ?>">Delete</button>
</form>


