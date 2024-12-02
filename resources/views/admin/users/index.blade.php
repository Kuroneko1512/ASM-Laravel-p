@extends('admin.layouts.master')

@section('title', 'Users Management')

@section('content')

    @session('success')
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endsession

    @session('error')
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endsession

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Quản lý tài khoản</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Vai trò</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->fullname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-info' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $user->active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $user->active ? 'Active' : 'Banned' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->role !== 'admin' && $user->id !== auth()->id())
                                            <form action="{{ route('admin.users.toggle', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" 
                                                    class="btn btn-sm {{ $user->active ? 'btn-danger' : 'btn-success' }}">
                                                    {{ $user->active ? 'Ban' : 'Activate' }}
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
