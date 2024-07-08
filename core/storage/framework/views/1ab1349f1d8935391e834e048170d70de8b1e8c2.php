<div class="row">
	<?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="col-md-12 mb-4">
			<?php if(is_object($val) || is_array($val)): ?>
				<h6><?php echo e(keyToTitle($k)); ?></h6>
				<hr>
				<div class="ms-3">
					<?php echo $__env->make('admin.deposit.gateway_data',['details'=>$val], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			<?php else: ?>
				<h6><?php echo e(@keyToTitle($k)); ?></h6>
				<p><?php echo e(@$val); ?></p>
			<?php endif; ?>
		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/admin/deposit/gateway_data.blade.php ENDPATH**/ ?>