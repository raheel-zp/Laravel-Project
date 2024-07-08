<li>
    @foreach($parentsubcategories as $subCategory)
        @if($subCategory->id != $subCategory->sub_parent_id)
            <span class="caret">{{$subCategory->name}}</span>
            @if ($subCategory->parentSubcategory->isNotEmpty())
                <ul class="nested">
                    @include('admin.subcategory.childcategory', ['parentsubcategories' => $subCategory->parentSubcategory])
                </ul>
            @endif
        @endif
    @endforeach
</li>
