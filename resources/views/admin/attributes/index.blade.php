@extends('admin.layouts.master')

@section('title', 'Quản lý thuộc tính')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý thuộc tính</h2>
        <a href="{{ route('admin.attributes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm thuộc tính
        </a>
    </div>

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
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Tên hiển thị</th>
                            <th>Số giá trị</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attributes as $attribute)
                        <tr>
                            <td>{{ $attribute->id }}</td>
                            <td>{{ $attribute->name }}</td>
                            <td>{{ $attribute->display_name }}</td>
                            <td>{{ $attribute->values_count }}</td>
                            <td>{{ $attribute->position }}</td>
                            <td>
                                <span class="badge bg-{{ $attribute->is_active ? 'success' : 'danger' }}">
                                    {{ $attribute->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.attributes.values.index', $attribute) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-list"></i> Giá trị
                                </a>
                                <a href="{{ route('admin.attributes.edit', $attribute) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.attributes.destroy', $attribute) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $attributes->links() }}
        </div>
    </div>
</div>
@endsection
