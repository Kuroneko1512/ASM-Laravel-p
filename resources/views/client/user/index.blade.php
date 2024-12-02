@extends('client.layouts.master')

@section('title', 'Thông Tin Cá Nhân')

@section('contents')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Xin chào, {{ $user->fullname }}</h2>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="text-center mb-4">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="alert alert-info">
                                    Chưa có ảnh đại diện
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-bold">Họ và tên:</label>
                                    <p class="form-control">{{ $user->fullname }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Tên đăng nhập:</label>
                                    <p class="form-control">{{ $user->username }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-bold">Email:</label>
                                    <p class="form-control">{{ $user->email }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Vai trò:</label>
                                    <p class="form-control">{{ $user->role }}</p>
                                </div>
                                {{-- <div class="mb-3">
                                    <label class="fw-bold">Trạng thái:</label>
                                    <span class="badge {{ $user->active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $user->active ? 'Đang hoạt động' : 'Không hoạt động' }}
                                    </span>
                                </div> --}}
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-3 text-center">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Chỉnh sửa thông tin</a>
                            <a href="{{ route('change.password') }}" class="btn btn-secondary">Đổi mật khẩu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
