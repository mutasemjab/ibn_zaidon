
<?php $__env->startSection('title', __('messages.card_numbers_title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.card_numbers_title')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.manage_card_numbers_desc')); ?></p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn-outline-sm" type="button" data-bs-toggle="collapse" data-bs-target="#bulk-gen-panel">
            <i class="bi bi-lightning-charge"></i> <?php echo e(__('messages.bulk_generate')); ?>

        </button>
        <a href="<?php echo e(route('admin.card-numbers.print')); ?>?<?php echo e(http_build_query(request()->all())); ?>" target="_blank" class="btn-outline-sm">
            <i class="bi bi-printer"></i> طباعة
        </a>
        <a href="<?php echo e(route('admin.card-numbers.create')); ?>" class="btn-primary-sm"><i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_number')); ?></a>
    </div>
</div>


<div class="collapse mb-3" id="bulk-gen-panel">
    <div class="panel-card">
        <div class="panel-card-header">
            <h2 class="panel-card-title"><i class="bi bi-lightning-charge" style="color:#f59e0b"></i> <?php echo e(__('messages.bulk_generate')); ?></h2>
            <span style="font-size:.8rem;color:var(--muted)"><?php echo e(__('messages.bulk_generate_desc')); ?></span>
        </div>
        <div class="panel-card-body">
            <form action="<?php echo e(route('admin.card-numbers.bulk')); ?>" method="POST" class="row g-3 align-items-end">
                <?php echo csrf_field(); ?>
                <div class="col-12 col-md-3">
                    <label class="form-label"><?php echo e(__('messages.card_label')); ?> <span class="text-danger">*</span></label>
                    <select name="card_id" class="form-select form-select-sm" required>
                        <option value=""><?php echo e(__('messages.select_card_ph')); ?></option>
                        <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($c->id); ?>" <?php if(request('card_id') == $c->id): echo 'selected'; endif; ?>><?php echo e($c->name_en); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label class="form-label"><?php echo e(__('messages.count_label')); ?> <span class="text-danger">*</span></label>
                    <input type="number" name="count" value="10" min="1" max="500" class="form-control form-control-sm" required>
                </div>
                <div class="col-6 col-md-2">
                    <label class="form-label"><?php echo e(__('messages.length_label')); ?></label>
                    <input type="number" name="length" value="16" min="8" max="32" class="form-control form-control-sm">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label"><?php echo e(__('messages.prefix_label')); ?></label>
                    <input type="text" name="prefix" maxlength="20" class="form-control form-control-sm" placeholder="IbnZaidon-">
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" class="btn-primary-sm w-100">
                        <i class="bi bi-lightning-charge"></i> <?php echo e(__('messages.generate_btn')); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2">
            <div class="col-12 col-md-3">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.search_number_ph')); ?>">
            </div>
            <div class="col-12 col-md-2">
                <select name="card_id" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.all_cards')); ?></option>
                    <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($c->id); ?>" <?php if(request('card_id') == $c->id): echo 'selected'; endif; ?>><?php echo e($c->name_en); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <select name="activate" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.activate_all')); ?></option>
                    <option value="1" <?php if(request('activate') === '1'): echo 'selected'; endif; ?>><?php echo e(__('messages.Active')); ?></option>
                    <option value="2" <?php if(request('activate') === '2'): echo 'selected'; endif; ?>><?php echo e(__('messages.Inactive')); ?></option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.status_all')); ?></option>
                    <option value="1" <?php if(request('status') === '1'): echo 'selected'; endif; ?>><?php echo e(__('messages.used')); ?></option>
                    <option value="2" <?php if(request('status') === '2'): echo 'selected'; endif; ?>><?php echo e(__('messages.not_used')); ?></option>
                </select>
            </div>
            <div class="col-12 col-md-1">
                <select name="sell" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.sell_all')); ?></option>
                    <option value="1" <?php if(request('sell') === '1'): echo 'selected'; endif; ?>><?php echo e(__('messages.sold')); ?></option>
                    <option value="2" <?php if(request('sell') === '2'): echo 'selected'; endif; ?>><?php echo e(__('messages.unsold')); ?></option>
                </select>
            </div>
            <div class="col-12 col-md-2">
                <button type="submit" class="btn-primary-sm w-100"><i class="bi bi-search"></i> <?php echo e(__('messages.filter')); ?></button>
            </div>
        </form>
    </div>
</div>

<div class="panel-card">
    <div class="panel-card-body p-0">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(__('messages.number_label')); ?></th>
                    <th><?php echo e(__('messages.card_number_field')); ?></th>
                    <th><?php echo e(__('messages.activate_label')); ?></th>
                    <th><?php echo e(__('messages.Status')); ?></th>
                    <th><?php echo e(__('messages.sell_label')); ?></th>
                    <th>الطالب المفعِّل</th>
                    <th><?php echo e(__('messages.Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $cardNumbers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--muted)"><?php echo e($cn->id); ?></td>
                    <td style="font-family:monospace;font-size:.88rem"><?php echo e($cn->number); ?></td>
                    <td><?php echo e($cn->card->name_en ?? '—'); ?></td>
                    <td>
                        <span class="pill <?php echo e($cn->activate === 1 ? 'pill-success' : 'pill-neutral'); ?>">
                            <?php echo e($cn->activate === 1 ? __('messages.Active') : __('messages.Inactive')); ?>

                        </span>
                    </td>
                    <td>
                        <span class="pill <?php echo e($cn->status === 1 ? 'pill-neutral' : 'pill-success'); ?>">
                            <?php echo e($cn->status === 1 ? __('messages.used') : __('messages.not_used')); ?>

                        </span>
                    </td>
                    <td>
                        <span class="pill <?php echo e($cn->sell === 1 ? 'pill-neutral' : 'pill-success'); ?>">
                            <?php echo e($cn->sell === 1 ? __('messages.sold') : __('messages.unsold')); ?>

                        </span>
                    </td>
                    <td>
                        <?php if($cn->assignedUser): ?>
                            <div style="font-weight:500;font-size:.85rem"><?php echo e($cn->assignedUser->name); ?></div>
                            <div style="font-size:.75rem;color:var(--muted)"><?php echo e($cn->assignedUser->national_id); ?></div>
                        <?php else: ?>
                            <span style="color:var(--muted)">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('admin.card-numbers.edit', $cn->id)); ?>" class="btn-outline-sm" style="padding:4px 8px"><i class="bi bi-pencil"></i></a>
                            <form action="<?php echo e(route('admin.card-numbers.destroy', $cn->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('messages.delete_number_confirm')); ?>')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn-outline-sm" style="padding:4px 8px;color:#dc2626;border-color:#fecaca"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.no_card_numbers_yet')); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-3"><?php echo e($cardNumbers->withQueryString()->links()); ?></div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\card_numbers\index.blade.php ENDPATH**/ ?>