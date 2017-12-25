<section class="row" id="orderForm">
    <h2 class="text-danger text-center">@lang('messages.makeOrder')</h2>

    <div class="col-sm-8 col-sm-offset-2">
        <div class="form-group">
            <label for="name">@lang('messages.yourName'): </label>
            <input type="text" class="form-control" id="name" name="name"  placeholder="@lang('messages.yourName')">
            <span id="nameHelpBlock" class="help-block"></span>
        </div>

        <div class="form-group">
            <label for="phone">@lang('messages.yourPhone'): </label>
            <input type="text" class="form-control" id="phone" name="phone"  placeholder="@lang('messages.yourPhone')">
            <span id="phoneHelpBlock" class="help-block"></span>
        </div>

        <div class="form-group">
            <label for="email">@lang('messages.yourEmail'): </label>
            <input type="text" class="form-control" id="email" name="email"  placeholder="@lang('messages.yourEmail')">
            <span id="emailHelpBlock" class="help-block"></span>
        </div>



        <div class="modal-footer" id="orderFormFooter">
            <button type="button" class="btn btn-danger" id="canselOrder">@lang('messages.cansel')</button>
            <span type="button" class="btn btn-default" id="submitOrder">@lang('messages.submit')</span>

        </div>
    </div>

</section>