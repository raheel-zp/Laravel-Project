<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo e($general->site_name); ?></title>
</head>

<body>
<form action="<?php echo e($data->url); ?>" method="<?php echo e($data->method); ?>" id="auto_submit">
    <?php $__currentLoopData = $data->val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <input type="hidden" name="<?php echo e($k); ?>" value="<?php echo e($v); ?>"/>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</form>
<script>
	"use strict";
    document.getElementById("auto_submit").submit();
</script>
</body>

</html>

<?php /**PATH /home/srv31316/domains/i-ty.pl/public_html/core/resources/views/templates/basic/user/payment/redirect.blade.php ENDPATH**/ ?>