@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Edit Variant</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('products.variants.update', [$product, $variant]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Form fields giống create, thêm value từ $variant -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">SKU</label>
                                <input type="text" name="sku" class="form-control" value="{{ old('sku', $variant->sku) }}">
                                @error('sku')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @foreach ($attributes as $attribute)
                                <div class="mb-3">
                                    <label class="form-label">{{ $attribute->display_name }}</label>
                                    <select name="attributes[{{ $attribute->id }}]" class="form-select">
                                        @foreach ($attribute->values as $value)
                                            <option value="{{ $value->id }}"
                                                {{ $value->id == $variant->attributeValue->id ? 'selected' : '' }}>
                                                {{ $value->display_value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" value="{{ old('price', $variant->price) }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sale Price</label>
                                <input type="number" name="sale_price" class="form-control"
                                    value="{{ old('sale_price', $variant->sale_price) }}">
                                    @error('sale_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $variant->quantity) }}">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <img src="{{ asset('storage/' . $variant->image) }}" alt="{{ $variant->sku }}"
                                    class="img-thumbnail d-block mb-2" width="100">
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update Variant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
