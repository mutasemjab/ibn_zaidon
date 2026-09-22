
<?php $__currentLoopData = $nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $nodeId = 'node-' . $node->id; ?>
<div class="tree-node ms-<?php echo e($node->level * 3); ?>" data-level="<?php echo e($node->level); ?>">
    <div class="d-flex align-items-center gap-2 py-2 border-bottom">
        
        <?php if($node->children->count() || $node->subjects->count()): ?>
            <button class="btn btn-link btn-sm p-0 text-secondary toggle-btn"
                    data-bs-toggle="collapse" data-bs-target="#<?php echo e($nodeId); ?>"
                    title="<?php echo e(__('messages.expand')); ?>">
                <i class="bi bi-chevron-right toggle-icon"></i>
            </button>
        <?php else: ?>
            <span style="width:20px"></span>
        <?php endif; ?>

        
        <?php
            $icons   = ['bi-diagram-3', 'bi-folder2', 'bi-folder2-open', 'bi-folder'];
            $classes = ['text-primary', 'text-success', 'text-info', 'text-warning'];
            $ic      = $icons[min($node->level, 3)];
            $cl      = $classes[min($node->level, 3)];
        ?>
        <i class="bi <?php echo e($ic); ?> <?php echo e($cl); ?> fs-5"></i>

        
        <span class="fw-semibold flex-grow-1">
            <?php echo e($node->name_ar); ?>

            <small class="text-muted fw-normal ms-1"><?php echo e($node->name_en); ?></small>
        </span>

        
        <div class="d-flex gap-1">
            
            <a href="<?php echo e(route('admin.categories.create', ['parent_id' => $node->id])); ?>"
               class="btn btn-outline-success btn-sm" title="<?php echo e(__('messages.add_sub_category')); ?>">
                <i class="bi bi-folder-plus"></i>
            </a>
            
            <a href="<?php echo e(route('admin.subjects.create', ['category_id' => $node->id, 'redirect_to_tree' => 1])); ?>"
               class="btn btn-outline-primary btn-sm" title="<?php echo e(__('messages.add_subject')); ?>">
                <i class="bi bi-book-half"></i>
            </a>
            
            <a href="<?php echo e(route('admin.categories.edit', $node)); ?>"
               class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-pencil"></i>
            </a>
            
            <form action="<?php echo e(route('admin.categories.destroy', $node)); ?>" method="POST"
                  onsubmit="return confirm('<?php echo e(__('messages.confirm_delete')); ?>')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </div>
    </div>

    
    <?php if($node->children->count() || $node->subjects->count()): ?>
    <div id="<?php echo e($nodeId); ?>" class="collapse">
        
        <?php $__currentLoopData = $node->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="d-flex align-items-center gap-2 py-1 border-bottom bg-light ms-<?php echo e(($node->level + 1) * 3); ?>">
            <span style="width:20px"></span>
            <i class="bi bi-journal-bookmark text-danger fs-6"></i>
            <span class="flex-grow-1 small">
                <?php echo e($subject->name_ar); ?>

                <small class="text-muted"><?php echo e($subject->name_en); ?></small>
            </span>
            <div class="d-flex gap-1">
                <a href="<?php echo e(route('admin.subjects.edit', $subject)); ?>"
                   class="btn btn-outline-secondary btn-sm btn-xs">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="<?php echo e(route('admin.subjects.destroy', $subject)); ?>" method="POST"
                      onsubmit="return confirm('<?php echo e(__('messages.confirm_delete')); ?>')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-outline-danger btn-sm btn-xs">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($node->children->count()): ?>
            <?php echo $__env->make('admin.categories._node', ['nodes' => $node->children], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\zaidon\resources\views\admin\categories\_node.blade.php ENDPATH**/ ?>