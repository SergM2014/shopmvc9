<section class="row" id="orderForm">
    <h2 class="text-danger text-center">Make Order</h2>

    <div class="col-sm-8 col-sm-offset-2">
        <div class="form-group">
            <label for="name">Your name: </label>
            <input type="text" class="form-control" id="name" name="name"  placeholder="name">
            <span id="nameHelpBlock" class="help-block"></span>
        </div>

        <div class="form-group">
            <label for="phone">Your Phone: </label>
            <input type="text" class="form-control" id="phone" name="phone"  placeholder="phone">
            <span id="phoneHelpBlock" class="help-block"></span>
        </div>

        <div class="form-group">
            <label for="email">Your Email: </label>
            <input type="text" class="form-control" id="email" name="email"  placeholder="email">
            <span id="emailHelpBlock" class="help-block"></span>
        </div>



        <div class="modal-footer" id="orderFormFooter">
            <button type="button" class="btn btn-danger" id="canselOrder">Cansel</button>
            <span type="button" class="btn btn-default" id="submitOrder">Submit</span>

        </div>
    </div>

</section>