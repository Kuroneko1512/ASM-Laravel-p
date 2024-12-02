<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function index(Product $product)
    {
        $variants = $product->variants()->with('attribute_values')->paginate(10);
        return view('admin.products.variants.index', compact('product', 'variants'));
    }

    public function create(Product $product)
    {
        // Lấy tất cả attributes đang active và các values của nó
        $attributes = Attribute::where('is_active', true)
            ->with(['values' => function ($query) {
                $query->where('is_active', true);
            }])
            ->get();

        return view('admin.products.variants.create', [
            'product' => $product,
            'attributes' => $attributes
        ]);
    }

    public function store(Request $request, Product $product)
    {
        // dd($request->all());

        $validated = $request->validate([
            'sku' => 'nullable|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // 'attributes' => 'required|array'
        ], [
            'price.required' => 'Giá sản phẩm là bắt buộc',
            'price.numeric' => 'Giá phải là số',
            'price.min' => 'Giá phải lớn hơn 0',
            'quantity.required' => 'Số lượng là bắt buộc',
            'quantity.integer' => 'Số lượng phải là số nguyên',
            'attributes.required' => 'Thuộc tính là bắt buộc'
        ]);
        // dd('a');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('variants', 'public');
        }


        ProductVariant::create([
            'product_id' => $product->id,
            'sku' => $validated['sku'],
            'price' => $validated['price'],
            'sale_price' => $validated['sale_price'],
            'quantity' => $validated['quantity'],
            'image' => $validated['image'] ?? null,
            'created_at' => now(),
        ]);

        // Thêm thuộc tính cho variant sử dụng ProductAttribute
        // foreach ($validated['attributes'] as $attributeId => $valueId) {
        //     ProductAttribute::create([
        //         'product_id' => $product->id,
        //         'attribute_id' => $attributeId,
        //         'is_required' => true
        //     ]);
        // }

        return redirect()
            ->route('products.edit', $product)
            ->with('success', 'Variant added successfully');
    }

    public function edit(Product $product, ProductVariant $variant)
    {
        $attributes = Attribute::where('is_active', true)->with('values')->get();
        return view('admin.products.variants.edit', compact('product', 'variant', 'attributes'));
    }

    public function update(Request $request, Product $product, ProductVariant $variant)
    {
        $validated = $request->validate([
            'sku' => 'nullable|string|unique:product_variants,sku,' . $variant->id,
            'attributes' => 'required|array',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('variants', 'public');
        }

        $variant->update([
            'sku' => $validated['sku'],
            'attribute_values' => $validated['attributes'],
            'price' => $validated['price'],
            'sale_price' => $validated['sale_price'],
            'quantity' => $validated['quantity'],
            'image' => $validated['image'] ?? $variant->image
        ]);

        return redirect()
            ->route('products.edit', $product)
            ->with('success', 'Variant updated successfully');
    }

    public function destroy(Product $product, ProductVariant $variant)
    {
        $variant->delete();
        return redirect()
            ->route('products.edit', $product)
            ->with('success', 'Variant deleted successfully');
    }
}
