@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Edit Product: {{ $product->name }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $product->name) }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Short Description</label>
                                <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                                @error('short_description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Long Description</label>
                                <textarea name="long_description" class="form-control" rows="5">{{ old('long_description', $product->long_description) }}</textarea>
                                @error('long_description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">SKU</label>
                                <input type="text" name="sku" class="form-control"
                                    value="{{ old('sku', $product->sku) }}">
                                @error('sku')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" class="form-control"
                                    value="{{ old('price', $product->price) }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sale Price</label>
                                <input type="number" name="sale_price" class="form-control"
                                    value="{{ old('sale_price', $product->sale_price) }}">
                                @error('sale_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control"
                                    value="{{ old('quantity', $product->quantity) }}">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" class="img-thumbnail d-block mb-2"
                                        width="100">
                                @endif
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="has_variants" class="form-check-input" value="1"
                                        {{ $product->has_variants ? 'checked' : '' }}>
                                    <label class="form-check-label">Has Variants</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                        {{ $product->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Giữ nguyên phần edit thông tin sản phẩm ở trên -->

        @if ($product->has_variants)
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Product Variants</h4>
                    <a href="{{ route('products.variants.create', $product) }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Variant
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Attributes</th>
                                    <th>Price</th>
                                    <th>Sale Price</th>
                                    <th>Stock</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->variants as $variant)
                                    <tr>
                                        <td>{{ $variant->sku }}</td>
                                        <td>
                                            @foreach ($variant->attribute_values as $attr => $value)
                                                <span class="badge bg-info">{{ $attr }}:
                                                    {{ $value }}</span>
                                            @endforeach
                                        </td>
                                        <td>${{ number_format($variant->price, 2) }}</td>
                                        <td>${{ number_format($variant->sale_price, 2) }}</td>
                                        <td>{{ $variant->quantity }}</td>
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
                                            <form
                                                action="{{ route('products.variants.destroy', [$product, $variant]) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
