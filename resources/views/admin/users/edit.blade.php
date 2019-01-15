@extends('layouts.admin')

@section('content')


    <div class="center-block flex-centered">

        <form action="/admin/users/<?= $user->id ?>" method="POST" class="auto-margin" >


            <h1 class="bg-danger text-center">Edit User</h1>

            {{ method_field('PUT') }}

            {{ csrf_field() }}

            <input type="hidden" name="id" value="<?= $user->id ?>">



            <div class="form-group">
                <label for="Name" class="text-warning">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Put a name"
                       value="{{ old('_token')? old('name'): $user->name }}">
                @if($errors->has('name'))
                    <span class=" text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>


            <div class="form-group">
                <label for="email" class="text-warning">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                       value="{{ old('_token')? old('email'): $user->email }}">
                @if($errors->has('email'))
                    <span class=" text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="password" class="text-warning">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                @if($errors->has('password'))
                    <span class=" text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="text-warning">Repeat Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password">
                @if($errors->has('password_confirmation'))
                    <span class=" text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>


            <?php $role = old('_token')? old('role'): $user->role ?>

            <div class="form-group">
                <label for="role" class="text-warning">Role</label>


                <select class="form-control" name="role" id="role">
                    <option value="user" <?= $role == 'user'? 'selected': '' ?> >user</option>
                    <option value="admin" <?= $role == 'admin'? 'selected': '' ?> >admin</option>
                    <option value="superadmin" <?= $role == 'superadmin'? 'selected': '' ?>>superadmin</option>

                </select>

                @if($errors->has('role'))
                    <span class=" text-danger">{{ $errors->first('role') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-default">update</button>

        </form>
    </div>

@endsection
