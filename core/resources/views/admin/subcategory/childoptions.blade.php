<?php $dash.='-- '; ?>
@foreach($parentsubcategories as $parentsubcategory)
    <option class='parent-{{ $parentsubcategory->category_id }} subcategory' value="{{$parentsubcategory->id}}">{{$dash}}{{$parentsubcategory->name}}</option>
    @if(count($parentsubcategory->parentsubcategory))
        @include('admin.subcategory.childoptions',['parentsubcategories' => $parentsubcategory->parentsubcategory])
    @endif
@endforeach