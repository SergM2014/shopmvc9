@extends('layouts.admin')

@section('content')


    <div class="center-block flex-centered">

        <div class="auto-margin" id="categoriesContainer">

            <modal-background v-if="showModalBackground"></modal-background>
            <popup-menu v-show="showPopupMenu"></popup-menu>

            <h1 class="bg-danger text-center">Categories</h1>

            <ul class="list" @click="drawMenu" >
                {!!  $dropDownList !!}
            </ul>

        </div>


    </div>
<script src="{{ mix('js/admin/categories.js') }}"></script>
@endsection

