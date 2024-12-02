@extends('admin.layouts.master')

@section('title', 'Thêm giá trị cho thuộc tính')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Thêm giá trị cho thuộc tính: {{ $attribute->display_name }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.attributes.values.store', $attribute) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Giá trị</label>
                            <input type="text" name="value" class="form-control" value="{{ old('value') }}">
                            <small class="text-muted">Giá trị dùng trong hệ thống (không dấu)</small>
                            @error('value')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tên hiển thị</label>
                            <input type="text" name="display_value" class="form-control" value="{{ old('display_value') }}">
                            <small class="text-muted">Tên hiển thị cho người dùng</small>
                            @error('display_value')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Vị trí</label>
                            <input type="number" name="position" class="form-control" value="{{ old('position', 0) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        @if($attribute->name === 'color')
                        <div class="mb-3">
                            <label class="form-label">Mã màu</label>
                            <input type="color" name="color_code" class="form-control form-control-color" value="{{ old('color_code', '#000000') }}">
                        </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" name="image" class="form-control">
                            <small class="text-muted">Hình ảnh minh họa cho giá trị (nếu có)</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
                                <label class="form-check-label">Kích hoạt</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.attributes.values.index', $attribute) }}" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu giá trị</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
