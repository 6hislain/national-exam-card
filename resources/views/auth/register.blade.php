@extends('layouts.default')
@section('content')
    <div class='d-flex justify-content-center align-items-center'>
        <div class='text-center w-30'>
            <form action='#' method='post' class='my-3'>
                <h2 class='mb-3'>{{ __('Register') }}</h2>
                @include('components.message')
                <input class='form-control mb-3' name='name' placeholder='full names' value='{{ old('name') }}' />
                <input class='form-control mb-3' name='email' type='email' placeholder='my@email.com'
                    value='{{ old('email') }}' />
                <input class='form-control mb-3' name='password' type='password' placeholder="password"
                    value='{{ old('password') }}' />
                <input class='form-control mb-3' name='password_confirmation' type='password' placeholder="confirm password"
                    value='{{ old('password_confirmation') }}' />
                @csrf
                <button type='submit' class='btn btn-primary rounded-pill w-10'>{{ __('Submit') }}</button>
            </form>
        </div>
    </div>
@endsection
