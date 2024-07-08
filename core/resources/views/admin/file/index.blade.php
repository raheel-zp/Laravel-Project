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
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($files as $file)
                                    <tr>
                                        <td>{{ __($file->name) }}</td>
                                        <td>
                                            @php echo $file->statusBadge;@endphp
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 flex-wrap justify-content-end">
                                                @if (!$file->status)
                                                    <button type="button" class="btn btn-sm btn-outline--success ms-1  confirmationBtn" data-action="{{ route('admin.filetype.status', $file->id) }}" data-question="@lang('Are you sure to enable this file type?')">
                                                        <i class="la la-eye"></i> @lang('Enable')
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-outline--danger  confirmationBtn" data-action="{{ route('admin.filetype.status', $file->id) }}" data-question="@lang('Are you sure to disable this file type?')">
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @endif
                                                <button class="btn btn-outline--primary btn-sm updateFile" data-file="{{ $file }}">
                                                    <i class="las la-pen"></i>
                                                    @lang('Edit')
                                                </button>
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
                @if ($files->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($files) @endphp
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade addFileType" tabindex="-1" role="dialog" a aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form class="resetFormData" method="post" action="{{ route('admin.filetype.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="File type name" />
    <button class="btn btn-outline--primary h-45 addfile">
        <i class="las la-plus"></i>@lang('Add New')
    </button>
@endpush

@push('script')
    <script>
        (function($) {
            $('.addfile').on('click', function() {
                let modal = $('.addFileType');
                let title = "@lang('Add file type')";
                let action="{{ route('admin.filetype.store') }}";
                $('.resetFormData').trigger('reset');
                modal.find('form').attr('action',action);
                modal.find('.modal-title').text(title)
                modal.modal('show');
            });

            $('.updateFile').on('click', function() {
                let modal = $('.addFileType');
                let title = "@lang('Update file type')";
                let file = $(this).data('file');
                let action="{{ route('admin.filetype.store',':id') }}";
                modal.find('form').attr('action',action.replace(':id',file.id));
                modal.find('.modal-title').text(title);
                modal.find('input[name=name]').val(file.name);
                modal.modal('show');
            });

        })(jQuery)
    </script>
@endpush
