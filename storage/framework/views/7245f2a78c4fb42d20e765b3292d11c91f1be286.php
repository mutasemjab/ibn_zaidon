<?php
    $symbolGroups = [
        'متغيرات' => ['x','y','z','n','a','b','c'],
        'عمليات أساسية' => ['+','−','×','÷','=','≠','±','∓','%'],
        'مقارنة' => ['<','>','≤','≥','≈','≡','∝'],
        'أسس وجذور' => ['²','³','ⁿ','√','∛','∞'],
        'كسور' => ['½','⅓','⅔','¼','¾'],
        'حروف يونانية' => ['π','θ','α','β','γ','Δ','λ','Σ','μ','φ','Ω'],
        'تفاضل وتكامل' => ['∫','∑','∏','∂','lim','→'],
        'دوال مثلثية ولوغاريتم' => ['sin','cos','tan','cot','log','ln'],
        'مجموعات ومنطق' => ['∈','∉','⊂','⊆','∪','∩','∅','∀','∃','¬','∧','∨'],
        'هندسة' => ['°','∠','⊥','∥','≅','∼','△','□'],
        'كيمياء: أسهم وشحنات' => ['→','⇌','↔','⁺','⁻'],
        'كيمياء: أرقام سفلية وعلوية' => ['₀','₁','₂','₃','₄','₅','₆','₇','₈','₉','⁰','¹','²','³','⁴','⁵','⁶','⁷','⁸','⁹'],
    ];
?>
<div class="dropdown mb-2">
    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
        <i class="bi bi-magic"></i> رموز رياضية وكيميائية
    </button>
    <div class="dropdown-menu p-2" style="width:360px;max-height:380px;overflow-y:auto">
        <?php $__currentLoopData = $symbolGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $symbols): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-2">
                <div class="text-muted" style="font-size:.72rem;font-weight:600"><?php echo e($label); ?></div>
                <div class="d-flex flex-wrap gap-1 mt-1">
                    <?php $__currentLoopData = $symbols; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sym): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" class="btn btn-outline-secondary math-symbol-btn" style="padding:2px 7px;font-size:.85rem;line-height:1.4" data-target="<?php echo e($target); ?>" data-symbol="<?php echo e($sym); ?>"><?php echo e($sym); ?></button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\zaidon\resources\views\partials\symbol_picker.blade.php ENDPATH**/ ?>