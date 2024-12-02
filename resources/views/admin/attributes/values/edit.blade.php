@extends('admin.layouts.master')

@section('title', 'Chỉnh sửa giá trị thuộc tính')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Chỉnh sửa giá trị thuộc tính</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.attributes.values.update', [$attribute, $value]) }}" method="POST" enctype="multipart/form-data">
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Giá trị</label>
                            <input type="text" name="value" class="form-control" value="{{ old('value', $value->value) }}">
                            @error('value')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tên hiển thị</label>
                            <input type="text" name="display_value" class="form-control" value="{{ old('display_value', $value->display_value) }}">
                            @error('display_value')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Vị trí</label>
                            <input type="number" name="position" class="form-control" value="{{ old('position', $value->position) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        @if($attribute->name === 'color')
                        <div class="mb-3">
                            <label class="form-label">Mã màu</label>
                            <input type="color" name="color_code" class="form-control form-control-color" value="{{ old('color_code', $value->color_code) }}">
                            @error('color_code')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            @if($value->image)
                                <img src="{{ asset($value->image) }}" class="img-thumbnail d-block mb-2" width="100">
                            @endif
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $value->is_active ? 'checked' : '' }}>
                                <label class="form-check-label">Kích hoạt</label>
                            </div>
                        </div>
                    </div>

                    
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.attributes.values.index', $attribute) }}" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
