
<?php $__env->startSection('title', __('messages.cards_title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-start justify-content-between flex-wrap gap-3">
    <div>
        <h1 class="page-title"><?php echo e(__('messages.cards_title')); ?></h1>
        <p class="page-sub"><?php echo e(__('messages.manage_cards_desc')); ?></p>
    </div>
    <a href="<?php echo e(route('admin.cards.create')); ?>" class="btn-primary-sm"><i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_card')); ?></a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-3"><?php echo e(session('success')); ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="panel-card mb-3">
    <div class="panel-card-body">
        <form method="GET" class="row g-2">
            <div class="col-12 col-md-5">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control form-control-sm" placeholder="<?php echo e(__('messages.search_cards_ph')); ?>">
            </div>
            <div class="col-12 col-md-4">
                <select name="pos_id" class="form-select form-select-sm">
                    <option value=""><?php echo e(__('messages.all_pos')); ?></option>
                    <?php $__currentLoopData = $posList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($pos->id); ?>" <?php if(request('pos_id') == $pos->id): echo 'selected'; endif; ?>><?php echo e($pos->name_en); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-12 col-md-3">
                <button type="submit" class="btn-primary-sm w-100"><i class="bi bi-search"></i> <?php echo e(__('messages.Search')); ?></button>
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
                    <th><?php echo e(__('messages.photo_label')); ?></th>
                    <th><?php echo e(__('messages.card_name')); ?></th>
                    <th><?php echo e(__('messages.pos_label')); ?></th>
                    <th><?php echo e(__('messages.selling_price')); ?></th>
                    <th><?php echo e(__('messages.number_of_cards')); ?></th>
                    <th><?php echo e(__('messages.Actions')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td style="color:var(--muted)"><?php echo e($card->id); ?></td>
                    <td>
                        <?php if($card->photo): ?>
                            <img src="<?php echo e(asset('assets/uploads/cards/'.$card->photo)); ?>" style="width:40px;height:40px;object-fit:cover;border-radius:6px">
                        <?php else: ?>
                            <span style="color:var(--muted)">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div style="font-weight:500"><?php echo e($card->name_ar); ?></div>
                        <div style="font-size:.75rem;color:var(--muted)"><?php echo e($card->name_en); ?></div>
                    </td>
                    <td>
                        <?php if($card->pos): ?>
                            <div><?php echo e($card->pos->name_en); ?></div>
                            <small style="color:var(--muted)"><?php echo e($card->pos->city->name_en ?? ''); ?></small>
                        <?php else: ?>
                            <span style="color:var(--muted)">—</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e(number_format($card->selling_price, 2)); ?></td>
                    <td>
                        <span class="badge bg-secondary"><?php echo e(number_format($card->number_of_cards, 0)); ?></span>
                    </td>
                    <td>
                        <div class="d-flex gap-1 align-items-center">
                            <a href="<?php echo e(route('admin.card-numbers.index', ['card_id' => $card->id])); ?>"
                               class="btn-outline-sm" title="عرض أرقام البطاقة">
                                <i class="bi bi-upc-scan"></i>
                                <span style="font-size:.72rem"><?php echo e($card->card_numbers_count); ?></span>
                            </a>
                            <a href="<?php echo e(route('admin.cards.edit', $card->id)); ?>" class="btn-outline-sm" style="padding:4px 8px"><i class="bi bi-pencil"></i></a>
                            <form action="<?php echo e(route('admin.cards.destroy', $card->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('messages.delete_card_confirm')); ?>')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-danger-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="text-center py-4" style="color:var(--muted)"><?php echo e(__('messages.no_cards_yet')); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="p-3"><?php echo e($cards->withQueryString()->links()); ?></div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\cards\index.blade.php ENDPATH**/ ?>