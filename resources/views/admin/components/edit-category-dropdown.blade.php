@foreach ($subcategories as $subcategory)

    <option value="{{ $subcategory->id }}"{{ $subcategory->id == $maincategories->parent_id ? 'selected' : '' }}>
        {{ str_repeat('--', $level) . ' ' . $subcategory->name }}
    </option>
    @if ($subcategory->subcategories->count() > 0)
        @include('admin.components.edit-category-dropdown', [
            'subcategories' => $subcategory->subcategories,
            'maincategories' => $maincategories,
            'level' => $level + 1 // Increment the level for subcategories
        ])
    @endif
@endforeach
