<a href="/admin/product/<?= $_POST['id'] ?>">Show</a>
<br>
<a href="/admin/product/<?= $_POST['id'] ?>/edit">Update</a>
<br>
<form id="productDeleteForm" action ="/admin/product/<?= $_POST['id'] ?>"  method="POST">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="button" class="button-link" id="productDeleteBtn">Delete</button>
</form>


