<a href="/admin/categories/create">Create New</a>
<br>
<a href="/admin/categories/<?= $_POST['id'] ?>/edit">Update</a>
<br>
<form id="categoryDeleteForm" action ="/admin/categories/<?= $_POST['id'] ?>"  method="POST">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="button" class="button-link" id="categoryDeleteBtn" @click="showModalWindow">Delete</button>
</form>


