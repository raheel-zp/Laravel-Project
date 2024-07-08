<?php $__env->startSection('panel'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('Job'); ?></th>
                                    <th><?php echo app('translator')->get('User'); ?></th>
                                    <th><?php echo app('translator')->get('Quantity'); ?></th>
                                    <th><?php echo app('translator')->get('Rate'); ?></th>
                                    <th><?php echo app('translator')->get('Total'); ?></th>
                                    <th><?php echo app('translator')->get('Status'); ?></th>
                                    <th><?php echo app('translator')->get('Date'); ?></th>
                                    <th><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td> <strong><?php echo e(__($job->job_code)); ?></strong> <br> <?php echo e(strLimit($job->title,50)); ?></td>
                                        <td>
                                            <span class="fw-bold"><?php echo e(@$job->user->fullname); ?></span>
                                            <br>
                                            <span class="small">
                                                <a href="<?php echo e(route('admin.users.detail', $job->user_id)); ?>"><span>@</span><?php echo e(@$job->user->username); ?></a>
                                            </span>
                                        </td>
                                        <td> <?php echo e($job->quantity); ?></td>
                                        <td><?php echo e($general->cur_sym); ?><?php echo e(showAmount($job->rate)); ?></td>
                                        <td><?php echo e($general->cur_sym); ?><?php echo e(showAmount($job->total)); ?></td>
                                        <td> <?php echo $job->statusJob; ?> </td>
                                        <td>
                                            <span class="d-block"> <?php echo e(showDateTime($job->created_at)); ?></span>
                                            <?php echo e(diffForHumans($job->created_at)); ?>

                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 flex-wrap justify-content-end">
                                                <a href="<?php echo e(route('admin.jobs.view', $job->id)); ?>" class="btn btn-sm btn-outline--success">
                                                    <i class="las la-eye "></i><?php echo app('translator')->get('view'); ?>
                                                </a>
                                                <a href="<?php echo e(route('admin.jobs.details', $job->id)); ?>" class="btn btn-sm btn-outline--primary">
                                                    <i class="las la-desktop"></i><?php echo app('translator')->get('Details'); ?>
                                                </a>
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
                <?php if($jobs->hasPages()): ?>
                    <div class="card-footer py-4">
                        <?php echo e(paginateLinks($jobs)); ?>

                    </div>
                <?php endif; ?>
            </div><!-- card end -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('breadcrumb-plugins'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-form','data' => ['placeholder' => 'Seach here...']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'Seach here...']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/admin/jobs/index.blade.php ENDPATH**/ ?>