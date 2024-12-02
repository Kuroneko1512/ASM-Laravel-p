@extends('admin.layouts.master')

@section('title', 'Chỉnh sửa thuộc tính')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Chỉnh sửa thuộc tính: {{ $attribute->display_name }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.attributes.update', $attribute) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                    <div class="mb-3">
                        <label class="form-label">Tên thuộc tính</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $attribute->name) }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tên hiển thị</label>
                        <input type="text" name="display_name" class="form-control"
                            value="{{ old('display_name', $attribute->display_name) }}">
                        @error('display_name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Vị trí</label>
                        <input type="number" name="position" class="form-control"
                            value="{{ old('position', $attribute->position) }}">
                        @error('position')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                {{ $attribute->is_active ? 'checked' : '' }}>
                            <label class="form-check-label">Kích hoạt</label>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('admin.attributes.index') }}" class="btn btn-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
