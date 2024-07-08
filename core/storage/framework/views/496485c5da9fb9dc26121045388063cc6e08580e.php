<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Name'); ?></th>
                                    <th><?php echo app('translator')->get('Category'); ?></th>
                                    <th><?php echo app('translator')->get('Sub Child Category'); ?></th>
                                    <th><?php echo app('translator')->get('Description'); ?></th>
                                    
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="<?php echo e(getImage(getFilePath('subcategory') . '/' . $subCategory->image, getFileSize('subcategory'))); ?>" class="plugin_bg">
                                                </div>
                                                <span class="name"><?php echo e(__(@$subCategory->name)); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo e(__(@$subCategory->category->name)); ?>

                                        </td>
                                        <td>
                                            <?php $dash=''; ?>
                                            <?php if(count($subCategory->parentSubcategory)): ?>
                                                <?php echo $__env->make('admin.subcategory.childcategory', ['parentsubcategories' => $subCategory->parentSubcategory], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e(__(strLimit($subCategory->description, 30))); ?>

                                            <?php if(strlen($subCategory->description) > 30): ?>
                                            <br>
                                            <small class="text--primary catDescription" role="button" data-cat_details="<?php echo e(__($subCategory->description)); ?>">
                                                <?php echo app('translator')->get('Read More'); ?>
                                            </small>
                                            <?php endif; ?>
                                        </td>
                                       
                                        <td> <?php echo $subCategory->statusBadge; ?> </td>
                                        <td>
                                            <div class="d-flex gap-2 flex-wrap justify-content-end">
                                                <a href="<?php echo e(route('admin.subcategory.edit', $subCategory->id)); ?>" class="btn btn-outline--primary btn-sm">
                                                    <i class="las la-pen"></i><?php echo app('translator')->get('Edit'); ?>
                                                </a>
                                                <?php if(!$subCategory->status): ?>
                                                <button type="button" class="btn btn-sm btn-outline--success confirmationBtn" data-action="<?php echo e(route('admin.subcategory.status', $subCategory->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to enable this subcategory?'); ?>">
                                                        <i class="la la-eye"></i><?php echo app('translator')->get('Enable'); ?>
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-sm btn-outline--danger  confirmationBtn" data-action="<?php echo e(route('admin.subcategory.status', $subCategory->id)); ?>" data-question="<?php echo app('translator')->get('Are you sure to disable this subcategory?'); ?>">
                                                        <i class="la la-eye-slash"></i><?php echo app('translator')->get('Disable'); ?>
                                                    </button>
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
                <?php if($subCategories->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo paginateLinks($subCategories) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="modal subCategoryModal fade " tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo app('translator')->get('Subcategory Description'); ?></h5>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Category / Subcategory name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Category / Subcategory name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <a href="<?php echo e(route('admin.subcategory.create')); ?>" class="btn btn-outline--primary h-45">
        <i class="las la-plus"></i><?php echo app('translator')->get('Add New'); ?>
    </a>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        $('.catDescription').on('click', function() {
            let details = $(this).data('cat_details');
            let modal = $('.subCategoryModal');
            modal.find('.modal-body p').html(details)
            modal.modal('show');

        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/admin/subcategory/index.blade.php ENDPATH**/ ?>