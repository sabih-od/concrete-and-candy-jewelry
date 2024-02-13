{{--SENDING THIS $create_new_category CAUSE WHEN WE CREATE NEW CATEGORY WE USE THIS BLADE TOO FOR LOOPING EXSISTING CATEGORIES
 SO ITS GIVE EXCEPTION CAUSE SUB CATEGORY VARIABLES NOT FOUND--}}


@if(isset($create_new_category))
    @foreach ($subcategories as $subcategory)
        <option value="{{ $subcategory->id }}">{{ str_repeat('--', $level) . ' ' . $subcategory->name }}</option>
        @if ($subcategory->subcategories->count() > 0)
            @include('admin.components.category-dropdown', [
                'subcategories' => $subcategory->subcategories,
                'level' => $level + 1 // Increment the level for subcategories
            ])
        @endif
    @endforeach
@else

    @foreach ($subcategories as $subcategory)
        <option value="{{ $subcategory->id }}"
                @if ($subcategory->id == $selectedCategoryID)
                selected
            @endif>
            {{ str_repeat('-', $level * 2) }} {{ $subcategory->name }}
        </option>
        @if ($subcategory->subcategories->count() > 0)
            @include('admin.components.category-dropdown', [
                'subcategories' => $subcategory->subcategories,
                'level' => $level + 1,
                'parentCategoryID' => $parentCategoryID,
                'selectedCategoryID' => $selectedCategoryID // Pass the selected category ID
            ])
        @endif
    @endforeach


@endif






