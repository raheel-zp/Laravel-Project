<?php $dash.='-- '; ?>
@foreach($parentsubcategories as $parentsubcategory)
    <option value="{{$parentsubcategory->id}}">{{$dash}}{{$parentsubcategory->name}}</option>
    @if(count($parentsubcategory->parentsubcategory))
        @include('admin.subcategory.subCategoryList-option',['parentsubcategories' => $parentsubcategory->parentsubcategory])
    @endif
@endforeach