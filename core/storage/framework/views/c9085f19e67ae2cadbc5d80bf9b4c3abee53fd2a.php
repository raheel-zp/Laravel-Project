<?php
    $freelancerContent = getContent('top_freelancer.content', true);
    $topFreelancer = \App\Models\JobProve::approve()
        ->groupBy('user_id')
        ->selectRaw('count(id) as count, user_id')
        ->with('user')
        ->orderBy('count', 'desc')
        ->take(5)
        ->get();
?>
<section class="freelancer-section padding-top padding-bottom overflow-hidden">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="section__header text-center">
                    <h2 class="section__header-title"><?php echo e(__($freelancerContent->data_values->heading)); ?></h2>
                    <p><?php echo e(__(@$freelancerContent->data_values->subheading)); ?></p>
                </div>
            </div>
        </div>
        <div class="freelancer__slider">
            <?php $__currentLoopData = $topFreelancer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $freelancer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="single-slide">
                    <div class="freelancer__item">
                        <div class="freelancer__header">
                            <div class="thumb">
                                <?php if($freelancer->user->image): ?>
                                    <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . $freelancer->user->image, getFileSize('userProfile'))); ?>" alt="<?php echo app('translator')->get('User'); ?>">
                                <?php else: ?>
                                    <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile'))); ?>" alt="<?php echo app('translator')->get('User'); ?>">
                                <?php endif; ?>
                            </div>
                            <h5 class="name"><?php echo e(@$freelancer->user->fullname); ?></h5>
                            <p class="designation"><?php echo e(@$freelancer->user->email); ?></p>
                        </div>
                        <div class="freelancer__footer">
                            <ul class="freelancer__info">
                                <li class="d-flex justify-content-between flex-wrap mb-2 me-0">
                                    <span><?php echo app('translator')->get('Country'); ?></span>
                                    <span class="text-end"><?php echo e(@$freelancer->user->address->country); ?></span>
                                </li>
                                <li class="d-flex justify-content-between flex-wrap">
                                    <span ><?php echo app('translator')->get('Jobs Completed'); ?></span>
                                    <span class="text-end"><?php echo e($freelancer->count); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>
<?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/sections/top_freelancer.blade.php ENDPATH**/ ?>