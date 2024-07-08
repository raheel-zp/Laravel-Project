<div class="modal fade" id="formGenerateModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?php echo app('translator')->get('Generate Form'); ?></h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <i class="las la-times"></i>
          </button>
        </div>
        <form class="<?php echo e($formClassName ?? 'generate-form'); ?>">
            <?php echo csrf_field(); ?>
              <div class="modal-body">
                <input type="hidden" name="update_id" value="">
                <div class="form-group">
                    <label><?php echo app('translator')->get('Form Type'); ?></label>
                    <select name="form_type" class="form-control" required>
                        <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                        <option value="text"><?php echo app('translator')->get('Text'); ?></option>
                        <option value="textarea"><?php echo app('translator')->get('Textarea'); ?></option>
                        <option value="select"><?php echo app('translator')->get('Select'); ?></option>
                        <option value="checkbox"><?php echo app('translator')->get('Checkbox'); ?></option>
                        <option value="radio"><?php echo app('translator')->get('Radio'); ?></option>
                        <option value="file"><?php echo app('translator')->get('File'); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo app('translator')->get('Is Required'); ?></label>
                    <select name="is_required" class="form-control" required>
                        <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                        <option value="required"><?php echo app('translator')->get('Required'); ?></option>
                        <option value="optional"><?php echo app('translator')->get('Optional'); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo app('translator')->get('Form Label'); ?></label>
                    <input type="text" name="form_label" class="form-control" required>
                </div>
                <div class="form-group extra_area">

                </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn--primary w-100 h-45 generatorSubmit"><?php echo app('translator')->get('Add'); ?></button>
              </div>
          </form>
      </div>
    </div>
</div>


<?php $__env->startPush('script-lib'); ?>
<script src="<?php echo e(asset('assets/global/js/form_generator.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/components/form-generator.blade.php ENDPATH**/ ?>