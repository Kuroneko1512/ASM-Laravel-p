@extends('client.layouts.master')

@section('title', 'Cập Nhật Thông Tin Cá Nhân')
@section('contents')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Cập nhật thông tin cá nhân</h3>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Avatar Preview Section -->
                            <div class="text-center mb-4">
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar"
                                        class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Ảnh đại diện</label>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                </div>
                                @error('avatar')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="fullname" class="form-label">Họ tên</label>
                                <input type="text" class="form-control" id="fullname" name="fullname"
                                    value="{{ $user->fullname }}" >
                                @error('fullname')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Tên tài khoản</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ $user->username }}" >
                                @error('username')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" >
                                @error('email')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 text-center">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Quay lại Dashboard</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
