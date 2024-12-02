<div class="modal fade" id="addVariantModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Variant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="variantForm">
                    <div class="mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control">
                    </div>

                    <div id="attributeInputs">
                        @foreach($attributes as $attribute)
                        <div class="mb-3">
                            <label class="form-label">{{ $attribute->display_name }}</label>
                            <select name="attributes[{{ $attribute->id }}]" class="form-select">
                                @foreach($attribute->values as $value)
                                    <option value="{{ $value->id }}">{{ $value->display_value }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveVariant">Save</button>
            </div>
        </div>
    </div>
</div>
