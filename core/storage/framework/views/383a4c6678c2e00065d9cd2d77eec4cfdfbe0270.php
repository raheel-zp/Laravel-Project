<?php $__currentLoopData = $formData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="form-group">
        <label class="form-label"><?php echo e(__($data->name)); ?></label>
        <?php if($data->type == 'text'): ?>
            <input type="text"
            class="form-control form--control"
            name="<?php echo e($data->label); ?>"
            value="<?php echo e(old($data->label)); ?>"
            <?php if($data->is_required == 'required'): ?> required <?php endif; ?>
            >
        <?php elseif($data->type == 'textarea'): ?>
            <textarea
                class="form-control form--control"
                name="<?php echo e($data->label); ?>"
                <?php if($data->is_required == 'required'): ?> required <?php endif; ?>
            ><?php echo e(old($data->label)); ?></textarea>
        <?php elseif($data->type == 'select'): ?>
            <select
                class="form-control form--control"
                name="<?php echo e($data->label); ?>"
                <?php if($data->is_required == 'required'): ?> required <?php endif; ?>
            >
                <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                <?php $__currentLoopData = $data->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($item); ?>" <?php if($item == old($data->label)): echo 'selected'; endif; ?>><?php echo e(__($item)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        <?php elseif($data->type == 'checkbox'): ?>
            <?php $__currentLoopData = $data->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check">
                    <input
                        class="form-check-input"
                        name="<?php echo e($data->label); ?>[]"
                        type="checkbox"
                        value="<?php echo e($option); ?>"
                        id="<?php echo e($data->label); ?>_<?php echo e(titleToKey($option)); ?>"
                    >
                    <label class="form-check-label" for="<?php echo e($data->label); ?>_<?php echo e(titleToKey($option)); ?>"><?php echo e($option); ?></label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php elseif($data->type == 'radio'): ?>
            <?php $__currentLoopData = $data->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check">
                    <input
                    class="form-check-input"
                    name="<?php echo e($data->label); ?>"
                    type="radio"
                    value="<?php echo e($option); ?>"
                    id="<?php echo e($data->label); ?>_<?php echo e(titleToKey($option)); ?>"
                    <?php if($option == old($data->label)): echo 'checked'; endif; ?>
                    >
                    <label class="form-check-label" for="<?php echo e($data->label); ?>_<?php echo e(titleToKey($option)); ?>"><?php echo e($option); ?></label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php elseif($data->type == 'file'): ?>
            <input
            type="file"
            class="form-control form--control"
            name="<?php echo e($data->label); ?>"
            <?php if($data->is_required == 'required'): ?> required <?php endif; ?>
            accept="<?php $__currentLoopData = explode(',',$data->extensions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ext): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> .<?php echo e($ext); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>"
            >
            <pre class="text--base mt-1"><?php echo app('translator')->get('Supported mimes'); ?>: <?php echo e($data->extensions); ?></pre>
        <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/components/viser-form.blade.php ENDPATH**/ ?>