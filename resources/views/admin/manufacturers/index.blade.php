@extends('layouts.admin')

@section('content')


    <div class="center-block flex-centered">

        <div class="auto-margin" id="manufacturersContainer">

            <modal-background v-if="showModalBackground"></modal-background>
            <popup-menu v-show="showPopupMenu"></popup-menu>

        <h1 class="bg-danger text-center">Manufacturers</h1>

        <ul class="list list-manufacturers" @click="drawMenu">
            @foreach($manufacturers as $manufacturer)

                <li data-manufacturer-id="<?= $manufacturer->id ?>" class="admin-manufacturer-menu__item">
                    <span class="admin-manufacturer-menu__item-text"><?= $manufacturer->title ?></span>
                </li>

            @endforeach
        </ul>

        </div>
    </div>

    <script src="{{ mix('js/admin/manufacturers.js') }}"></script>
@endsection
