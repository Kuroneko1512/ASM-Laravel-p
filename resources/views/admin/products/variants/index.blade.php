@extends('admin.layouts.master')

@section('title', 'Biến thể sản phẩm')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Biến thể của sản phẩm: {{ $product->name }}</h3>
                <div>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                    <a href="{{ route('products.variants.create', $product) }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Thêm biến thể
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Thuộc tính</th>
                                <th>Giá</th>
                                <th>Giá KM</th>
                                <th>Số lượng</th>
                                <th>Đã bán</th>
                                <th>Hình ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($variants as $variant)
                                <tr>
                                    <td>{{ $variant->sku }}</td>
                                    <td>
                                        @foreach ($variant->attribute_values as $attr => $value)
                                            <span class="badge bg-info">{{ $attr }}: {{ $value }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ number_format($variant->price) }}đ</td>
                                    <td>{{ $variant->sale_price ? number_format($variant->sale_price) . 'đ' : '-' }}</td>
                                    <td>{{ $variant->quantity }}</td>
                                    <td>{{ $variant->sold }}</td>
                                    <td>
                                        @if ($variant->image)
                                            <img src="{{ asset($variant->image) }}" width="50" alt="Variant image">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('products.variants.edit', [$product, $variant]) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('products.variants.destroy', [$product, $variant]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $variants->links() }}
            </div>
        </div>
    </div>
@endsection
