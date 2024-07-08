<?php $__env->startSection('panel'); ?>

    <div id="app">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row justify-content-between mt-3">
                            <div class="col-md-7">
                                <ul>
                                    <li>
                                        <h5><?php echo app('translator')->get('Language Keywords of'); ?> <?php echo e(__($lang->name)); ?></h5>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-5 mt-md-0 mt-3">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-sm btn-outline--primary float-end"><i class="fa fa-plus"></i> <?php echo app('translator')->get('Add New Key'); ?> </button>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive--sm table-responsive">
                            <table class="table table--light tabstyle--two custom-data-table white-space-wrap" id="myTable">
                                <thead>
                                <tr>
                                    <th>
                                        <?php echo app('translator')->get('Key'); ?>
                                    </th>
                                    <th>
                                        <?php echo e(__($lang->name)); ?>

                                    </th>

                                    <th class="w-85"><?php echo app('translator')->get('Action'); ?></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__empty_1 = true; $__currentLoopData = $json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="white-space-wrap"><?php echo e($k); ?></td>
                                        <td class="text-left white-space-wrap"><?php echo e($language); ?></td>


                                        <td>
                                            <a href="javascript:void(0)"
                                               data-bs-target="#editModal"
                                               data-bs-toggle="modal"
                                               data-title="<?php echo e($k); ?>"
                                               data-key="<?php echo e($k); ?>"
                                               data-value="<?php echo e($language); ?>"
                                               class="editModal btn btn-sm btn-outline--primary">
                                                <i class="la la-pencil"></i> <?php echo app('translator')->get('Edit'); ?>
                                            </a>

                                            <a href="javascript:void(0)"
                                               data-key="<?php echo e($k); ?>"
                                               data-value="<?php echo e($language); ?>"
                                               data-bs-toggle="modal" data-bs-target="#DelModal"
                                               class="btn btn-sm btn-outline--danger deleteKey">
                                                <i class="la la-trash"></i> <?php echo app('translator')->get('Remove'); ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="100%" class="text-center"><?php echo e(__($emptyMessage)); ?></td>
                                </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addModalLabel"> <?php echo app('translator')->get('Add New'); ?></h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="las la-times"></i>
                        </button>
                    </div>

                    <form action="<?php echo e(route('admin.language.store.key',$lang->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="key"><?php echo app('translator')->get('Key'); ?></label>
                                <input type="text" class="form-control" id="key" name="key" value="<?php echo e(old('key')); ?>" required>

                            </div>
                            <div class="form-group">
                                <label for="value"><?php echo app('translator')->get('Value'); ?></label>
                                <input type="text" class="form-control" id="value" name="value" value="<?php echo e(old('value')); ?>" required>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn--primary w-100 h-45"> <?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editModalLabel"><?php echo app('translator')->get('Edit'); ?></h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="las la-times"></i></button>
                    </div>

                    <form action="<?php echo e(route('admin.language.update.key',$lang->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group ">
                                <label for="inputName" class="form-title"></label>
                                <input type="text" class="form-control" name="value" required>
                            </div>
                            <input type="hidden" name="key">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn--primary w-100 h-45"><?php echo app('translator')->get('Submit'); ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <!-- Modal for DELETE -->
        <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="DelModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DelModalLabel"> <?php echo app('translator')->get('Confirmation Alert!'); ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="las la-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo app('translator')->get('Are you sure to delete this key from this language?'); ?></p>
                    </div>
                    <form action="<?php echo e(route('admin.language.delete.key',$lang->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="key">
                        <input type="hidden" name="value">
                        <div class="modal-footer">
                            <button type="button" class="btn btn--dark" data-bs-dismiss="modal"><?php echo app('translator')->get('No'); ?></button>
                            <button type="submit" class="btn btn--primary"><?php echo app('translator')->get('Yes'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    
    <div class="modal fade" id="importModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo app('translator')->get('Import Language'); ?></h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="las la-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center text--danger"><?php echo app('translator')->get('If you import keywords, Your current keywords will be removed and replaced by imported keyword'); ?></p>
                        <div class="form-group">
                        <select class="form-control select_lang"  required>
                            <option value=""><?php echo app('translator')->get('Select One'); ?></option>
                            <?php $__currentLoopData = $list_lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data->id); ?>" <?php if($data->id == $lang->id): ?> class="d-none" <?php endif; ?> ><?php echo e(__($data->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-bs-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                    <button type="button" class="btn btn--primary import_lang"> <?php echo app('translator')->get('Import Now'); ?></button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('breadcrumb-plugins'); ?>
    <button type="button" class="btn btn-sm btn--primary box--shadow1 importBtn"><i class="la la-download"></i><?php echo app('translator')->get('Import Keywords'); ?></button>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        (function($){
            "use strict";
            $(document).on('click','.deleteKey',function () {
                var modal = $('#DelModal');
                modal.find('input[name=key]').val($(this).data('key'));
                modal.find('input[name=value]').val($(this).data('value'));
            });
            $(document).on('click','.editModal',function () {
                var modal = $('#editModal');
                modal.find('.form-title').text($(this).data('title'));
                modal.find('input[name=key]').val($(this).data('key'));
                modal.find('input[name=value]').val($(this).data('value'));
            });


            $(document).on('click','.importBtn',function () {
                $('#importModal').modal('show');
            });
            $(document).on('click','.import_lang',function(e){
                var id = $('.select_lang').val();

                if(id ==''){
                    notify('error','Invalide selection');

                    return 0;
                }else{
                    $.ajax({
                        type:"post",
                        url:"<?php echo e(route('admin.language.import.lang')); ?>",
                        data:{
                            id : id,
                            toLangid : "<?php echo e($lang->id); ?>",
                            _token: "<?php echo e(csrf_token()); ?>"
                        },
                        success:function(data){
                            if (data == 'success'){
                                notify('success','Import Data Successfully');
                                window.location.href = "<?php echo e(url()->current()); ?>"
                            }
                        }
                    });
                }

            });
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv31316/domains/zlecenio.eu/public_html/core/resources/views/admin/language/edit_lang.blade.php ENDPATH**/ ?>