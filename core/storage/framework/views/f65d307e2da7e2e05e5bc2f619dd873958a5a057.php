<div class="header-bottom">
    <div class="container">
        <div class="header-bottom-area">
            <div class="logo">
                <a href="<?php echo e(route('home')); ?>">
                    
                    <img src="<?php echo e(getImage('assets/images/logoIcon/logo.png')); ?>" alt="<?php echo app('translator')->get('logo'); ?>">
                </a>
            </div>
            <ul class="menu">
                <li><a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>"><?php echo app('translator')->get('Home'); ?></a></li>
                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(route('pages', [$page->slug])); ?>" class="<?php echo e(request()->routeIs('pages') ? 'active' : ''); ?>"><?php echo e(__($page->name)); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
               
                <li><a href="<?php echo e(route('blogs')); ?>" class="<?php echo e(request()->routeIs('blogs') ? 'active' : ''); ?>"><?php echo app('translator')->get('Blogs'); ?></a></li>
                
                <li class="p-0">
                    <?php if(auth()->guard()->guest()): ?>
                        <a class="btn btn--base btn--round btn--md ms-2 my-2 my-lg-0 text-white" href="<?php echo e(route('user.login')); ?>"><?php echo app('translator')->get('Login'); ?>
                        </a>
                        <a class="btn btn--base btn--round btn--md ms-2 text-white" href="<?php echo e(route('user.register')); ?>"><?php echo app('translator')->get('Register'); ?>
                        </a>
                    <?php else: ?>
                        
                        <a class="btn btn--base btn--round btn--md ms-2 text-white" href="<?php echo e(route('job.list')); ?>"><?php echo app('translator')->get('Jobs'); ?>
                        </a>
                        <a class="btn btn--base btn--round btn--md ms-2 my-2 my-lg-0 text-white" href="<?php echo e(route('user.home')); ?>"><?php echo app('translator')->get('Dashboard'); ?>
                        </a>
                        <a class="btn btn--base btn--round btn--md ms-2 text-white" href="<?php echo e(route('user.logout')); ?>"><?php echo app('translator')->get('Logout'); ?>
                        </a>
                    <?php endif; ?>

                </li>
                
                <li><a href="<?php echo e(route('contact')); ?>" class="<?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>"><?php echo app('translator')->get('Contact Us'); ?></a></li>
            </ul>
            <div class="header-trigger-wrapper d-flex d-lg-none align-items-center">
                <div class="header-top-trigger lh-1 p-1">
                    <i class="las la-ellipsis-v"></i>
                </div>
                <div class="header-trigger d-block d--none">
                    <span></span>
                </div>
            </div>

        </div>
    </div>
</div>
<?php /**PATH /home/srv31316/domains/nowy.zlecenio.eu/public_html/core/resources/views/templates/basic/partials/header.blade.php ENDPATH**/ ?>