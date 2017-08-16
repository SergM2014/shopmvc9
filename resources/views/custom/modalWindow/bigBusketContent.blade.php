<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title text-danger text-center" id="myModalLabel">Busket Content</h4>
</div>

@if($content)

    <div class="modal-body" >

        {{ csrf_field() }}

       <?php $tableCounter = 1; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>#</th><th>Title</th><th>Amount</th><th>Price</th>
                </tr>
            @foreach($content as $product)

                <tr>
                    <td><?=  $tableCounter++  ?></td>
                    <td>{{$product->title}}</td>
                    <td class="form-group">
                        <div  class="">
                            {{--<input type="text" id="id_{{ $product->id }}" class="form-control"--}}
                                      {{--name="{{ $product->id }}" value ="{{ session('busketContent')[$product->id ] }}"  >--}}
                            <input type="text"  class="form-control busketInputs"
                                   data-id="{{ $product->id }}" value ="{{ session('busketContent')[$product->id ] }}" :v-model = "model" >
                        </div>
                    </td>
                    <td>{{ $product->price }}</td>
                </tr>

            @endforeach

                <tr class="text-danger">
                    <td colspan="2"></td><td>total amount: <?= session('totalAmount')?? 0 ?></td><td>Total Price: <?= session('totalSumma')?? 0 ?></td>
                </tr>
            </table>
        </div>



    </div>
    <div class="modal-footer" id="bigBusketFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="updateBusketBtn">Update</button>
        <button type="button" class="btn btn-danger" id="makeOrder">Make Order</button>
    </div>

@else

    <h2 class="text-center text-danger"> Nothing is found</h2>
</div>
@endif