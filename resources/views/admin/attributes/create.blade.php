@extends('admin.layouts.master')

@section('title', 'Thêm thuộc tính mới')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Thêm thuộc tính mới</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.attributes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Tên thuộc tính</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    <small class="text-muted">Ví dụ: color, size</small>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên hiển thị</label>
                    <input type="text" name="display_name" class="form-control" value="{{ old('display_name') }}">
                    <small class="text-muted">Ví dụ: Màu sắc, Kích thước</small>
                    @error('display_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Vị trí</label>
                    <input type="number" name="position" class="form-control" value="{{ old('position', 0) }}">
                    @error('position')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
                        <label class="form-check-label">Kích hoạt</label>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu thuộc tính</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
