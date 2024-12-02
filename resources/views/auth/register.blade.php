@extends('client.layouts.master')

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Đăng Ký') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('postRegister') }}">
                            @csrf

                            <div class="form-group">
                                <label for="fullname">{{ __('Họ Tên') }}</label>
                                <input id="fullname" type="text" class="form-control" name="fullname" value="{{ old('fullname') }}">
                                @error('fullname')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="username">{{ __('Tên Tài Khoản') }}</label>
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">
                                @error('username')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Mật khẩu') }}</label>
                                <input id="password" type="password" class="form-control" name="password" >
                                @error('password')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Nhập Lại Mật khẩu') }}</label>
                                <input id="password" type="password" class="form-control" name="password_confirm" >
                                @error('password_confirm')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Đăng Ký') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
