@extends('layouts.admin')

@section('content')


    <div class="center-block flex-centered">

        <form action="/admin/users" method="POST" class="auto-margin" >


            <h1 class="bg-danger text-center">Create User</h1>

            {{ csrf_field() }}


            <div class="form-group">
                <label for="name" class="text-warning">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Put a name" value="<?= old('name') ?>">
                @if($errors->has('name'))
                    <span class=" text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="email" class="text-warning">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= old('email') ?>">
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

            <div class="form-group">
                <label for="role" class="text-warning">Role</label>


                <select class="form-control" name="role" id="role">
                    <option value="user" <?= old('role')== 'user'? 'selected': '' ?> >user</option>
                    <option value="admin" <?= old('role')== 'admin'? 'selected': '' ?> >admin</option>
                    <option value="superadmin" <?= old('role')== 'superadmin'? 'selected': '' ?>>superadmin</option>

                </select>

                @if($errors->has('role'))
                    <span class=" text-danger">{{ $errors->first('role') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-default">Create</button>

        </form>
    </div>



@endsection