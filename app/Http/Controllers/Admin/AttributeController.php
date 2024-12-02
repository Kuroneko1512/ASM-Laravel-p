<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::withCount('values')->orderBy('position')->paginate(10);
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:attributes',
            'display_name' => 'required|string|max:255',
            'position' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        Attribute::create($validated);

        return redirect()
            ->route('admin.attributes.index')
            ->with('success', 'Attribute created successfully');
    }

    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(Request $request, Attribute $attribute)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:attributes,name,'.$attribute->id,
            'display_name' => 'required|string|max:255',
            'position' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $attribute->update($validated);

        return redirect()
            ->route('admin.attributes.index')
            ->with('success', 'Attribute updated successfully');
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()
            ->route('admin.attributes.index')
            ->with('success', 'Attribute deleted successfully');
    }
}
