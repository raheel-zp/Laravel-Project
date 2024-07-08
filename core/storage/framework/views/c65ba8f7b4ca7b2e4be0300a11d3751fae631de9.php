<?php $__env->startSection('panel'); ?>
    <div class="dashboard__content">
        <?php $kyc = getContent('kyc_content.content', true); ?>
        <?php if(auth()->user()->kv == 0): ?>
            <div class="alert alert-danger mb-3" role="alert">
                <h6 class="text--danger"><?php echo app('translator')->get('KYC Verification'); ?></h6>
                <p class="py-2">
                    <?php echo e(__(@$kyc->data_values->pending_content)); ?>

                    <a href="<?php echo e(route('user.kyc.form')); ?>" class="text--base"><?php echo app('translator')->get('Click here to verify'); ?></a>
                </p>
            </div>
        <?php endif; ?>
        <?php if(auth()->user()->kv == 2): ?>
            <div class="alert alert-warning mb-3" role="alert">
                <h6 class="alert-heading text--dark"><?php echo app('translator')->get('KYC Verification Pending'); ?></h6>
                <p class="py-2">
                    <?php echo e(__(@$kyc->data_values->pending_content)); ?>

                    <a href="<?php echo e(route('user.kyc.data')); ?>" class="text--base"><?php echo app('translator')->get('See KYC Data'); ?></a>
                </p>
            </div>
        <?php endif; ?>
        <?php echo $__env->make($activeTemplate . 'partials.user_history', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="job__completed card custom--card contact__form__wrapper">
            <div class="job__completed-header d-flex align-items-center justify-content-between">
                <h5><?php echo app('translator')->get('Jobs Completed'); ?></h5>
            </div>
            <div class="job__completed-body">
                <div id="chartprofile"></div>
            </div>
        </div>
        <div class="finished__jobs__wrapper mt-5">
            <div class="finished__jobs__header d-flex flex-wrap justify-content-between align-items-center mb-2">
                <h4 class="pe-4 mb-2"><?php echo app('translator')->get('Recent Earnings Jobs'); ?></h4>
                <a href="<?php echo e(route('user.job.finished')); ?>" class="btn btn--sm btn--base mb-2"><?php echo app('translator')->get('View All'); ?></a>
            </div>
            <table class="table transection__table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('Job Code'); ?></th>
                        <th><?php echo app('translator')->get('Amount'); ?></th>
                        <th><?php echo app('translator')->get('Status'); ?></th>
                        <th><?php echo app('translator')->get('Date'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <span class="invoice-id"><?php echo e($job->job->job_code); ?></span>
                            </td>
                            <td>
                                <span class="amount">
                                    <?php echo e($general->cur_sym); ?><?php echo e(showAmount($job->job->rate)); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($job->status == Status::JOB_PROVE_PENDING): ?>
                                    <span class="badge badge--warning"><?php echo app('translator')->get('Pending'); ?></span>
                                <?php elseif($job->status == Status::JOB_PROVE_APPROVE): ?>
                                    <span class="badge badge--success"><?php echo app('translator')->get('Approved'); ?></span>
                                <?php else: ?>
                                    <span class="badge badge--danger"><?php echo app('translator')->get('Rejected'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="time"><?php echo e(showDateTime($job->created_at, 'd-m-Y H:i:s')); ?></span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td class="justify-content-center text-center" colspan="100%"><?php echo e(__($emptyMessage)); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/global/js/apexcharts.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        $(document).ready(function() {
            var color = "<?php echo e($general->base_color); ?>";
            var options = {
                series: [{
                    name: "Jobs Completed",
                    data: [
                        <?php $__currentLoopData = $jobArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo json_encode($job['count'], 15, 512) ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ]
                }],
                chart: {
                    height: 360,
                    type: 'line',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: true,

                    }
                },
                dataLabels: {
                    enabled: false
                },
                colors: ["#" + color],
                stroke: {
                    curve: 'straight',
                    width: [1]
                },
                markers: {
                    size: 5,
                    colors: ["#" + color],
                    strokeColors: "#" + color,
                    strokeWidth: 1,
                    hover: {
                        size: 6,
                    }
                },
                grid: {
                    position: 'front',
                    borderColor: '#ddd',
                    strokeDashArray: 7,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                xaxis: {
                    categories: [
                        <?php $__currentLoopData = $jobArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo json_encode($job['month'], 15, 512) ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ],
                    lines: {
                        show: true,
                    }
                },
                yaxis: {
                    lines: {
                        show: true,
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartprofile"), options);
            chart.render();

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make($activeTemplate . 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\microlab-freelancing-platform\core\resources\views/templates/basic/user/dashboard.blade.php ENDPATH**/ ?>