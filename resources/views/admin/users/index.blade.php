@extends('layouts.admin')

@section('content')

    <div class="center-block flex-centered">

        <div class="auto-margin" id="usersContainer">

            <modal-background v-if="showModalBackground"></modal-background>
            <popup-menu v-show="showPopupMenu"></popup-menu>

            <h1 class="bg-danger text-center">Users</h1>

            <ul class="list list-users" @click="drawMenu">
                @foreach($users as $user)

                    <li data-user-id="<?= $user->id ?>" class="admin-user-menu__item">
                        <span class="admin-user-menu__item-text"><?= $user->name ?></span>
                    </li>

                @endforeach
            </ul>

        </div>
    </div>


    <script src="{{ mix('js/admin/users.js') }}"></script>
@endsection