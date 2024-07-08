<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Description'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Featured'); ?></th>
                                    <th><?php echo app('translator')->get('Hidden'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="<?php echo e(getImage(getFilePath('category') . '/' . $category->image, getFileSize('category'))); ?>" class="plugin_bg">
                                                </div>
                                                <span class="name"><?php echo e(__($category->name)); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo e(__(strLimit($category->description, 30))); ?>

                                            <?php if(strlen($category->description)  > 30): ?>
                                            <br>
                                            <small class="text--primary catDescription" role="button" data-cat_details="<?php echo e(__($category->description)); ?>"><?php echo app('translator')->get('Read More'); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $category->statusBadge; ?>
                                        </td>
                                        <td>
                                            <?php if($category->featured): ?>
                                                <span class="badge badge--success"><?php echo app('translator')->get('Yes'); ?></span>
                                            <?php else: ?>
                                                <span class="badge badge--danger"><?php echo app('translator')->get('No'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($category->is_hidden): ?>
                                                <span class="badge badge--success"><?php echo app('translator')->get('Yes'); ?></span>
                                            <?php else: ?>
                                                <span class="badge badge--danger"><?php echo app('translator')->get('No'); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline--primary" data-bs-toggle="dropdown"><i class="las la-ellipsis-v"></i>
                                                <?php echo app('translator')->get('Action'); ?>
                                            </button>
                                            <div class="dropdown-menu p-0">
                                                <a href="<?php echo e(route('admin.category.edit', $category->id)); ?>" class="dropdown-item">
                                                    <i class="las la-pen"></i> <?php echo app('translator')->get('Edit'); ?>
                                                </a>
                                                <?php if(!$category->status): ?>
                                                    <a href="javascript:void(0)" class="dropdown-item confirmationBtn" data-action="<?php echo e(route('admin.category.status', $category->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to enable this category?'); ?>">
                                                        <i class="la la-eye"></i> <?php echo app('translator')->get('Enable'); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="javascript:void(0)" class="dropdown-item  confirmationBtn" data-action="<?php echo e(route('admin.category.status', $category->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to disable this category?'); ?>">
                                                        <i class="la la-eye-slash"></i> <?php echo app('translator')->get('Disable'); ?>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if(!$category->featured): ?>
                                                    <a href="javascript:void(0)" class=" dropdown-item confirmationBtn" data-action="<?php echo e(route('admin.category.featured', $category->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to featured this category?'); ?>">
                                                        <i class="las la-check-circle"></i> <?php echo app('translator')->get('Featured'); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="javascript:void(0)" class=" dropdown-item  confirmationBtn" data-action="<?php echo e(route('admin.category.featured', $category->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to not featured this category?'); ?>">
                                                        <i class="las la-times-circle"></i> <?php echo app('translator')->get('Unfeatured'); ?>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if(!$category->is_hidden): ?>
                                                    <a href="javascript:void(0)" class=" dropdown-item confirmationBtn" data-action="<?php echo e(route('admin.category.hidden', $category->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to hide this category?'); ?>">
                                                    <i class="la la-eye-slash"></i> <?php echo app('translator')->get('Hide for un-authorized users'); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="javascript:void(0)" class=" dropdown-item  confirmationBtn" data-action="<?php echo e(route('admin.category.hidden', $category->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to show this category?'); ?>">
                                                    <i class="la la-eye"></i> <?php echo app('translator')->get('Show for un-authorized users'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($categories->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo paginateLinks($categories) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="modal categoryModal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Category Description'); ?></h5>
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
    <?php if (isset($component)) { $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b = $component; } ?>
<?php $component = App\View\Components\ConfirmationModal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('confirmation-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ConfirmationModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b)): ?>
<?php $component = $__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b; ?>
<?php unset($__componentOriginalc51724be1d1b72c3a09523edef6afdd790effb8b); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Category name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Category name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <a href="<?php echo e(route('admin.category.create')); ?>" class="btn btn-outline--primary h-45">
        <i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?>
    </a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('style'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/admin/category/index.blade.php ENDPATH**/ ?>