

<?php $__env->startSection('content'); ?>
<div class="col-md-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Modifier le Service</h4>
            <form action="<?php echo e(url('/edit_service')); ?>/<?php echo e($service->id); ?>" class="forms-sample" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Service</label>
                            <div class="col-sm-9">
                                <input value="<?php echo e($service->name); ?>" name="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Label" aria-label="Label">
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo e(__('Superviseur')); ?></label>
                            <div class="col-sm-9">
                                <select autocomplete="off" id="supervisor" name="supervisor" class="form-control <?php $__errorArgs = ['supervisor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <?php $__currentLoopData = $supervisors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supervisor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($supervisor->id == Auth::user()->id): ?>
                                            <option value="<?php echo e($supervisor->id); ?>" selected><?php echo e($supervisor->first_name); ?> <?php echo e($supervisor->last_name); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($supervisor->id); ?>"><?php echo e($supervisor->first_name); ?> <?php echo e($supervisor->last_name); ?></option>
                                        <?php endif; ?>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                              
                                </select>
                                <?php $__errorArgs = ['supervisor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>
            
                    
                
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a class="btn btn-light" href="<?php echo e(route('services')); ?>">Cancel</a>
            </form>
                
        </div>  
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\AGENT\Documents\MyOpla\resources\views/admin/edit_service.blade.php ENDPATH**/ ?>