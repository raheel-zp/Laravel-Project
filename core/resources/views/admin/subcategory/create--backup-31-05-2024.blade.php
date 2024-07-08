@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.subcategory.store', @$subcategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{ getImage(getFilePath('subcategory') . '/' . @$subcategory->image, getFileSize('subcategory')) }})">
                                                    <button type="button" class="remove-image">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>
                                                <small class="mt-2">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg').</b> @lang('Image will be resized into ' . getFileSize('subcategory') . 'px') </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> @lang('Name')</label>
                                            <input type="text" name="name" class="form-control" value="{{old('name',@$subcategory->name)}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>@lang('Category')</label>
                                            <select class=" form-control" name="category_id"  id="category" required>
                                                <option selected disabled>@lang('Select One')</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @selected(@$subcategory->category_id == $category->id) data-subcategories="{{ $category->subcategory }}" data-subcategory="">
                                                    {{ __($category->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>@lang('Subcategory')</label>
                                            <select class="form-control form-select form--control h-50 w-100" name="sub_parent_id" id="subcategory">
                                                <option selected disabled>@lang('Select One')</option>
                                                @if($categories)
                                                    @foreach($subCategories as $subCategory)
                                                        <?php $dash=''; ?>
                                                        <option value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                                        @if(count($subCategory->parentSubcategory))
                                                            @include('admin.subcategory.childoptions',['parentsubcategories' => $subCategory->parentSubcategory])
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label> @lang('Description')</label>
                                    <textarea name="description" class="form-control" cols="30" rows="10" required>{{ old('description',@$subcategory->description) }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.subcategory.index') }}" />
@endpush

@push('style')
    <style>
        .profilePicUpload {
            margin-top: -20px;
        }
    </style>
@endpush

