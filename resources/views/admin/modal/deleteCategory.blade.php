<div id="modalContent" class="modal-background__content">

    <div class="modal-background__content-body">
        <h1 class="text-center text-danger">
            Are you shure do delete the Category?</h1>
            @if($hasProducts)
                <h2 class="text-center text-danger"> Category has Product!</h2>
            @endif

            @if($hasChildCategories)
                <h2 class="text-center text-danger"> Category has cild categories!</h2>
            @endif


    </div>
    <div class="modal-background__content-footer">
        <button type="button" id="canselBtn" class="confirmBtn btn btn-danger ">Cansel</button>
        <button type="button" id="confirmDeleteCategoryBtn" class="confirmBtn btn btn-success "
        @if($hasProducts OR $hasChildCategories)
            disabled="disabled"
        @endif
        >OK</button>
    </div>

</div>