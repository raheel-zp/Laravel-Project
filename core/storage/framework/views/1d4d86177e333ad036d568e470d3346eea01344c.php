<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'link' => '',
    'title' => '',
    'value' => '',
    'icon' => '',
    'bg' => 'white',
    'color' => 'primary',
    'icon_style' => 'outline',
    'overlay_icon' => 1,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'link' => '',
    'title' => '',
    'value' => '',
    'icon' => '',
    'bg' => 'white',
    'color' => 'primary',
    'icon_style' => 'outline',
    'overlay_icon' => 1,
]); ?>
<?php foreach (array_filter(([
    'link' => '',
    'title' => '',
    'value' => '',
    'icon' => '',
    'bg' => 'white',
    'color' => 'primary',
    'icon_style' => 'outline',
    'overlay_icon' => 1,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="widget-two box--shadow2 b-radius--5 bg--<?php echo e($bg); ?>">
    <?php if((bool) $overlay_icon): ?>
        <i class="<?php echo e($icon); ?> overlay-icon text--<?php echo e($color); ?>"></i>
    <?php endif; ?>

    <div
        class="widget-two__icon b-radius--5  <?php if($icon_style == 'outline'): ?> border border--<?php echo e($color); ?> text--<?php echo e($color); ?> <?php else: ?> bg--<?php echo e($color); ?> <?php endif; ?> ">
        <i class="<?php echo e($icon); ?>"></i>
    </div>

    <div class="widget-two__content">
        <h3><?php echo e($value); ?></h3>
        <p><?php echo e(__($title)); ?></p>
    </div>

    <?php if($link): ?>
        <a href="<?php echo e($link); ?>" class="widget-two__btn btn btn-outline--<?php echo e($color); ?>"><?php echo app('translator')->get('View All'); ?></a>
    <?php endif; ?>
</div>
<?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/components/widget-2.blade.php ENDPATH**/ ?>