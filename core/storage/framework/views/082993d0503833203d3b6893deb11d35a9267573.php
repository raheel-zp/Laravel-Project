<div class="dashboard__responsive__header d-flex align-items-center justify-content-between d-lg-none">
    <div class="thumb__wrapper d-flex align-items-center">
        <div class="thumb me-2">
            <?php if(auth()->user()->image): ?>
                <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . auth()->user()->image, getFileSize('userProfile'))); ?>">
            <?php else: ?>
                <img src="<?php echo e(getImage(getFilePath('userProfile') . '/' . 'user.png', getFileSize('userProfile'))); ?>">
            <?php endif; ?>
        </div>
        <span class="username"><?php echo e(auth()->user()->username); ?></span>
    </div>
    <div class="dashboard__sidebar__toggler"><i class="las la-sliders-h"></i></div>
</div>
<?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/templates/basic/partials/responsive_header.blade.php ENDPATH**/ ?>