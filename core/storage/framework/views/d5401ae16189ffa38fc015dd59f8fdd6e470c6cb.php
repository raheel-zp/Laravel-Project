<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'link' => '',
    'title' => '',
    'value' => '',
    'icon' => '',
    'bg' => 'primary',
    'color' => 'white',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'link' => '',
    'title' => '',
    'value' => '',
    'icon' => '',
    'bg' => 'primary',
    'color' => 'white',
]); ?>
<?php foreach (array_filter(([
    'link' => '',
    'title' => '',
    'value' => '',
    'icon' => '',
    'bg' => 'primary',
    'color' => 'white',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="widget-two style--two box--shadow2 b-radius--5 bg--<?php echo e($bg); ?>">
    <div class="widget-two__icon b-radius--5 bg--<?php echo e($bg); ?>">
        <i class="<?php echo e($icon); ?>"></i>
    </div>

    <div class="widget-two__content">
        <h3 class="text-<?php echo e($color); ?>"><?php echo e($value); ?></h3>
        <p class="text-<?php echo e($color); ?>"><?php echo e(__($title)); ?></p>
    </div>
    <?php if($link): ?>
        <a href="<?php echo e($link); ?>" class="widget-two__btn"><?php echo app('translator')->get('View All'); ?></a>
    <?php endif; ?>
</div>
<?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/components/widget-3.blade.php ENDPATH**/ ?>