@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Category')</th>
                                    <th>@lang('Sub Child Category')</th>
                                    <th>@lang('Description')</th>
                                    
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subCategories as $subCategory)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="{{ getImage(getFilePath('subcategory') . '/' . $subCategory->image, getFileSize('subcategory')) }}" class="plugin_bg">
                                                </div>
                                                <span class="name">{{ __(@$subCategory->name) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ __(@$subCategory->category->name) }}
                                        </td>
                                        <td>
                                            <?php $dash=''; ?>
                                            @if(count($subCategory->parentSubcategory))
                                                @include('admin.subcategory.childcategory', ['parentsubcategories' => $subCategory->parentSubcategory])
                                            @endif
                                        </td>
                                        <td>
                                            {{ __(strLimit($subCategory->description, 30)) }}
                                            @if (strlen($subCategory->description) > 30)
                                            <br>
                                            <small class="text--primary catDescription" role="button" data-cat_details="{{ __($subCategory->description) }}">
                                                @lang('Read More')
                                            </small>
                                            @endif
                                        </td>
                                       
                                        <td> @php echo $subCategory->statusBadge; @endphp </td>
                                        <td>
                                            <div class="d-flex gap-2 flex-wrap justify-content-end">
                                                <a href="{{ route('admin.subcategory.edit', $subCategory->id) }}" class="btn btn-outline--primary btn-sm">
                                                    <i class="las la-pen"></i>@lang('Edit')
                                                </a>
                                                @if (!$subCategory->status)
                                                <button type="button" class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.subcategory.status', $subCategory->id) }}" data-question="@lang('Are you sure to enable this subcategory?')">
                                                        <i class="la la-eye"></i>@lang('Enable')
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-outline--danger  confirmationBtn" data-action="{{ route('admin.subcategory.status', $subCategory->id) }}" data-question="@lang('Are you sure to disable this subcategory?')">
                                                        <i class="la la-eye-slash"></i>@lang('Disable')
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($subCategories->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($subCategories) @endphp
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="modal subCategoryModal fade " tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Subcategory Description')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Category / Subcategory name" />
    <a href="{{ route('admin.subcategory.create') }}" class="btn btn-outline--primary h-45">
        <i class="las la-plus"></i>@lang('Add New')
    </a>
@endpush

@push('script')
    <script>
        "use strict";
        $('.catDescription').on('click', function() {
            let details = $(this).data('cat_details');
            let modal = $('.subCategoryModal');
            modal.find('.modal-body p').html(details)
            modal.modal('show');

        })
    </script>
@endpush
