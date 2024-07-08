@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Description')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Featured')</th>
                                    <th>@lang('Hidden')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="{{ getImage(getFilePath('category') . '/' . $category->image, getFileSize('category')) }}" class="plugin_bg">
                                                </div>
                                                <span class="name">{{ __($category->name) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            {{ __(strLimit($category->description, 30)) }}
                                            @if (strlen($category->description)  > 30)
                                            <br>
                                            <small class="text--primary catDescription" role="button" data-cat_details="{{ __($category->description) }}">@lang('Read More')</small>
                                            @endif
                                        </td>
                                        <td>
                                            @php echo $category->statusBadge; @endphp
                                        </td>
                                        <td>
                                            @if ($category->featured)
                                                <span class="badge badge--success">@lang('Yes')</span>
                                            @else
                                                <span class="badge badge--danger">@lang('No')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($category->is_hidden)
                                                <span class="badge badge--success">@lang('Yes')</span>
                                            @else
                                                <span class="badge badge--danger">@lang('No')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline--primary" data-bs-toggle="dropdown"><i class="las la-ellipsis-v"></i>
                                                @lang('Action')
                                            </button>
                                            <div class="dropdown-menu p-0">
                                                <a href="{{ route('admin.category.edit', $category->id) }}" class="dropdown-item">
                                                    <i class="las la-pen"></i> @lang('Edit')
                                                </a>
                                                @if (!$category->status)
                                                    <a href="javascript:void(0)" class="dropdown-item confirmationBtn" data-action="{{ route('admin.category.status', $category->id) }}" data-question="@lang('Are you sure to enable this category?')">
                                                        <i class="la la-eye"></i> @lang('Enable')
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" class="dropdown-item  confirmationBtn" data-action="{{ route('admin.category.status', $category->id) }}" data-question="@lang('Are you sure to disable this category?')">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </a>
                                                @endif

                                                @if (!$category->featured)
                                                    <a href="javascript:void(0)" class=" dropdown-item confirmationBtn" data-action="{{ route('admin.category.featured', $category->id) }}" data-question="@lang('Are you sure to featured this category?')">
                                                        <i class="las la-check-circle"></i> @lang('Featured')
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" class=" dropdown-item  confirmationBtn" data-action="{{ route('admin.category.featured', $category->id) }}" data-question="@lang('Are you sure to not featured this category?')">
                                                        <i class="las la-times-circle"></i> @lang('Unfeatured')
                                                    </a>
                                                @endif

                                                @if (!$category->is_hidden)
                                                    <a href="javascript:void(0)" class=" dropdown-item confirmationBtn" data-action="{{ route('admin.category.hidden', $category->id) }}" data-question="@lang('Are you sure to hide this category?')">
                                                    <i class="la la-eye-slash"></i> @lang('Hide for un-authorized users')
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" class=" dropdown-item  confirmationBtn" data-action="{{ route('admin.category.hidden', $category->id) }}" data-question="@lang('Are you sure to show this category?')">
                                                    <i class="la la-eye"></i> @lang('Show for un-authorized users')
                                                    </a>
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
                @if ($categories->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($categories) @endphp
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal categoryModal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Category Description')</h5>
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
    <x-search-form placeholder="Category name" />
    <a href="{{ route('admin.category.create') }}" class="btn btn-outline--primary h-45">
        <i class="las la-plus"></i>@lang('Add New')
    </a>
@endpush

@push('script')
<script>
    "use strict";
    (function ($) {
        $('.catDescription').on('click', function() {
            let details = $(this).data('cat_details');
            let modal   = $('.categoryModal');
            modal.find('.modal-body p').html(details)
            modal.modal('show');
        });
    })(jQuery);
</script>
@endpush

@push('style')
    <style>
        .table {
            background-color: #fff;
            border-radius: 10px;
        }

        .table-responsive--sm.table-responsive {
            min-height: 200px;
        }

        .card {
            background-color: transparent;
            box-shadow: none;
        }
    </style>
@endpush
