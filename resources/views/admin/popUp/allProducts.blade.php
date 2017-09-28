<a href="/admin/products/<?= $_POST['id'] ?>">Show</a>
<br>
<a href="/admin/products/<?= $_POST['id'] ?>/edit">Update</a>
<br>
<form id="productDeleteForm" action ="/admin/products/<?= $_POST['id'] ?>"  method="POST">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="button" class="button-link" id="productDeleteBtn" @click="showModalWindow">Delete</button>
</form>


