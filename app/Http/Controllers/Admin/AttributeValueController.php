<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function index(Attribute $attribute)
    {
        $values = $attribute->values()->orderBy('position')->paginate(10);
        return view('admin.attributes.values.index', compact('attribute', 'values'));
    }

    public function create(Attribute $attribute)
    {
        return view('admin.attributes.values.create', compact('attribute'));
    }

    public function store(Request $request, Attribute $attribute)
    {
        $validated = $request->validate([
            'value' => 'required|string|max:255',
            'display_value' => 'required|string|max:255',
            'color_code' => 'nullable|string|max:7',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'position' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('attribute-values', 'public');
        }

        $attribute->values()->create($validated);

        return redirect()
            ->route('attributes.values.index', $attribute)
            ->with('success', 'Giá trị thuộc tính đã được thêm thành công');
    }

    public function edit(Attribute $attribute, AttributeValue $value)
    {
        return view('admin.attributes.values.edit', compact('attribute', 'value'));
    }

    public function update(Request $request, Attribute $attribute, AttributeValue $value)
    {
        $validated = $request->validate([
            'value' => 'required|string|max:255',
            'display_value' => 'required|string|max:255',
            'color_code' => 'nullable|string|max:7',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'position' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('attribute-values', 'public');
        }

        $value->update($validated);

        return redirect()
            ->route('attributes.values.index', $attribute)
            ->with('success', 'Giá trị thuộc tính đã được cập nhật thành công');
    }

    public function destroy(Attribute $attribute, AttributeValue $value)
    {
        $value->delete();
        
        return redirect()
            ->route('attributes.values.index', $attribute)
            ->with('success', 'Giá trị thuộc tính đã được xóa thành công');
    }
}
