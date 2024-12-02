@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Thêm biến thể cho sản phẩm: {{ $product->name }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('products.variants.store', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
                            @error('sku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Hiển thị các thuộc tính -->
                        <div id="attributes-container">
                            <h4>Thuộc tính</h4>
                            @foreach($attributes as $attribute)
                            <div class="mb-3">
                                <label class="form-label">{{ $attribute->display_name }}</label>
                                <select name="attributes[{{ $attribute->id }}]" class="form-select" >
                                    <option value="">Chọn {{ $attribute->display_name }}</option>
                                    @foreach($attribute->values as $value)
                                        <option value="{{ $value->id }}">{{ $value->display_value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Giá</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}" >
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Giá khuyến mãi</label>
                            <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}">
                            @error('sale_price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số lượng</label>
                            <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 0) }}">
                            @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('products.variants.index', $product) }}" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu biến thể</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
