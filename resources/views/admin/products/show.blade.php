@extends('admin.layouts.master')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Chi tiết sản phẩm</h3>
            <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Chỉnh sửa
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset($product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <th width="200">Tên sản phẩm:</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Danh mục:</th>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <th>SKU:</th>
                            <td>{{ $product->sku }}</td>
                        </tr>
                        <tr>
                            <th>Giá:</th>
                            <td>{{ number_format($product->price) }}đ</td>
                        </tr>
                        <tr>
                            <th>Giá khuyến mãi:</th>
                            <td>{{ $product->sale_price ? number_format($product->sale_price) . 'đ' : 'Không có' }}</td>
                        </tr>
                        <tr>
                            <th>Số lượng tồn:</th>
                            <td>{{ $product->quantity }}</td>
                        </tr>
                        <tr>
                            <th>Đã bán:</th>
                            <td>{{ $product->sold }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái:</th>
                            <td>
                                <span class="badge bg-{{ $product->is_active ? 'success' : 'danger' }}">
                                    {{ $product->is_active ? 'Đang bán' : 'Ngừng bán' }}
                                </span>
                            </td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <h4>Mô tả ngắn:</h4>
                        <p>{{ $product->short_description }}</p>
                    </div>

                    <div class="mt-4">
                        <h4>Mô tả chi tiết:</h4>
                        <div>{!! $product->long_description !!}</div>
                    </div>
                </div>
            </div>

            @if($product->has_variants)
            <div class="mt-5">
                <h4>Biến thể sản phẩm</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Thuộc tính</th>
                                <th>Giá</th>
                                <th>Giá KM</th>
                                <th>Số lượng</th>
                                <th>Hình ảnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->variants as $variant)
                            <tr>
                                <td>{{ $variant->sku }}</td>
                                <td>
                                    @foreach($variant->attribute_values as $attr => $value)
                                        <span class="badge bg-info">{{ $attr }}: {{ $value }}</span>
                                    @endforeach
                                </td>
                                <td>{{ number_format($variant->price) }}đ</td>
                                <td>{{ $variant->sale_price ? number_format($variant->sale_price) . 'đ' : '-' }}</td>
                                <td>{{ $variant->quantity }}</td>
                                <td>
                                    @if($variant->image)
                                        <img src="{{ asset($variant->image) }}" width="50" alt="Variant image">
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection