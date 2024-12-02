@extends('admin.layouts.master')

@section('title', 'Giá trị thuộc tính')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Giá trị thuộc tính: {{ $attribute->display_name }}</h2>
        <a href="{{ route('admin.attributes.values.create', $attribute) }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm giá trị
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
                            <th>Giá trị</th>
                            <th>Tên hiển thị</th>
                            <th>Mã màu</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($values as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->value }}</td>
                            <td>{{ $value->display_value }}</td>
                            <td>
                                @if($value->color_code)
                                    <span class="color-preview" style="background-color: {{ $value->color_code }}"></span>
                                    {{ $value->color_code }}
                                @endif
                            </td>
                            <td>{{ $value->position }}</td>
                            <td>
                                <span class="badge bg-{{ $value->is_active ? 'success' : 'danger' }}">
                                    {{ $value->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.attributes.values.edit', [$attribute, $value]) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.attributes.values.destroy', [$attribute, $value]) }}" method="POST" class="d-inline">
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
            {{ $values->links() }}
        </div>
    </div>
</div>

<style>
.color-preview {
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 4px;
    margin-right: 8px;
    vertical-align: middle;
    border: 1px solid #ddd;
}
</style>
@endsection
