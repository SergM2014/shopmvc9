<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title text-danger text-center" id="myModalLabel">@lang('messages.busketContent')</h4>
</div>

@if($content)

    <div class="modal-body" >

        {{ csrf_field() }}

       <?php $tableCounter = 1; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>#</th><th>@lang('messages.title')</th><th>@lang('messages.amount')</th><th>@lang('messages.price')</th>
                </tr>
            @foreach($content as $product)

                <tr>
                    <td><?=  $tableCounter++  ?></td>
                    <td>{{$product->title}}</td>
                    <td class="form-group">
                        <div  class="">
                            <input type="text"  class="form-control busketInputs"
                                   data-id="{{ $product->id }}" value ="{{ session('busketContent')[$product->id ] }}"  >

                        </div>
                    </td>
                    <td>{{ $product->price }}</td>
                </tr>

            @endforeach

                <tr class="text-danger">
                    <td colspan="2"></td><td>@lang('messages.totalAmount'): <?= session('totalAmount')?? 0 ?></td><td>@lang('messages.totalPrice'): <?= session('totalSumma')?? 0 ?></td>
                </tr>
            </table>
        </div>



    </div>
    <div class="modal-footer" id="bigBusketFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        <button type="button" class="btn btn-primary" id="updateBusketBtn">@lang('messages.update')</button>
        <button type="button" class="btn btn-danger" id="makeOrder">@lang('messages.makeOrder')</button>
    </div>

@else

    <h2 class="text-center text-danger">@lang('messages.busketEmpty')</h2>
</div>
@endif