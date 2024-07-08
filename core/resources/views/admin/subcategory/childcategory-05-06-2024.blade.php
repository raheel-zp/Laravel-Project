
<?php $dash.='|'; ?>
@foreach($parentsubcategories as $parentsubcategory)
    {{$parentsubcategory->name}} @if(count($parentsubcategory->parentsubcategory)) {{$dash}} @endif
    @if(count($parentsubcategory->parentsubcategory))
        @include('admin.subcategory.childcategory',['parentsubcategories' => $parentsubcategory->parentsubcategory])
    @endif
@endforeach
